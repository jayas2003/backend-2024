<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Import DB facade

class Student extends Model
{
    protected $fillable = [
        'nama',
        'nim',
        'email',
        'jurusan'
    ];
    // Fungsi untuk mendapatkan semua data students
    public static function getAllStudents()
    {
        $students = DB::select('select * from students');
        return $students;
    }
}
