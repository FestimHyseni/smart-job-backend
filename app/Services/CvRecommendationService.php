<?php

namespace App\Services;

use App\Models\Job;
use App\Models\Skill;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Smalot\PdfParser\Parser as PdfParser;
use Throwable;
use ZipArchive;

class CvRecommendationService
{
    public function extractText(UploadedFile $file): string
    {
        return match (strtolower($file->getClientOriginalExtension())) {
            'pdf' => $this->extractFromPdf($file),
            'docx' => $this->extractFromDocx($file),
            default => '',
        };
    }

    private function extractFromPdf(UploadedFile $file): string
    {
        try {
            $parser = new PdfParser();

            return $parser->parseFile($file->getRealPath())->getText();
        } catch (Throwable) {
            return '';
        }
    }

    private function extractFromDocx(UploadedFile $file): string
    {
        try {
            $zip = new ZipArchive();
            if ($zip->open($file->getRealPath()) !== true) {
                return '';
            }

            $xml = $zip->getFromName('word/document.xml');
            $zip->close();

            if (! $xml) {
                return '';
            }

            return strip_tags(str_replace('</w:p>', "\n", $xml));
        } catch (Throwable) {
            return '';
        }
    }

    /**
     * Whole-word (or whole-token) substring match, so short names like "Git"
     * don't false-positive inside unrelated words like "digital" or "legit".
     */
    private function containsTerm(string $haystack, string $needle): bool
    {
        $pattern = '/(?<![a-z0-9])'.preg_quote($needle, '/').'(?![a-z0-9])/iu';

        return preg_match($pattern, $haystack) === 1;
    }

    /**
     * Inserts spaces at camelCase boundaries ("ReactJs" -> "React Js") so
     * compound tokens common in CVs don't defeat the whole-word matcher.
     */
    private function normalize(string $text): string
    {
        return mb_strtolower(preg_replace('/(?<=[a-z0-9])(?=[A-Z])/', ' ', $text));
    }

    public function matchedSkills(string $cvText): Collection
    {
        $normalized = $this->normalize($cvText);

        if ($normalized === '') {
            return collect();
        }

        return Skill::all()->filter(
            fn (Skill $skill) => $this->containsTerm($normalized, $this->normalize($skill->name))
        )->values();
    }

    /**
     * @return array{matched_skills: array<int, string>, jobs: array<int, array{job: Job, score: int}>}
     */
    public function recommend(string $cvText, int $limit = 10): array
    {
        $matchedSkills = $this->matchedSkills($cvText);
        $matchedNames = $matchedSkills->pluck('name')->map(fn (string $name) => $this->normalize($name));

        if ($matchedNames->isEmpty()) {
            return ['matched_skills' => [], 'jobs' => []];
        }

        $jobs = Job::published()
            ->with(['company', 'category', 'location', 'skills'])
            ->get()
            ->map(function (Job $job) use ($matchedNames) {
                $jobText = $this->normalize($job->title.' '.$job->description.' '.($job->requirements ?? ''));
                $score = $matchedNames->filter(fn (string $name) => $this->containsTerm($jobText, $name))->count();

                return ['job' => $job, 'score' => $score];
            })
            ->filter(fn (array $item) => $item['score'] > 0)
            ->sortByDesc('score')
            ->take($limit)
            ->values();

        return [
            'matched_skills' => $matchedSkills->pluck('name')->all(),
            'jobs' => $jobs->all(),
        ];
    }
}
