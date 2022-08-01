<?php

use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\ExamQuestionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\QuestionController;
use App\Models\Admin\ExamQuestion;
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

Route::middleware('auth:admin')->group(function () {
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/list-teacher', [AdminController::class, 'listTeacher'])->name('listTeacher');
    Route::post('/list-teacher', [AdminController::class, 'teacherJsonData'])->name('teacher.list');
    Route::get('/delete-teacher/{id}', [AdminController::class, 'deleteTeacher']);
    Route::get('/get-data-byId/{id}', [AdminController::class, 'getTeacherData']);
    Route::post('/create-teacher', [AdminController::class, 'createTeacher'])->name('add-teacher');
    Route::post('/edit-teacher', [AdminController::class, 'editTeacher'])->name('edit-teacher');
    Route::get('/question', [QuestionController::class, 'question'])->name('question');
    Route::post('/create-question', [QuestionController::class, 'createQuestion']);
    Route::get('/list-question', [QuestionController::class, 'listQuestion'])->name('list-question');
    Route::post('/list-question', [QuestionController::class, 'listQuestionJosn']);
    Route::get('/delete-question/{id}', [QuestionController::class, 'QuestionDelete']);
    Route::get('/get-question/{id}', [QuestionController::class, 'QuestionGetById'])->name('QuestionGetById');
    Route::post('/update-question', [QuestionController::class, 'updateQuestion'])->name('update-question');
    Route::get('/exam', [ExamController::class, 'exam'])->name('exam');
    Route::post('/create-exam', [ExamController::class, 'createExam'])->name('create-exam');
    Route::get('/exam-list', [ExamController::class, 'examList'])->name('exam-list');
    Route::post('/exam-list-table', [ExamController::class, 'examListJson']);
    Route::get('/exam-data-get', [ExamController::class, 'examGetData'])->name('exam-data-get');
    Route::post('/exam-question-list', [ExamController::class, 'examQuestions'])->name('exam-question-list');
    Route::post('/remove-question', [ExamController::class, 'removeQuestion'])->name('/remove-question');
    Route::get('/delete-exam/{id}', [ExamController::class, 'deleteExam'])->name('/delete-exam');
    Route::post('/add-question-list', [ExamQuestionController::class, 'addQuestionList']);
    Route::post('/add-exam-question', [ExamQuestionController::class, 'addExamQuestion']);
    Route::post('/remove-exam-question', [ExamQuestionController::class, 'removeExamQuestion']);
    Route::get('/exam-question-get/{id}/{exam_id}', [ExamQuestionController::class, 'ExamQuestionGetById'])->name('exam-question-get');
    Route::post('/update-exam-question', [ExamQuestionController::class, 'updateExamQuestion']);
});
