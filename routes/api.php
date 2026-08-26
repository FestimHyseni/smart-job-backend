<?php

use App\Http\Controllers\Api\AiJobRecommendationController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CandidateLanguageController;
use App\Http\Controllers\Api\CandidateProfileController;
use App\Http\Controllers\Api\CandidateSkillController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\CompanyUserController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\ConversationParticipantController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\InterviewController;
use App\Http\Controllers\Api\JobCategoryController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\JobSkillController;
use App\Http\Controllers\Api\JobViewController;
use App\Http\Controllers\Api\JobViewStatsController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ResumeController;
use App\Http\Controllers\Api\SavedJobController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
        Route::post('avatar', [AuthController::class, 'updateAvatar']);
    });
});

// Public read-only browsing endpoints
Route::get('jobs', [JobController::class, 'index']);
Route::get('jobs/{job}', [JobController::class, 'show']);
Route::get('job-categories', [JobCategoryController::class, 'index']);
Route::get('job-categories/{jobCategory}', [JobCategoryController::class, 'show']);
Route::get('skills', [SkillController::class, 'index']);
Route::get('skills/{skill}', [SkillController::class, 'show']);
Route::get('companies', [CompanyController::class, 'index']);
Route::get('companies/{company}', [CompanyController::class, 'show']);
Route::get('locations', [LocationController::class, 'index']);
Route::get('locations/{location}', [LocationController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('jobs', JobController::class)->except(['index', 'show']);
    Route::apiResource('job-categories', JobCategoryController::class)->except(['index', 'show']);
    Route::apiResource('skills', SkillController::class)->except(['index', 'show']);
    Route::apiResource('companies', CompanyController::class)->except(['index', 'show']);
    Route::apiResource('locations', LocationController::class)->except(['index', 'show']);

    Route::apiResource('company-users', CompanyUserController::class);
    Route::apiResource('candidate-profiles', CandidateProfileController::class);
    Route::apiResource('job-skills', JobSkillController::class);
    Route::apiResource('candidate-skills', CandidateSkillController::class);
    Route::apiResource('candidate-languages', CandidateLanguageController::class);
    Route::apiResource('resumes', ResumeController::class);
    Route::apiResource('applications', ApplicationController::class);
    Route::apiResource('educations', EducationController::class);
    Route::apiResource('experiences', ExperienceController::class);
    Route::apiResource('saved-jobs', SavedJobController::class)->except(['update']);
    Route::apiResource('job-views', JobViewController::class)->except(['update']);
    Route::apiResource('job-view-stats', JobViewStatsController::class);
    Route::apiResource('notifications', NotificationController::class);
    Route::apiResource('conversations', ConversationController::class)->except(['update']);
    Route::apiResource('conversation-participants', ConversationParticipantController::class)->except(['update']);
    Route::apiResource('messages', MessageController::class);
    Route::apiResource('interviews', InterviewController::class);
    Route::apiResource('ai-job-recommendations', AiJobRecommendationController::class);

    Route::middleware('admin')->group(function () {
        Route::apiResource('users', UserController::class)->except(['destroy']);
    });
});
