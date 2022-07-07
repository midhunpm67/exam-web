<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/register', function () {
    return view('register');
});

Route::post('/login', [AdminController::class, 'login'])->name('login');
Route::post('/register', [AdminController::class, 'register'])->name('register');

    Route::get('/admin-dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/list-teacher', [AdminController::class, 'listTeacher'])->name('listTeacher');
    Route::post('/list-teacher', [AdminController::class, 'teacherJsonData'])->name('teacher.list');
    Route::get('/delete-teacher/{id}', [AdminController::class, 'deleteTeacher']);
    Route::get('/get-data-byId/{id}', [AdminController::class, 'getTeacherData']);
    // Route::post('/create-teacher', [AdminController::class, 'createTeacher'])->route('add-teacher');
    // Route::get('/student', [AdminController::class, 'student']);

