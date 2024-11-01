<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index() {
        // menampilkan data students dari database
        $students = Student::all();

        $data = [
            'message' => 'Get all students',
            'data' => $students
        ];

        return response()->json($data, 200);
    }
    public function store(Request $request) {
        // menangkap data request
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan
        ];

        // menggunakan model student untuk insert data
        $student = Student::create($input);

        $data = [
            'message' => 'Student is created succesfully',
            'data' => $student,
        ];

        // mengembalikan data (json) dan kode 201
        return response()->json($data, 201);
    }
    public function update(Request $request, $id){
        $student = Student::find($id);

        if ($student) {
            $input = [
                'nama' => $request->nama ?? $request->nama,
                'nim' => $request->nim ?? $request->nim, 
                'email' => $request->email ?? $request->email,
                'jurusan' => $request->jurusan ?? $request->jurusan,
            ];

            $student->update($input);

            $data = [
                'message' => 'Student is updated',
                'data' => $student,
            ];
            return response()->json($data, 200);
            
        } else {
            $data = [
                'message' => 'Data not found'
            ];
            return response()->json($data, 404);
        }
    }
    public function destroy($id){
        $student = Student::find($id);

        if ($student) {
            $student->delete();

            $data = [
                'message' => 'Student is deleted'
            ];
            return response()->json($data, 200);

        } else {
            $data = [
                'message' => 'Data not found'
            ];
            return response()->json($data, 404);
        }
    }

    public function show($id){
        $student = student::find($id);

        if ($student){
            $data = [
                'message' => 'Get detail student',
                'data' => $student,
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                'message' => 'Student not found',
            ];
            return response()->json($data, 404);
        }
    }
}
    