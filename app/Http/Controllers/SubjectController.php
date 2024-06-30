<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClassEntity;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SubjectController extends Controller
{
    public function showSubject(Request $req)
    {
        $classes = ClassEntity::select('id', 'class_name', 'numeric_name')->get();

        if ($classes->isEmpty()) {
            $subjects = collect();
            $teachers = Teacher::select('id', 'first_name', 'last_name')->get();
            return view('pages/subject', compact('subjects', 'classes', 'teachers'));
        }

        $classId = $req->input('class_id') ?? $classes->first()->id;
        $subjects = Subject::with('teacher')->where('class_id', $classId)->get();
        $teachers = Teacher::select('id', 'first_name', 'last_name')->get();
        if ($req->ajax()) {
            return view('partials/subject_table', compact('subjects'))->render();
        }

        return view('pages/subject', compact('subjects', 'classes', 'teachers'));
    }

    public function addSubject(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'subject_name' => 'required|string|max:255',
                'total_marks' => 'required|integer',
                'teacher_id' => 'required|exists:teachers,id',
                'class_id' => 'required|exists:class_entitys,id'
            ], [
                'teacher_id' => 'Please Select Teacher',
                'class_id' => 'Please Select Class',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $subject = new Subject();
            $subject->subject_name = $request->input('subject_name');
            $subject->total_marks = $request->input('total_marks');
            $subject->teacher_id = $request->input('teacher_id');
            $subject->class_id = $request->input('class_id');
            $subject->save();

            Session::flash('success_message', 'New Subject Created Successfully!');
            return response()->json(['message' => 'New Subject Created successfully'], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteSubject(string $subject_id)
    {
        try {
            $subject = Subject::find($subject_id);
            if (!$subject) {
                return response()->json(['message' => 'Subject not found'], 404);
            }

            $subject->delete();
            Session::flash('success_message', 'Subject deleted successfully!');
            return response()->json(['message' => 'Subject deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateSubject(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'subject_name' => 'required|string|max:255',
                'total_marks' => 'required|integer',
                'teacher_id' => 'required|exists:teachers,id',
            ], [
                'teacher_id' => 'Please Select Teacher',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $subject = Subject::find($request->id);
            if (!$subject) {
                return response()->json(['message' => 'Subject not found'], 404);
            }

            Subject::where('id', $request->id)->update([
                'subject_name' => $request->input('subject_name'),
                'total_marks' => $request->input('total_marks'),
                'teacher_id' => $request->input('teacher_id'),
            ]);

            Session::flash('success_message', 'Subject Updated Successfully!');
            return response()->json(['message' => 'Subject Updated successfully'], 200);

        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
