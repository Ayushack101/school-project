<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TeacherController extends Controller
{
    public function showTeacher()
    {
        $teachers = Teacher::all();
        foreach ($teachers as $teacher) {
            if ($teacher->photo_path) {
                $teacher->photo_path = Storage::url($teacher->photo_path);
            }
        }

        return view('pages/teacher', compact('teachers'));
    }
    public function addTeacher()
    {
        return view('pages/teacher-add');
    }

    public function storeTeacher(Request $req)
    {
        try {
            $validator = Validator::make($req->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'dob' => 'required|date',
                'age' => 'required|integer|min:0',
                'contact' => 'required|string|max:10|min:9',
                'email' => 'required|email|max:255|unique:teachers',
                'address' => 'required|string',
                'city' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'registration_date' => 'required|date',
                'job_type' => 'required|string|max:255',
                'photo_path' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:5120',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
                // return redirect()->back()->withErrors($validator)->withInput();
            }

            $teacher = new Teacher();
            $teacher->first_name = $req->input('first_name');
            $teacher->last_name = $req->input('last_name');
            $teacher->dob = $req->input('dob');
            $teacher->age = $req->input('age');
            $teacher->contact = $req->input('contact');
            $teacher->email = $req->input('email');
            $teacher->address = $req->input('address');
            $teacher->city = $req->input('city');
            $teacher->country = $req->input('country');
            $teacher->registration_date = $req->input('registration_date');
            $teacher->job_type = $req->input('job_type');
            $teacher->photo_path = $req->input('photo_path');

            if ($req->hasFile('photo_path')) {
                $file = $req->file('photo_path');
                $path = $file->store('photos', 'public');
                $teacher->photo_path = $path;
            }

            $teacher->save();

            return redirect()->route('view.teacher')->with('success_message', 'New Teacher Created Successfully!');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function deleteTeacher(string $teacher_id)
    {
        try {
            $teacher = Teacher::find($teacher_id);
            if (!$teacher) {
                return response()->json(['message' => 'Teacher not found'], 404);
            }

            if ($teacher->photo_path) {
                Storage::disk('public')->delete($teacher->photo_path);
            }

            $teacher->delete();
            Session::flash('success_message', 'Teacher deleted successfully!');
            return response()->json(['message' => 'Teacher deleted successfully'], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function editTeacher(string $teacher_id)
    {
        $teachers = Teacher::find($teacher_id);
        if (!$teachers) {
            return response()->json(['message' => 'Teacher not found'], 404);
        }
        if ($teachers->photo_path) {
            $teachers->photo_path = Storage::url($teachers->photo_path);
        }
        return view('pages/teacher-edit', compact('teachers'));
    }

    public function updateTeacher(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'dob' => 'required|date',
                'age' => 'required|integer|min:0',
                'contact' => 'required|string|max:10|min:9',
                'email' => 'required|email|max:255|unique:teachers,email,' . $request->id,
                'address' => 'required|string',
                'city' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'registration_date' => 'required|date',
                'job_type' => 'required|string|max:255',
                'photo_path' => 'nullable|file|mimes:jpeg,png,jpg,webp|max:5120',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $teacher = Teacher::find($request->id);
            if (!$teacher) {
                return response()->json(['message' => 'Teacher not found'], 404);
            }

            Teacher::where('id', $request->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'dob' => $request->dob,
                'age' => $request->age,
                'contact' => $request->contact,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'registration_date' => $request->registration_date,
                'job_type' => $request->job_type,
            ]);

            // Handle file upload if present
            if ($request->hasFile('photo_path')) {
                // Delete the old photo if it exists
                if ($teacher->photo_path) {
                    Storage::disk('public')->delete($teacher->photo_path);
                }

                $file = $request->file('photo_path');
                $path = $file->store('photos', 'public');

                Teacher::where('id', $request->id)->update(['photo_path' => $path]);
            }

            return redirect()->back()->with('success_message', 'Teacher Updated Successfully!');

        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }
}
