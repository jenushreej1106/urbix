@extends('layouts.app')

@section('title', 'Staff Dashboard')

@section('content')

<style>
/* ==============================
   STAFF DASHBOARD
============================== */

.staff-dashboard {
    min-height: 100vh;
    padding: 55px 6%;
    background: #080d19;
    color: #ffffff;
}

/* HEADER */

.staff-header {
    padding: 40px;
    border: 1px solid #263b5e;
    border-radius: 20px;
    background: linear-gradient(135deg, #132847, #101827);
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;
}

.staff-header::after {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #00d9ff, transparent);
    animation: goldenMove 4s linear infinite;
}

@keyframes goldenMove {
    100% {
        left: 100%;
    }
}

.staff-label {
    color: #00d9ff;
    letter-spacing: 3px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 15px;
}

.staff-header h1 {
    font-family: 'Orbitron', sans-serif;
    font-size: 30px;
    margin-bottom: 15px;
}

.staff-header h1 span {
    color: #00d9ff;
}

.staff-header p {
    color: #a9bad3;
    font-size: 15px;
}

/* STATISTICS */

.staff-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
    gap: 22px;
    margin-bottom: 40px;
}

.staff-stat {
    padding: 28px;
    border-radius: 17px;
    background: #121b2b;
    border: 1px solid #293d5b;
    transition: .3s ease;
}

.staff-stat:hover {
    transform: translateY(-7px);
    border-color: #00d9ff;
    box-shadow: 0 0 25px rgba(0,217,255,.2);
}

.staff-stat p {
    color: #9db1ce;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.staff-stat h2 {
    font-family: 'Orbitron', sans-serif;
    font-size: 32px;
    margin-top: 15px;
}

.stat-blue h2 {
    color: #00d9ff;
}

.stat-yellow h2 {
    color: #ffc247;
}

.stat-purple h2 {
    color: #a78bfa;
}

.stat-green h2 {
    color: #00e6a8;
}

.stat-red h2 {
    color: #ff647c;
}

/* ALERTS */

.staff-alert {
    padding: 15px 20px;
    border-radius: 10px;
    margin-bottom: 22px;
    font-size: 14px;
}

.staff-success {
    background: #104333;
    border: 1px solid #00e6a8;
    color: #00e6a8;
}

.staff-error {
    background: #4b2029;
    border: 1px solid #ff647c;
    color: #ff8092;
}

/* TABLE SECTION */

.staff-table-section {
    background: #121b2b;
    border: 1px solid #293d5b;
    border-radius: 18px;
    padding: 30px;
    overflow-x: auto;
}

.staff-table-section h2 {
    font-family: 'Orbitron', sans-serif;
    font-size: 20px;
    margin-bottom: 25px;
}

.staff-table {
    width: 100%;
    border-collapse: collapse;
    min-width: 1000px;
}

.staff-table th {
    color: #00d9ff;
    text-align: left;
    padding: 16px;
    border-bottom: 1px solid #293d5b;
    font-size: 12px;
    white-space: nowrap;
}

.staff-table td {
    padding: 17px 16px;
    color: #d5dfed;
    border-bottom: 1px solid #25334a;
    font-size: 13px;
}

.staff-table tbody tr {
    transition: .3s;
}

.staff-table tbody tr:hover {
    background: #19263a;
}

/* STATUS */

.status {
    display: inline-block;
    padding: 7px 13px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 600;
    white-space: nowrap;
}

.pending {
    background: #493819;
    color: #ffc247;
}

.processing {
    background: #302454;
    color: #b9a3ff;
}

.resolved {
    background: #104333;
    color: #00e6a8;
}

.rejected {
    background: #4b2029;
    color: #ff8092;
}

/* UPDATE FORM */

.staff-update-form {
    display: flex;
    align-items: center;
    gap: 8px;
}

.staff-update-form select {
    background: #080d19;
    color: #ffffff;
    border: 1px solid #344b6d;
    border-radius: 7px;
    padding: 9px;
    outline: none;
    cursor: pointer;
}

.staff-update-form select:focus {
    border-color: #00d9ff;
}

