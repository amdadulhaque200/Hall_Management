<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $student = auth()->user()->student;
        return view('student.profile.edit', compact('student'));
    }

    public function update(Request $request)
{
    $request->validate([
        'phone'    => 'required|string|max:15',
        'password' => 'nullable|min:6|confirmed',
        'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $student = auth()->user()->student;

    $data = ['phone' => $request->phone];

    if ($request->hasFile('photo')) {
        // Delete old photo
        if ($student->photo) {
            \Storage::disk('public')->delete($student->photo);
        }
        $data['photo'] = $request->file('photo')->store('photos', 'public');
    }

    $student->update($data);

    if ($request->filled('password')) {
        auth()->user()->update([
            'password' => bcrypt($request->password)
        ]);
    }

    return back()->with('success', 'Profile updated successfully!');
}
}