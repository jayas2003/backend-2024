<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\StudentResource;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index() {
        $students = Student::all();

        if($students) {
            $data = [
                'message' => 'Get all students',
                'data' => $students
            ];
        } else {
            $data = [
                'message' => 'Student is empty'
            ];
        }

        return response()->json($data, 200);
    }

public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'nim' => 'numeric|required',
            'email' => 'email|required',
            'jurusan' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation errors',
                'error' => $validator->errors()
            ], 422);
        }

        $students = Student::create($request->all());
        $data = [
            'message' => 'Student is created successfully',
            'data' => $students
        ];
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'jurusan' => 'required|string|max:255',
        ]);

        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->update($request->only(['nama', 'nim', 'email', 'jurusan']));

        return (new StudentResource($student))
            ->additional(['message' => 'Student updated successfully']);
    }

    public function destroy($id) {
        $student = Student::find($id);

        if ($student) {
            $student->delete();
            return response()->json(['message' => 'Student deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }

    public function show($id) {
        $student = Student::find($id);

        if ($student) {
            return (new StudentResource($student))
                ->additional(['message' => 'Get student details']);
        } else {
            return response()->json(['message' => 'Student not found'], 404);
        }
    }
}
