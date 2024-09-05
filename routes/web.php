<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UploadController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'teacher'])->group(function () {
    Route::get('/question/all/teacher', [QuestionController::class, 'getAllQuestions'])->name('question.all.teacher');
    Route::get('/question/create/teacher', [QuestionController::class, 'create'])->name('question.create.teacher');
    Route::post('/question/edit/teacher', [QuestionController::class, 'edit'])->name('question.edit.teacher');
    Route::put('/question/store/teacher', [QuestionController::class, 'store'])->name('question.store.teacher');
    Route::patch('/question/update/teacher', [QuestionController::class, 'update'])->name('question.update.teacher');
    Route::delete('/question/delete/teacher', [QuestionController::class, 'delete'])->name('question.delete.teacher');
});

Route::post('/upload/file/teacher', [UploadController::class, 'uploadFile'])->middleware(['auth', 'teacher'])->name('upload.file.teacher');

Route::get('/question/student', [QuestionController::class, 'getQuestion'])->middleware('auth')->name('question.get.student');

//Route::get('/answer/get/student', [AnswerController::class, 'getAnswer'])->middleware('auth')->name('answer.get.student');
Route::post('/answer/store/student', [AnswerController::class, 'storeAnswer'])->middleware('auth')->name('answer.store.student');

Route::get('/result/get/student', [ResultController::class, 'getResult'])->middleware('auth')->name('result.get.student');
Route::get('/result/get/students/teacher', [ResultController::class, 'getResultStudents'])->middleware(['auth', 'teacher'])->name('results.get.students.teacher');

require __DIR__.'/auth.php';
