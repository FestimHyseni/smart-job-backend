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

    public function matchedSkills(string $cvText): Collection
    {
        $normalized = mb_strtolower($cvText);

        return Skill::all()->filter(
            fn (Skill $skill) => $normalized !== '' && str_contains($normalized, mb_strtolower($skill->name))
        )->values();
    }

    /**
     * @return array{matched_skills: array<int, string>, jobs: array<int, array{job: Job, score: int}>}
     */
    public function recommend(string $cvText, int $limit = 10): array
    {
        $matchedSkills = $this->matchedSkills($cvText);
        $matchedIds = $matchedSkills->pluck('id')->all();

        if (empty($matchedIds)) {
            return ['matched_skills' => [], 'jobs' => []];
        }

        $jobs = Job::published()
            ->with(['company', 'category', 'location', 'skills'])
            ->get()
            ->map(function (Job $job) use ($matchedIds) {
                $requiredIds = $job->skills->filter(fn (Skill $s) => $s->job_skill->importance === 'required')->pluck('id')->all();
                $preferredIds = $job->skills->filter(fn (Skill $s) => $s->job_skill->importance === 'preferred')->pluck('id')->all();

                $score = count(array_intersect($requiredIds, $matchedIds)) * 2
                    + count(array_intersect($preferredIds, $matchedIds));

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
