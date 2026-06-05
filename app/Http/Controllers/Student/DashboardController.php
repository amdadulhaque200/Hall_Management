<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;
        return view('student.dashboard', compact('student'));
    }
}