<?php
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index()
    {
        $student = auth()->user()->student;
        $meals = Meal::where('student_id', $student->id)->latest()->get();
        return view('student.meals.index', compact('meals', 'student'));
    }

    public function toggle(Request $request)
    {
        $student = auth()->user()->student;
        $date = now()->addDay()->toDateString();

        $meal = Meal::firstOrCreate(
            ['student_id' => $student->id, 'date' => $date],
            ['status' => 'on']
        );

        $meal->update([
            'status' => $meal->status === 'on' ? 'off' : 'on'
        ]);

        return back()->with('success', 'Meal status updated!');
    }
}