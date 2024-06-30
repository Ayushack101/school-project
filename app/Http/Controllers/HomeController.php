<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClassEntity;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;

class HomeController extends Controller
{
    public function showHome()
    {
        $class = ClassEntity::count();
        $section = Section::count();
        $subject = Subject::count();
        $teacher = Teacher::count();
        $student = Student::count();
        return view('pages/dashboard', compact('class', 'section', 'subject', 'teacher', 'student'));
    }
}
