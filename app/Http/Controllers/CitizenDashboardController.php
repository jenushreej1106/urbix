<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class CitizenDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalComplaints = Complaint::where(
            'user_id',
            $user->id
        )->count();

        $pendingComplaints = Complaint::where('user_id', $user->id)
            ->where('status', 'Pending')
            ->count();

        $processingComplaints = Complaint::where('user_id', $user->id)
            ->where('status', 'Processing')
            ->count();

        $resolvedComplaints = Complaint::where('user_id', $user->id)
            ->where('status', 'Resolved')
            ->count();

        $recentComplaints = Complaint::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('pages.dashboard', compact(
            'user',
            'totalComplaints',
            'pendingComplaints',
            'processingComplaints',
            'resolvedComplaints',
            'recentComplaints'
        ));
    }
}