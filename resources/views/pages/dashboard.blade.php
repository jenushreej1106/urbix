@extends('layouts.app')

@section('title', 'Citizen Dashboard')

@section('content')

<style>
.dashboard-wrapper {
    min-height: 100vh;
    padding: 55px 6%;
    background: #080b16;
    color: white;
}

.welcome-section {
    padding: 35px;
    background: linear-gradient(120deg, #122d50, #111827);
    border: 1px solid #263653;
    border-radius: 18px;
    margin-bottom: 35px;
}

.welcome-section h1 {
    font-family: 'Orbitron', sans-serif;
    font-size: 28px;
}

.welcome-section h1 span {
    color: #00d4ff;
}

.welcome-section p {
    color: #aab5c8;
    margin-top: 12px;
}

.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 35px;
}

.stat-card {
    padding: 25px;
    background: #111827;
    border: 1px solid #263653;
    border-radius: 15px;
    transition: .3s;
}

.stat-card:hover {
    transform: translateY(-6px);
    border-color: #00d4ff;
    box-shadow: 0 0 20px rgba(0,212,255,.2);
}

.stat-card p {
    color: #9ba8bd;
    font-size: 12px;
    margin-bottom: 15px;
}

.stat-card h2 {
    color: #00d4ff;
    font-size: 32px;
}

.stat-card.pending h2 {
    color: #ffbf47;
}

.stat-card.processing h2 {
    color: #4da6ff;
}

.stat-card.resolved h2 {
    color: #00e6a0;
}

.section-card {
    background: #111827;
    border: 1px solid #263653;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 25px;
}

.section-card h2 {
    margin-bottom: 25px;
}

.section-card h2 span {
    color: #00d4ff;
}

.complaint-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 650px;
}

.complaint-table th {
    text-align: left;
    padding: 15px;
    color: #00d4ff;
    font-size: 12px;
    border-bottom: 1px solid #263653;
}

.complaint-table td {
    padding: 16px 15px;
    color: #dce4f2;
    font-size: 13px;
    border-bottom: 1px solid #263653;
}

.table-scroll {
    overflow-x: auto;
}

.status {
    display: inline-block;
    padding: 7px 12px;
    border-radius: 20px;
    font-size: 11px;
}

.status.Pending {
    background: #47391c;
    color: #ffcc66;
}

.status.Processing {
    background: #183a59;
    color: #69bdff;
}

.status.Resolved {
    background: #124536;
    color: #56e6b1;
}

.status.Rejected {
    background: #4b202b;
    color: #ff8197;
}

.action-buttons {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 25px;
}

.action-btn {
    display: inline-block;
    padding: 13px 20px;
    border-radius: 8px;
    background: linear-gradient(90deg, #007cf0, #00d4ff);
    color: white;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: .3s;
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 0 20px rgba(0,212,255,.35);
}

.empty-message {
    text-align: center;
    color: #8994aa;
    padding: 30px;
}

@media(max-width: 900px) {
    .dashboard-stats {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(max-width: 550px) {
    .dashboard-stats {
        grid-template-columns: 1fr;
    }

    .welcome-section h1 {
        font-size: 21px;
    }

    .dashboard-wrapper {
        padding: 30px 4%;
    }
}
</style>

<div class="dashboard-wrapper">

    <div class="welcome-section">

        <h1>
            WELCOME, <span>{{ strtoupper($user->name) }}</span>
        </h1>

        <p>
            Your URBIX Citizen Dashboard.
            Monitor and manage your city complaints.
        </p>

        <div class="action-buttons">

            <a href="{{ route('report') }}" class="action-btn">
                + Report a Problem
            </a>

            <a href="{{ route('my-complaints') }}" class="action-btn">
                My Complaints
            </a>

        </div>

    </div>

    {{-- STATISTICS --}}

    <div class="dashboard-stats">

        <div class="stat-card">
            <p>TOTAL COMPLAINTS</p>
            <h2>{{ $totalComplaints }}</h2>
        </div>

        <div class="stat-card pending">
            <p>PENDING</p>
            <h2>{{ $pendingComplaints }}</h2>
        </div>

        <div class="stat-card processing">
            <p>PROCESSING</p>
            <h2>{{ $processingComplaints }}</h2>
        </div>

        <div class="stat-card resolved">
            <p>RESOLVED</p>
            <h2>{{ $resolvedComplaints }}</h2>
        </div>

    </div>

    {{-- RECENT COMPLAINTS --}}

    <div class="section-card">

        <h2>RECENT <span>COMPLAINTS</span></h2>

        <div class="table-scroll">

            <table class="complaint-table">

                <thead>
                    <tr>
                        <th>Complaint ID</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($recentComplaints as $complaint)

                        <tr>

                            <td>{{ $complaint->complaint_id }}</td>

                            <td>{{ $complaint->category }}</td>

                            <td>{{ $complaint->title }}</td>

                            <td>
                                <span class="status {{ $complaint->status }}">
                                    {{ $complaint->status }}
                                </span>
                            </td>

                            <td>
                                {{ $complaint->created_at->format('d M Y') }}
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="empty-message">
                                You haven't submitted any complaints yet.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- LOGOUT --}}

    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button type="submit" class="action-btn">
            LOGOUT →
        </button>
    </form>

</div>

@endsection