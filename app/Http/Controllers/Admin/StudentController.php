<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('room')->latest()->get();
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('admin.students.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users',
            'border_number' => 'required|unique:students',
            'roll_number'   => 'required|unique:students',
            'department'    => 'required',
            'session'       => 'required',
            'phone'         => 'nullable',
            'room_id'       => 'nullable|exists:rooms,id',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('student');

        Student::create([
            'user_id'       => $user->id,
            'name'          => $request->name,
            'border_number' => $request->border_number,
            'roll_number'   => $request->roll_number,
            'department'    => $request->department,
            'session'       => $request->session,
            'phone'         => $request->phone,
            'room_id'       => $request->room_id,
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student added successfully!');
    }

    public function edit(Student $student)
    {
        $rooms = Room::all();
        return view('admin.students.edit', compact('student', 'rooms'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'department' => 'required',
            'session'    => 'required',
            'phone'      => 'nullable',
            'room_id'    => 'nullable|exists:rooms,id',
        ]);

        $student->update($request->only(
            'name', 'department', 'session', 'phone', 'room_id'
        ));

        return redirect()->route('admin.students.index')
            ->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->user->delete();
        return redirect()->route('admin.students.index')
            ->with('success', 'Student deleted successfully!');
    }
}