.staff-update-form button {
    background: linear-gradient(135deg, #00d9ff, #4169e1);
    color: #ffffff;
    border: none;
    border-radius: 7px;
    padding: 10px 14px;
    font-weight: 600;
    cursor: pointer;
    transition: .3s;
    white-space: nowrap;
}

.staff-update-form button:hover {
    box-shadow: 0 0 18px rgba(0,217,255,.5);
    transform: translateY(-2px);
}

.completed-label {
    color: #00e6a8;
    font-size: 12px;
    font-weight: 600;
}

.staff-empty {
    text-align: center;
    padding: 35px !important;
    color: #91a4bd !important;
}

/* FOOTER */

.staff-footer {
    text-align: center;
    margin-top: 35px;
    color: #667891;
    font-size: 12px;
}

/* RESPONSIVE */

@media(max-width: 768px) {

    .staff-dashboard {
        padding: 35px 5%;
    }

    .staff-header {
        padding: 25px;
    }

    .staff-header h1 {
        font-size: 22px;
    }

    .staff-table-section {
        padding: 18px;
    }
}
</style>


<div class="staff-dashboard">

    {{-- HEADER --}}

    <div class="staff-header">

        <div class="staff-label">
            URBIX STAFF CONTROL CENTER
        </div>

        <h1>
            WELCOME TO
            <span>STAFF DASHBOARD</span>
        </h1>

        <p>
            Monitor city complaints and track urban issue resolution.
        </p>

    </div>


    {{-- SUCCESS MESSAGE --}}

    @if(session('success'))

        <div class="staff-alert staff-success">
            ✓ {{ session('success') }}
        </div>

    @endif


    {{-- ERROR MESSAGE --}}

    @if($errors->any())

        <div class="staff-alert staff-error">

            @foreach($errors->all() as $error)

                <p>{{ $error }}</p>

            @endforeach

        </div>

    @endif


    {{-- STATISTICS --}}

    <div class="staff-stats">

        <div class="staff-stat stat-blue">
            <p>Total Complaints</p>
            <h2>{{ $totalComplaints }}</h2>
        </div>

        <div class="staff-stat stat-yellow">
            <p>Pending</p>
            <h2>{{ $pendingComplaints }}</h2>
        </div>

        <div class="staff-stat stat-purple">
            <p>Processing</p>
            <h2>{{ $processingComplaints }}</h2>
        </div>

        <div class="staff-stat stat-green">
            <p>Resolved</p>
            <h2>{{ $resolvedComplaints }}</h2>
        </div>

        <div class="staff-stat stat-red">
            <p>Rejected</p>
            <h2>{{ $rejectedComplaints }}</h2>
        </div>

    </div>


    {{-- COMPLAINT MANAGEMENT TABLE --}}

    <div class="staff-table-section">

        <h2>RECENT CITY COMPLAINTS</h2>

        <table class="staff-table">

            <thead>

                <tr>
                    <th>COMPLAINT ID</th>
                    <th>TITLE</th>
                    <th>CATEGORY</th>
                    <th>LOCATION</th>
                    <th>STATUS</th>
                    <th>DATE</th>
                    <th>ACTION</th>
                </tr>

            </thead>


            <tbody>

                @forelse($recentComplaints as $complaint)

                    <tr>

                        <td>
                            {{ $complaint->complaint_id }}
                        </td>

                        <td>
                            {{ $complaint->title }}
                        </td>

                        <td>
                            {{ $complaint->category }}
                        </td>

                        <td>
                            {{ $complaint->location }}
                        </td>

                        <td>

                            <span class="status {{ strtolower($complaint->status) }}">
                                {{ $complaint->status }}
                            </span>

                        </td>

                        <td>
                            {{ $complaint->created_at->format('d M Y') }}
                        </td>

                        <td>

                            @if(in_array($complaint->status, ['Pending', 'Processing']))

                                <form
                                    action="{{ route('staff.complaints.update', $complaint->id) }}"
                                    method="POST"
                                    class="staff-update-form"
                                >

                                    @csrf

                                    @method('PATCH')

                                    <select name="status" required>

                                        @if($complaint->status === 'Pending')

                                            <option value="Processing">
                                                Processing
                                            </option>

                                            <option value="Resolved">
                                                Resolved
                                            </option>

                                        @elseif($complaint->status === 'Processing')

                                            <option value="Resolved">
                                                Resolved
                                            </option>

                                        @endif

                                    </select>

                                    <button type="submit">
                                        Update
                                    </button>

                                </form>

                            @else

                                <span class="completed-label">
                                    ✓ Completed
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="staff-empty">
                            No complaints available yet.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- FOOTER --}}

    <div class="staff-footer">
        © 2026 URBIX Smart City Platform. Staff Control Center.
    </div>

</div>

@endsection