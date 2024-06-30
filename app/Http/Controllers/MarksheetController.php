<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClassEntity;
use App\Models\Marksheet;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class MarksheetController extends Controller
{
    public function showMarksheet(Request $req)
    {
        $classes = ClassEntity::select('id', 'class_name', 'numeric_name')->get();

        if ($classes->isEmpty()) {
            $marksheets = collect();
            return view('pages/marksheet', compact('marksheets', 'classes'));
        }

        $classId = $req->input('class_id') ?? $classes->first()->id;
        $marksheets = Marksheet::where('class_id', $classId)->get();
        if ($req->ajax()) {
            return view('partials/marksheet_table', compact('marksheets'))->render();
        }

        return view('pages/marksheet', compact('marksheets', 'classes'));
    }

    public function addMarksheet(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'marksheet_name' => 'required|string|max:255',
                'exam_date' => 'required|date',
                'class_id' => 'required|exists:class_entitys,id'
            ], [
                'class_id' => 'Please Select Class',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $marksheet = new Marksheet();
            $marksheet->marksheet_name = $request->input('marksheet_name');
            $marksheet->exam_date = $request->input('exam_date');
            $marksheet->class_id = $request->input('class_id');
            $marksheet->save();

            Session::flash('success_message', 'New Marksheet Created Successfully!');
            return response()->json(['message' => 'New Marksheet Created successfully'], 200);

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

    public function deleteMarksheet(string $marksheet_id)
    {
        try {
            $marksheet = Marksheet::find($marksheet_id);
            if (!$marksheet) {
                return response()->json(['message' => 'marksheet not found'], 404);
            }

            $marksheet->delete();
            Session::flash('success_message', 'marksheet deleted successfully!');
            return response()->json(['message' => 'marksheet deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateMarksheet(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'marksheet_name' => 'required|string|max:255',
                'exam_date' => 'required|date',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $marksheet = Marksheet::find($request->id);
            if (!$marksheet) {
                return response()->json(['message' => 'marksheet not found'], 404);
            }

            Marksheet::where('id', $request->id)->update([
                'marksheet_name' => $request->input('marksheet_name'),
                'exam_date' => $request->input('exam_date'),
            ]);

            Session::flash('success_message', 'marksheet Updated Successfully!');
            return response()->json(['message' => 'marksheet Updated successfully'], 200);

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
