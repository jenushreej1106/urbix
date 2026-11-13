@extends('layouts.app')

@section('title', 'URBIX Admin Dashboard')

@section('content')

<style>
/* =========================================
   URBIX ADMIN DASHBOARD
========================================= */

.admin-wrapper {
    width: 100%;
    min-height: calc(100vh - 80px);
    padding: 110px 6% 60px;
    background: #080b16;
    color: #ffffff;
    box-sizing: border-box;
    position: relative;
    overflow: visible;
}

/* HEADING */

.admin-heading {
    width: 100%;
    margin-bottom: 35px;
    position: relative;
    z-index: 2;
}

.admin-heading h1 {
    font-family: 'Orbitron', sans-serif;
    font-size: clamp(24px, 3vw, 34px);
    font-weight: 700;
    color: #ffffff;
    margin: 0;
    line-height: 1.4;
}

.admin-heading h1 span {
    color: #00d4ff;
}

.admin-heading p {
    color: #8994aa;
    margin-top: 10px;
    font-size: 14px;
}

/* STATISTICS */

.admin-stats {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 18px;
    margin-bottom: 40px;
}

.stat-card {
    background: linear-gradient(145deg, #151d31, #0e1424);
    border: 1px solid #263653;
    border-radius: 15px;
    padding: 25px 20px;
    transition: all .3s ease;
    min-width: 0;
}

.stat-card:hover {
    transform: translateY(-6px);
    border-color: #00d4ff;
    box-shadow: 0 0 25px rgba(0,212,255,.2);
}

.stat-card p {
    color: #9ba8bd;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 1px;
    margin: 0 0 15px;
}

.stat-card h2 {
    font-size: 32px;
    color: #00d4ff;
    margin: 0;
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

.stat-card.rejected h2 {
    color: #ff5577;
}

/* TABLE CONTAINER */

.table-container {
    width: 100%;
    background: #111827;
    border: 1px solid #263653;
    border-radius: 15px;
    padding: 25px;
    box-sizing: border-box;
    overflow-x: auto;
}

.table-heading {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    gap: 15px;
}

.table-heading h2 {
    font-size: 21px;
    color: #ffffff;
    margin: 0;
}

.table-heading h2 span,
.table-heading > span {
    color: #00d4ff;
}

.table-heading > span {
    font-size: 12px;
    letter-spacing: 1px;
}

/* SUCCESS MESSAGE */

.admin-success {
    background: #124536;
    color: #56e6b1;
    padding: 14px;
    border-radius: 8px;
    margin-bottom: 20px;
}

/* TABLE */

.admin-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 750px;
}

.admin-table th {
    text-align: left;
    padding: 15px;
    color: #00d4ff;
    font-size: 12px;
    text-transform: uppercase;
    border-bottom: 1px solid #263653;
    white-space: nowrap;
}

.admin-table td {
    padding: 17px 15px;
    border-bottom: 1px solid #202b40;
    color: #dce4f2;
    font-size: 13px;
}

.admin-table tbody tr {
    transition: background .3s ease;
}

.admin-table tbody tr:hover {
    background: #182238;
}

.empty-message {
    text-align: center;
    padding: 35px !important;
    color: #8994aa !important;
}

/* STATUS BADGES */

.status {
    padding: 7px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    display: inline-block;
    white-space: nowrap;
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

/* VIEW BUTTON */

.view-btn {
    display: inline-block;
    padding: 9px 15px;
    border-radius: 7px;
    background: linear-gradient(90deg, #007cf0, #00d4ff);
    color: #ffffff;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
    transition: all .3s ease;
}

.view-btn:hover {
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 0 18px rgba(0,212,255,.5);
}

/* PAGINATION */

.pagination {
    margin-top: 25px;
}

.pagination nav {
    display: flex;
    justify-content: center;
}

.pagination a,
.pagination span {
    color: #00d4ff;
}

/* TABLE SCROLLBAR */

.table-container::-webkit-scrollbar {
    height: 7px;
}

.table-container::-webkit-scrollbar-track {
    background: #080b16;
}

.table-container::-webkit-scrollbar-thumb {
    background: #00a8cc;
    border-radius: 10px;
}

/* TABLET */

@media(max-width: 1100px) {
    .admin-stats {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }
}

/* MOBILE */

@media(max-width: 700px) {

    .admin-wrapper {
        padding: 100px 4% 40px;
    }

    .admin-stats {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .stat-card {
        padding: 20px 15px;
    }

    .stat-card h2 {
        font-size: 27px;
    }

    .stat-card p {
        font-size: 10px;
    }

    .admin-heading h1 {
        font-size: 23px;
    }

    .table-container {
        padding: 18px;
    }

    .table-heading {
        align-items: flex-start;
        flex-direction: column;
    }
}

@media(max-width: 400px) {

    .admin-stats {
        grid-template-columns: 1fr;
    }

}
</style>

<div class="admin-wrapper">

    {{-- ADMIN HEADING --}}

    <div class="admin-heading">

        <h1>
            URBIX <span>ADMIN PANEL</span>
        </h1>

        <p>
            Smart City Complaint Management Dashboard
        </p>

    </div>

    {{-- STATISTICS --}}

    <div class="admin-stats">

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

        <div class="stat-card rejected">

            <p>REJECTED</p>

            <h2>{{ $rejectedComplaints }}</h2>

        </div>

    </div>

    {{-- COMPLAINT TABLE --}}

    <div class="table-container">

        <div class="table-heading">

            <h2>
                All <span>Complaints</span>
            </h2>

            <span>URBIX MANAGEMENT</span>

        </div>

        {{-- SUCCESS MESSAGE --}}

        @if(session('success'))

            <div class="admin-success">
                {{ session('success') }}
            </div>

        @endif

        {{-- COMPLAINTS TABLE --}}

        <table class="admin-table">

            <thead>

                <tr>
                    <th>Complaint ID</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

                @forelse($complaints as $complaint)

                    <tr>

                        <td>
                            {{ $complaint->complaint_id }}
                        </td>

                        <td>
                            {{ $complaint->category }}
                        </td>

                        <td>
                            {{ $complaint->title }}
                        </td>

                        <td>
                            {{ $complaint->location }}
                        </td>

                        <td>

                            <span class="status {{ $complaint->status }}">
                                {{ $complaint->status }}
                            </span>

                        </td>

                        <td>
                            {{ $complaint->created_at->format('d M Y') }}
                        </td>

                        <td>

                            <a
                                href="{{ route('admin.complaints.show', $complaint->id) }}"
                                class="view-btn">

                                View Details

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="empty-message">
                            No complaints found.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

        {{-- PAGINATION --}}

        <div class="pagination">

            {{ $complaints->links() }}

        </div>

    </div>

</div>

@endsection