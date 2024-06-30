<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ClassEntity;
use App\Models\Section;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    public function addStudent()
    {
        $classes = ClassEntity::select('id', 'class_name', 'numeric_name')->get();
        $sectionsClass = Section::select('id', 'section_name')->get();
        $currentDate = Carbon::now()->toDateString();

        return view('pages/add-student', compact('currentDate', 'classes', 'sectionsClass'));
    }

    public function getSections($class_id)
    {
        $sections = Section::where('class_id', $class_id)->select('id', 'section_name')->get();
        return response()->json($sections);
    }

    public function storeStudent(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'student_name' => 'required|string|max:255',
                'mother_name' => 'required|string|max:255',
                'father_name' => 'required|string|max:255',
                'rollno' => 'nullable|integer', //c
                'disease_name' => 'nullable|string|max:255',
                'blood_group' => 'nullable|string|max:5',
                'is_paralysed' => 'string|nullable',
                'documents_attached' => 'required|array', // c
                'age_proof' => 'nullable|string|max:255',
                'parents_identity_docs' => 'required|array',
                'student_hobby' => 'nullable|string|max:255',
                'student_interests' => 'nullable|string|max:255',
                'disease' => 'nullable|string|max:255',
                'extra_details_of_student' => 'nullable|string',
                'admission_class' => 'nullable|exists:class_entitys,id',
                'section' => 'nullable|exists:sections,id',
                'dob' => 'required|date',
                'gender' => 'required|string|max:10',
                'weight' => 'nullable|numeric',
                'height' => 'nullable|string',
                'religion' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'permanent_address' => 'required|string',
                'postal_address' => 'required|string',
                'phone_no' => 'required|string|max:10',
                'alternate_phone_no' => 'nullable|string|max:10',
                'area' => 'required|string|max:255',
                'fathers_occupation' => 'nullable|string|max:255',
                'mothers_occupation' => 'nullable|string|max:255',
                'bpl_no' => 'nullable|string|max:255',
                'aadhar_card_student' => 'required|string|max:12',
                'aadhar_card_parent' => 'required|string|max:12',
                'bank_account_no' => 'required|string|max:255',
                'ifsc_code' => 'required|string|max:255',
                'email' => 'nullable|email|unique:students', //c
                'native_language' => 'nullable|string|max:255',
                'previous_school' => 'nullable|string|max:255',
                'gurdian_name' => 'nullable|string|max:255',
                'admission_no' => 'required|string|max:255',//c
                'admission_date' => 'required|date',
                'photo_path' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $studentDetail = new Student();
            $studentDetail->student_name = $request->input('student_name');
            $studentDetail->mother_name = $request->input('mother_name');
            $studentDetail->father_name = $request->input('father_name');
            $studentDetail->rollno = 0;
            $studentDetail->disease_name = $request->input('disease_name');
            $studentDetail->blood_group = $request->input('blood_group');
            $studentDetail->is_paralysed = $request->input('is_paralysed');
            $studentDetail->documents_attached = json_encode($request->input('documents_attached', []));
            $studentDetail->age_proof = $request->input('age_proof');
            $studentDetail->parents_identity_docs = json_encode($request->input('parents_identity_docs', []));
            $studentDetail->student_hobby = $request->input('student_hobby');
            $studentDetail->student_interests = $request->input('student_interests');
            $studentDetail->disease = $request->input('disease');
            $studentDetail->extra_details_of_student = $request->input('extra_details_of_student');
            $studentDetail->admission_class = $request->input('admission_class');
            $studentDetail->section = $request->input('section');
            $studentDetail->dob = $request->input('dob');
            $studentDetail->gender = $request->input('gender');
            $studentDetail->weight = $request->input('weight');
            $studentDetail->height = $request->input('height');
            $studentDetail->religion = $request->input('religion');
            $studentDetail->category = $request->input('category');
            $studentDetail->permanent_address = $request->input('permanent_address');
            $studentDetail->postal_address = $request->input('postal_address');
            $studentDetail->phone_no = $request->input('phone_no');
            $studentDetail->alternate_phone_no = $request->input('alternate_phone_no');
            $studentDetail->area = $request->input('area');
            $studentDetail->fathers_occupation = $request->input('fathers_occupation');
            $studentDetail->mothers_occupation = $request->input('mothers_occupation');
            $studentDetail->bpl_no = $request->input('bpl_no');
            $studentDetail->aadhar_card_student = $request->input('aadhar_card_student');
            $studentDetail->aadhar_card_parent = $request->input('aadhar_card_parent');
            $studentDetail->bank_account_no = $request->input('bank_account_no');
            $studentDetail->ifsc_code = $request->input('ifsc_code');
            $studentDetail->email = $request->input('email');
            $studentDetail->native_language = $request->input('native_language');
            $studentDetail->previous_school = $request->input('previous_school');
            $studentDetail->gurdian_name = $request->input('gurdian_name');
            $studentDetail->admission_no = $request->input('admission_no');
            $studentDetail->admission_date = $request->input('admission_date');

            if ($request->hasFile('photo_path')) {
                $file = $request->file('photo_path');
                $photoPath = $file->store('student_photos', 'public');
                $studentDetail->photo_path = $photoPath;
            }

            $studentDetail->save();

            return redirect()->route('view.student')->with('success_message', 'New Student Created Successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function showStudent(Request $req)
    {
        $classes = ClassEntity::select('id', 'class_name', 'numeric_name')->get();

        if ($classes->isEmpty()) {
            $students = collect();
            $sections = [];
            return view('pages/student', compact('students', 'classes', 'sections'));
        }

        $classId = $req->input('class_id') ?? $classes->first()->id;
        $sectionId = $req->input('section_id');

        $studentsQuery = Student::with('classEntity', 'sectionDetails')->where('admission_class', $classId);

        if ($sectionId) {
            $studentsQuery->where('section', $sectionId);
        }
        $students = $studentsQuery->orderBy('rollno', 'asc')->get();

        foreach ($students as $student) {
            if ($student->photo_path) {
                $student->photo_path = Storage::url($student->photo_path);
            }
        }
        $sections = Section::where('class_id', $classId)->select('id', 'section_name')->get();
        if ($req->ajax()) {
            return view('partials/student_table', compact('students'))->render();
        }

        return view('pages/student', compact('students', 'classes', 'sections'));
    }

    public function editStudent(string $student_id)
    {
        $student = Student::find($student_id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->documents_attached = json_decode($student->documents_attached, true);
        $student->parents_identity_docs = json_decode($student->parents_identity_docs, true);

        $classes = ClassEntity::select('id', 'class_name', 'numeric_name')->get();
        $sectionsClass = Section::select('id', 'section_name')->get();

        if ($student->photo_path) {
            $student->photo_path = Storage::url($student->photo_path);
        }
        return view('pages/student-edit', compact('student', 'classes', 'sectionsClass'));
    }


    public function updateStudent(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'student_name' => 'required|string|max:255',
                'mother_name' => 'required|string|max:255',
                'father_name' => 'required|string|max:255',
                'rollno' => 'nullable|integer',
                'disease_name' => 'nullable|string|max:255',
                'blood_group' => 'nullable|string|max:3',
                'is_paralysed' => 'string|nullable',
                'documents_attached' => 'required|array',
                'age_proof' => 'nullable|string|max:255',
                'parents_identity_docs' => 'required|array',
                'student_hobby' => 'nullable|string|max:255',
                'student_interests' => 'nullable|string|max:255',
                'disease' => 'nullable|string|max:255',
                'extra_details_of_student' => 'nullable|string',
                'admission_class' => 'nullable|exists:class_entitys,id',
                'section' => 'nullable|exists:sections,id',
                'dob' => 'required|date',
                'weight' => 'nullable|numeric',
                'height' => 'nullable|string',
                'religion' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'permanent_address' => 'required|string',
                'postal_address' => 'required|string',
                'phone_no' => 'required|string|max:10',
                'alternate_phone_no' => 'nullable|string|max:10',
                'area' => 'required|string|max:255',
                'fathers_occupation' => 'nullable|string|max:255',
                'mothers_occupation' => 'nullable|string|max:255',
                'bpl_no' => 'nullable|string|max:255',
                'aadhar_card_student' => 'required|string|max:12',
                'aadhar_card_parent' => 'required|string|max:12',
                'bank_account_no' => 'required|string|max:255',
                'ifsc_code' => 'required|string|max:255',
                'email' => 'nullable|email|unique:students,email,' . $request->id,
                'native_language' => 'nullable|string|max:255',
                'previous_school' => 'nullable|string|max:255',
                'gurdian_name' => 'nullable|string|max:255',
                'admission_no' => 'required|string|max:255',
                'admission_date' => 'required|date',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            ]);


            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $studentDetail = Student::find($request->id);
            if (!$studentDetail) {
                return response()->json(['message' => 'Student not found'], 404);
            }

            Student::where('id', $request->id)->update([
                'student_name' => $request->input('student_name'),
                'mother_name' => $request->input('mother_name'),
                'father_name' => $request->input('father_name'),
                'rollno' => $request->input('rollno'),
                'disease_name' => $request->input('disease_name'),
                'blood_group' => $request->input('blood_group'),
                'is_paralysed' => $request->input('is_paralysed'),
                'documents_attached' => json_encode($request->input('documents_attached', [])),
                'age_proof' => $request->input('age_proof'),
                'parents_identity_docs' => json_encode($request->input('parents_identity_docs', [])),
                'student_hobby' => $request->input('student_hobby'),
                'student_interests' => $request->input('student_interests'),
                'disease' => $request->input('disease'),
                'extra_details_of_student' => $request->input('extra_details_of_student'),
                'admission_class' => $request->input('admission_class'),
                'section' => $request->input('section'),
                'dob' => $request->input('dob'),
                'weight' => $request->input('weight'),
                'height' => $request->input('height'),
                'religion' => $request->input('religion'),
                'category' => $request->input('category'),
                'permanent_address' => $request->input('permanent_address'),
                'postal_address' => $request->input('postal_address'),
                'phone_no' => $request->input('phone_no'),
                'alternate_phone_no' => $request->input('alternate_phone_no'),
                'area' => $request->input('area'),
                'fathers_occupation' => $request->input('fathers_occupation'),
                'mothers_occupation' => $request->input('mothers_occupation'),
                'bpl_no' => $request->input('bpl_no'),
                'aadhar_card_student' => $request->input('aadhar_card_student'),
                'aadhar_card_parent' => $request->input('aadhar_card_parent'),
                'bank_account_no' => $request->input('bank_account_no'),
                'ifsc_code' => $request->input('ifsc_code'),
                'email' => $request->input('email'),
                'native_language' => $request->input('native_language'),
                'previous_school' => $request->input('previous_school'),
                'gurdian_name' => $request->input('gurdian_name'),
                'admission_no' => $request->input('admission_no'),
                'admission_date' => $request->input('admission_date'),
            ]);

            if ($request->hasFile('photo_path')) {
                if ($studentDetail->photo_path) {
                    Storage::disk('public')->delete($studentDetail->photo_path);
                }

                $file = $request->file('photo_path');
                $photoPath = $file->store('student_photos', 'public');

                Student::where('id', $request->id)->update(['photo_path' => $photoPath]);
            }

            return redirect()->back()->with('success_message', 'Student Updated Successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function deleteStudent(string $student_id)
    {
        try {
            $student = Student::find($student_id);
            if (!$student) {
                return response()->json(['message' => 'Student not found'], 404);
            }
            if ($student->photo_path) {
                Storage::disk('public')->delete($student->photo_path);
            }

            $student->delete();

            Session::flash('success_message', 'Teacher deleted successfully!');
            return response()->json(['message' => 'Teacher deleted successfully'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Student not found'], 404);
        }
    }
}
