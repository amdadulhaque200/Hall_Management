<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;
        $complaints = Complaint::where('student_id', $student->id)->latest()->get();
        return view('student.complaints.index', compact('complaints', 'student'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $student = auth()->user()->student;

        Complaint::create([
            'student_id' => $student->id,
            'subject'    => $request->subject,
            'message'    => $request->message,
        ]);

        return back()->with('success', 'Complaint submitted successfully!');
    }
}