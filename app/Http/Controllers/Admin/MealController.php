<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use App\Models\Student;

class MealController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();
        $tomorrow = now()->addDay()->toDateString();

        $todayOn = Meal::where('date', $today)->where('status', 'on')->count();
        $todayOff = Meal::where('date', $today)->where('status', 'off')->count();
        $tomorrowOn = Meal::where('date', $tomorrow)->where('status', 'on')->count();
        $tomorrowOff = Meal::where('date', $tomorrow)->where('status', 'off')->count();

        $totalStudents = Student::count();

        $recentMeals = Meal::with('student')
            ->orderBy('date', 'desc')
            ->take(20)
            ->get();

        return view('admin.meals.index', compact(
            'todayOn', 'todayOff', 'tomorrowOn', 'tomorrowOff',
            'totalStudents', 'recentMeals', 'today', 'tomorrow'
        ));
    }
}