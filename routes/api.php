<?php

use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\LandingController;
use App\Http\Controllers\API\LowonganController;
use App\Http\Controllers\API\RecruitmentController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ParticipantController;
use App\Http\Controllers\API\DashboardController;
// use App\Http\Controllers\API\RecruitmentController as APIRecruitmentController;
use App\Models\Lowongan;
use App\Models\Peserta;
use App\Models\Recruitment;
use App\Models\Participant;
use App\Models\Category;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
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

Route::get('search', [HomeController::class, 'filter']);
Route::get('careers', [HomeController::class, 'lowongan']);
Route::get('careers-detail/{id}', [HomeController::class, 'show']);
Route::post('careers-daftar/{id}', [HomeController::class, 'daftar']);

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/add', [UserController::class, 'store']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('get_user', [UserController::class, 'get_user']);
    Route::get('change-passwod', [UserController::class, 'get_update']);
    Route::get('lowongan', [RecruitmentController::class, 'index']);
    Route::post('lowongan-create', [RecruitmentController::class, 'store']);
    Route::post('lowongan-update/{id}', [RecruitmentController::class, 'update']);
    Route::get('lowongan-detail/{id}', [RecruitmentController::class, 'show']);
    Route::delete('lowongan-delete/{id}', [RecruitmentController::class, 'destroy']);

    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::get('participant/internship', [ParticipantController::class, 'index']);
    Route::get('participant/recruitment', [ParticipantController::class, 'recruitment']);
    Route::post('update-status/{id}', [ParticipantController::class, 'updateStatus']);
    Route::get('participant/{id}', [ParticipantController::class, 'show']);
    // Route::get('file/{id}/{idFile}', [ParticipantController::class, 'downloadCv']);
    Route::get('cv/{id}', [ParticipantController::class, 'downloadCv']);
    Route::get('fortofolio/{id}', [ParticipantController::class, 'downloadFT']);
    Route::get('foto/{id}', [ParticipantController::class, 'downloadFoto']);
    Route::get('certivicate/{id}', [ParticipantController::class, 'downloadCFT']);
});
