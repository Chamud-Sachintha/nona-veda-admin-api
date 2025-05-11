<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'authenticateAdminUser']);
Route::middleware('authToken')->post('get-admin-users', [AdminUserController::class, 'getAllAdminUserList']);
Route::middleware('authToken')->post('add-new-question', [QuestionController::class, 'addNewQuestion']);
Route::middleware('authToken')->post('get-question-list', [QuestionController::class, 'getAllQuestions']);
Route::middleware('authToken')->post('get-results', [QuestionController::class, 'getSAllClientResponses']);
Route::middleware('authToken')->post('get-dashboard-data', [DashboardController::class, 'getDashboardStatsInfo']);
Route::middleware('authToken')->post('get-question-by-id', [QuestionController::class, 'getQuestionInfoById']);
Route::middleware('authToken')->post('update-question-by-id', [QuestionController::class, 'updateQuestionById']);
Route::middleware('authToken')->post('delete-question-by-id', [QuestionController::class, 'deleteQuestionById']);