<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class AdminComplaintController extends Controller
{
    // ADMIN DASHBOARD
    public function index()
    {
        $totalComplaints = Complaint::count();

        $pendingComplaints = Complaint::where(
            'status',
            'Pending'
        )->count();

        $processingComplaints = Complaint::where(
            'status',
            'Processing'
        )->count();

        $resolvedComplaints = Complaint::where(
            'status',
            'Resolved'
        )->count();

        $rejectedComplaints = Complaint::where(
            'status',
            'Rejected'
        )->count();

        $complaints = Complaint::latest()->paginate(10);

        return view('admin.complaints.index', compact(
            'totalComplaints',
            'pendingComplaints',
            'processingComplaints',
            'resolvedComplaints',
            'rejectedComplaints',
            'complaints'
        ));
    }

    // VIEW COMPLAINT DETAILS
    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);

        return view(
            'admin.complaints.show',
            compact('complaint')
        );
    }

    // UPDATE COMPLAINT STATUS
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Processing,Resolved,Rejected',
        ]);

        $complaint = Complaint::findOrFail($id);

        $complaint->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.complaints.show', $complaint->id)
            ->with('success', 'Complaint status updated successfully!');
    }
}