<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::with('student')->latest()->get();
        return view('admin.complaints.index', compact('complaints'));
    }

    public function reply(Request $request, Complaint $complaint)
    {
        $request->validate([
            'admin_reply' => 'required|string',
        ]);

        $complaint->update([
            'admin_reply' => $request->admin_reply,
            'status'      => 'resolved',
        ]);

        return back()->with('success', 'Reply sent successfully!');
    }
}