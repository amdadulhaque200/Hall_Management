<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::with('student')->latest()->get();
        return view('admin.fees.index', compact('fees'));
    }

    public function create()
    {
        $students = Student::all();
        return view('admin.fees.create', compact('students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'month'      => 'required|integer|min:1|max:12',
            'year'       => 'required|integer',
            'amount'     => 'required|numeric',
        ]);

        Fee::create($request->all());

        return redirect()->route('admin.fees.index')
            ->with('success', 'Fee record added!');
    }

    public function markPaid(Fee $fee)
    {
        $fee->update([
            'status'  => 'paid',
            'paid_at' => now(),
        ]);

        return back()->with('success', 'Fee marked as paid!');
    }
}