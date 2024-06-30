<?php

use App\Http\Controllers\ClassEntityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarksheetController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Dashboard
Route::get('/', [HomeController::class, 'showHome'])->name('view.dashboard');

// Class
Route::controller(ClassEntityController::class)->group(function () {
    Route::get('/class', 'showClass')->name('view.class');
    Route::post('/addclass', 'addClass')->name('add.class');
    Route::get('/deleteclass/{class_id}', 'deleteClass')->name('delete.class');
    Route::post('/updateclass', 'updateClass')->name('update.class');
});

// Teacher
Route::controller(TeacherController::class)->group(function () {
    Route::get('/teacher', 'showTeacher')->name('view.teacher');
    Route::get('/teacher-add', 'addTeacher')->name('add.teacher');
    Route::post('/teacher-store', 'storeTeacher')->name('add.teacherstore');
    Route::get('/delete-teacher/{teacher_id}', 'deleteTeacher')->name('delete.teacher');
    Route::get('/teacher-edit/{teacher_id}', 'editTeacher')->name('edit.teacher');
    Route::post('/teacher-edit-store', 'updateTeacher')->name('edit.teacherstore');
});

// Section
Route::controller(SectionController::class)->group(function () {
    Route::get('/section', 'showSection')->name('view.section');
    Route::post('/addsection', 'addSection')->name('add.section');
    Route::get('/deletesection/{section_id}', 'deleteSection')->name('delete.section');
    Route::post('/updatesection', 'updateSection')->name('update.section');
});

// Subject
Route::controller(SubjectController::class)->group(function () {
    Route::get('/subjects', 'showSubject')->name('view.subject');
    Route::post('/addsubject', 'addSubject')->name('add.subject');
    Route::get('/deletesubject/{subject_id}', 'deleteSubject')->name('delete.subject');
    Route::post('/updatesubject', 'updateSubject')->name('update.subject');
});

// Students
Route::controller(StudentController::class)->group(function () {
    Route::get('/student', 'showStudent')->name('view.student');
    Route::get('/get-student/{class_id}', 'getSections')->name('get.student.section');
    Route::get('/student-add', 'addStudent')->name('add.student');
    Route::post('/student-store', 'storeStudent')->name('add.studentstore');
    Route::get('/delete-student/{student_id}', 'deleteStudent')->name('delete.student');
    Route::get('/student-edit/{student_id}', 'editStudent')->name('edit.student');
    Route::post('/student-edit-store', 'updateStudent')->name('edit.studentstore');
});

// Marksheet
Route::controller(MarksheetController::class)->group(function () {
    Route::get('/marksheet', 'showMarksheet')->name('view.marksheet');
    Route::post('/addmarksheet', 'addMarksheet')->name('add.marksheet');
    Route::get('/deletemarksheet/{marksheet_id}', 'deleteMarksheet')->name('delete.marksheet');
    Route::post('/updatemarksheet', 'updateMarksheet')->name('update.marksheet');
});
