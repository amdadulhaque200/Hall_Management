<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Student;

// Public home page
Route::get('/', function () {
    $notices = \App\Models\Notice::latest()->take(3)->get();
    return view('welcome', compact('notices'));
})->name('home');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Students
    Route::resource('students', Admin\StudentController::class);

    // Rooms
    Route::resource('rooms', Admin\RoomController::class);

    // Fees
    Route::get('/fees', [Admin\FeeController::class, 'index'])->name('fees.index');
    Route::get('/fees/create', [Admin\FeeController::class, 'create'])->name('fees.create');
    Route::post('/fees', [Admin\FeeController::class, 'store'])->name('fees.store');
    Route::patch('/fees/{fee}/mark-paid', [Admin\FeeController::class, 'markPaid'])->name('fees.markPaid');

    // Notices
    Route::resource('notices', Admin\NoticeController::class);

    // Complaints
    Route::get('/complaints', [Admin\ComplaintController::class, 'index'])->name('complaints.index');
    Route::post('/complaints/{complaint}/reply', [Admin\ComplaintController::class, 'reply'])->name('complaints.reply');
    // Meals
    Route::get('/meals', [\App\Http\Controllers\Admin\MealController::class, 'index'])->name('meals.index');
});

// Student Routes
Route::prefix('student')->name('student.')->middleware(['auth', 'role:student'])->group(function () {
    Route::get('/dashboard', [Student\DashboardController::class, 'index'])->name('dashboard');

    // Meals
    Route::get('/meals', [Student\MealController::class, 'index'])->name('meals.index');
    Route::post('/meals/toggle', [Student\MealController::class, 'toggle'])->name('meals.toggle');

    // Fees
    Route::get('/fees', [Student\FeeController::class, 'index'])->name('fees.index');

    // Complaints
    Route::get('/complaints', [Student\ComplaintController::class, 'index'])->name('complaints.index');
    Route::post('/complaints', [Student\ComplaintController::class, 'store'])->name('complaints.store');

    // Notices
    Route::get('/notices', [\App\Http\Controllers\Student\NoticeController::class, 'index'])->name('notices.index');
});

require __DIR__.'/auth.php';