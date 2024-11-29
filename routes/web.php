<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\AchievementController;
use App\Http\Controllers\Dashboard\CoreTeamController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\LecturerController;
use App\Http\Controllers\Dashboard\OrganizationController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\StudentController;
use App\Http\Controllers\Dashboard\WorkingProgramController;
use App\Http\Controllers\Student\AboutController;
use App\Http\Controllers\Student\ContactController;
use App\Http\Controllers\Student\CoreTeamController as StudentCoreTeamController;
use App\Http\Controllers\Student\HomeController as StudentHomeController;
use App\Http\Controllers\Student\StudentController as StudentStudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
    Route::get('/login/google', [AuthController::class, 'redirectToGoogle'])->name('auth.redirectToGoogle');
    Route::get('/login/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.handleGoogleCallback');
});

Route::redirect('/', '/login');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get('/change-password', [AuthController::class, 'changePassword'])->name('auth.change-password');
    Route::put('/change-password', [AuthController::class, 'updatePassword'])->name('auth.update-password');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin/dashboard', 'as' => 'admin.dashboard.'], function () {
    Route::redirect('/', '/admin/dashboard/home');
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::resource('organizations', OrganizationController::class)->except('show', 'create');
    Route::resource('lecturers', LecturerController::class)->except('show', 'create');
    Route::resource('core-teams', CoreTeamController::class)->except('show', 'create');
    Route::resource('students', StudentController::class)->except('create');
    Route::resource('achievements', AchievementController::class)->except('show', 'create');
    Route::resource('working-programs', WorkingProgramController::class)->except('show', 'create');
});

Route::group(['middleware' => ['auth', 'role:student'], 'prefix' => 'student/dashboard', 'as' => 'student.dashboard.'], function () {
    Route::get('/home', [StudentHomeController::class, 'index'])->name('home.index');
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::get('/students', [StudentStudentController::class, 'index'])->name('students.index');
    Route::get('/students/{student}', [StudentStudentController::class, 'show'])->name('students.show');
    Route::get('/core-teams', [StudentCoreTeamController::class, 'index'])->name('core-teams.index');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
});
