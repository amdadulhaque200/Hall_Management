<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Room;
use App\Models\Fee;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();
        $totalRooms = Room::count();
        $pendingFees = Fee::where('status', 'unpaid')->count();
        $paidFees = Fee::where('status', 'paid')->count();
        $pendingComplaints = Complaint::where('status', 'pending')->count();

        // Room occupancy data
        $rooms = Room::withCount('students')->get();
        $roomLabels = $rooms->pluck('room_number')->toArray();
        $roomOccupied = $rooms->pluck('students_count')->toArray();
        $roomCapacity = $rooms->pluck('capacity')->toArray();

        // Monthly fee collection for current year
        $monthlyFees = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyFees[] = Fee::where('status', 'paid')
                ->where('month', $m)
                ->where('year', date('Y'))
                ->sum('amount');
        }

        return view('admin.dashboard', compact(
            'totalStudents', 'totalRooms', 'pendingFees',
            'paidFees', 'pendingComplaints', 'roomLabels',
            'roomOccupied', 'roomCapacity', 'monthlyFees'
        ));
    }
}