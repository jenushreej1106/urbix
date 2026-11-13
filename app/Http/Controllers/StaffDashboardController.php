<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $totalComplaints = Complaint::count();

        $pendingComplaints = Complaint::where('status', 'Pending')->count();

        $processingComplaints = Complaint::where('status', 'Processing')->count();

        $resolvedComplaints = Complaint::where('status', 'Resolved')->count();

        $rejectedComplaints = Complaint::where('status', 'Rejected')->count();

        $recentComplaints = Complaint::latest()->take(10)->get();

        return view('staff.dashboard', compact(
            'totalComplaints',
            'pendingComplaints',
            'processingComplaints',
            'resolvedComplaints',
            'rejectedComplaints',
            'recentComplaints'
        ));
    }

    // UPDATE COMPLAINT STATUS
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Processing,Resolved',
        ]);

        $complaint = Complaint::findOrFail($id);

        $complaint->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('staff.dashboard')
            ->with('success', 'Complaint status updated successfully!');
    }
}