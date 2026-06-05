<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Fee;

class FeeController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;
        $fees = Fee::where('student_id', $student->id)->latest()->get();
        return view('student.fees.index', compact('fees', 'student'));
    }
}