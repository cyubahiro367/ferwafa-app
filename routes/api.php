<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommitteController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SendingKeyController;
use App\Http\Controllers\UsersController;
use App\Models\TeamStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthenticationController::class, 'createAccount']);
    Route::post('/login', [AuthenticationController::class, 'signin']);
    Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset']);
    Route::post('/forgot-password', [ResetPasswordController::class, 'forgot']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('committe')->group(function () {
    Route::post('/create', [CommitteController::class, 'createCommitte']);
    Route::get('/list', [CommitteController::class, 'listAllCommitte']);
    Route::post('/update/{id}', [CommitteController::class, 'updateCommitte']);
    Route::delete('/delete/{id}', [CommitteController::class, 'deleteCommitte']);
});

Route::prefix('report')->group(function () {
    Route::post('/create', [ReportController::class, 'create']);
    Route::get('/list', [ReportController::class, 'get']);
    Route::get('/get/{id}', [ReportController::class, 'getSingle']);
    Route::get('/report/{id}', [ReportController::class, 'getReportDoc']);
    Route::post('/update/{id}', [ReportController::class, 'updateReport']);
    Route::delete('/delete/{id}', [ReportController::class, 'deleteReport']);
});

Route::post('/post-news', [NewsController::class, 'postNews'])->middleware(['auth:sanctum', 'ability:dcm']);
Route::get('/latest-news', [NewsController::class, 'getNews']);
Route::get('/all-news', [NewsController::class, 'getNewsForAdmin'])->middleware(['auth:sanctum', 'ability:dcm']);
Route::get('/news/{id}', [NewsController::class, 'getSingleNews']);
Route::post('/news/{id}', [NewsController::class, 'updateSingleNews'])->middleware(['auth:sanctum', 'ability:dcm']);
Route::delete('/news/{id}', [NewsController::class, 'deleteNews'])->middleware(['auth:sanctum', 'ability:dcm']);


Route::post('/sending-key', [SendingKeyController::class, 'sendingKey']);
Route::post('/permission-create', [PermissionController::class, 'permissionCreate']);
Route::get('/permission-list', [PermissionController::class, 'listPermission']);
Route::get('/permission/{id}', [PermissionController::class, 'getPermission']);
Route::put('/permission-update/{id}', [PermissionController::class, 'updatePermission']);
Route::delete('/permission-delete/{id}', [PermissionController::class, 'deletePermission']);

Route::post('/key-create', [KeyController::class, 'keyCreate']);
Route::get('/key-list', [KeyController::class, 'listKey']);
Route::get('/key/{id}', [KeyController::class, 'getKey']);
Route::delete('/key-delete/{id}', [KeyController::class, 'deleteKey']);
Route::get('/key-permission-list', [KeyController::class, 'permissionKeyList']);

Route::get('/users', [UsersController::class, 'getAllUsers']);
Route::get('/user/{id}', [UsersController::class, 'getSingleUser']);

Route::get('/days/{seasonID?}', [DayController::class, 'seasonDays'])->whereNumber('seasonID')->name('api.suspension-reasons.search');


// Route::get('/insert', function () {

//     for ($x = 1; $x <= 16; $x++) {
//         TeamStatistic::create([
//             'teamID' => $x,
//             'goalWin' => 0,
//             'goalLoss' => 0,
//             'goalDifference' => 0,
//             'matchPlayed' => 0,
//             'score' => 0
//         ]);
//     }
// });
