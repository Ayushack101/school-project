<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClassEntity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ClassEntityController extends Controller
{
    public function showClass()
    {
        $class = ClassEntity::all();
        return view('pages/class', compact('class'));
    }

    public function addClass(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'class_name' => 'required|string|max:500|unique:class_entitys',
                'numeric_name' => 'required|string|unique:class_entitys',
                'monthly_fee' => 'required|integer|min:0',
                'development_fee' => 'required|integer|min:0',
                'exam_fee' => 'required|integer|min:0',
                'extra_activities' => 'required|integer|min:0',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $classEntity = new ClassEntity();
            $classEntity->class_name = $req->input('class_name');
            $classEntity->numeric_name = $req->input('numeric_name');
            $classEntity->monthly_fee = $req->input('monthly_fee');
            $classEntity->development_fee = $req->input('development_fee');
            $classEntity->exam_fee = $req->input('exam_fee');
            $classEntity->extra_activities = $req->input('extra_activities');

            $classEntity->save();
            // $req->session()->flash('success_message', 'New Class Created Successfully!');
            Session::flash('success_message', 'New Class Created Successfully!');
            return response()->json(['message' => 'Class created successfully'], 201);

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

    public function deleteClass(string $class_id)
    {
        try {
            $class = ClassEntity::find($class_id);
            if (!$class) {
                return response()->json(['message' => 'Class not found'], 404);
            }

            $delete_class = ClassEntity::where('id', $class_id)->delete();
            if ($delete_class) {
                Session::flash('success_message', 'Class deleted successfully!');
                return response()->json(['message' => 'Class deleted successfully'], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateClass(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'class_name' => 'required|string|max:500|unique:class_entitys,class_name,' . $request->id,
                'numeric_name' => 'required|string|unique:class_entitys,numeric_name,' . $request->id,
                'monthly_fee' => 'required|integer|min:0',
                'development_fee' => 'required|integer|min:0',
                'exam_fee' => 'required|integer|min:0',
                'extra_activities' => 'required|integer|min:0',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $class = ClassEntity::find($request->id);
            if (!$class) {
                return response()->json(['message' => 'Class not found'], 404);
            }

            ClassEntity::where('id', $request->id)->update([
                'class_name' => $request->class_name,
                'numeric_name' => $request->numeric_name,
                'monthly_fee' => $request->monthly_fee,
                'development_fee' => $request->development_fee,
                'exam_fee' => $request->exam_fee,
                'extra_activities' => $request->extra_activities,
            ]);

            Session::flash('success_message', 'Class Updated Successfully!');
            return response()->json(['message' => 'Class Updated successfully'], 200);

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
