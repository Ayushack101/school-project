<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClassEntity;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class SectionController extends Controller
{
    public function showSection(Request $req)
    {
        $classes = ClassEntity::select('id', 'class_name', 'numeric_name')->get();

        if ($classes->isEmpty()) {
            $sections = collect();
            $teachers = Teacher::select('id', 'first_name', 'last_name')->get();
            return view('pages/section', compact('sections', 'classes', 'teachers'));
        }

        $classId = $req->input('class_id') ?? $classes->first()->id;
        $sections = Section::with('teacher')->where('class_id', $classId)->get();
        $teachers = Teacher::select('id', 'first_name', 'last_name')->get();

        if ($req->ajax()) {
            return view('partials/section_table', compact('sections'))->render();
        }

        return view('pages/section', compact('sections', 'classes', 'teachers'));
    }

    public function addSection(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'section_name' => 'required|string|max:255',
                'teacher_id' => 'required|exists:teachers,id',
                'class_id' => 'required|exists:class_entitys,id'
            ], [
                'teacher_id' => 'Please Select Teacher',
                'class_id' => 'Please Select Class',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $section = new Section();
            $section->section_name = $request->input('section_name');
            $section->teacher_id = $request->input('teacher_id');
            $section->class_id = $request->input('class_id');
            $section->save();

            Session::flash('success_message', 'New Section Created Successfully!');
            return response()->json(['message' => 'New Section Created successfully'], 200);

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

    public function deleteSection(string $section_id)
    {
        try {
            $section = Section::find($section_id);
            if (!$section) {
                return response()->json(['message' => 'Section not found'], 404);
            }

            $section->delete(); // Delete the section directly
            Session::flash('success_message', 'Section deleted successfully!');
            return response()->json(['message' => 'Section deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateSection(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'section_name' => 'required|string|max:255',
                'teacher_id' => 'required|exists:teachers,id',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $teacher = Section::find($request->id);
            if (!$teacher) {
                return response()->json(['message' => 'Section not found'], 404);
            }

            Section::where('id', $request->id)->update([
                'section_name' => $request->input('section_name'),
                'teacher_id' => $request->input('teacher_id'),
            ]);

            Session::flash('success_message', 'Section Updated Successfully!');
            return response()->json(['message' => 'Section Updated successfully'], 200);

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
