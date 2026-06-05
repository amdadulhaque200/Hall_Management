<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::with('author')->latest()->get();
        return view('admin.notices.index', compact('notices'));
    }

    public function create()
    {
        return view('admin.notices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        Notice::create([
            'title'      => $request->title,
            'body'       => $request->body,
            'created_by' => auth()->id(),
            'emailed'    => false,
        ]);

        return redirect()->route('admin.notices.index')
            ->with('success', 'Notice posted successfully!');
    }

    public function destroy(Notice $notice)
    {
        $notice->delete();
        return back()->with('success', 'Notice deleted!');
    }
}