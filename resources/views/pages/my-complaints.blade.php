@extends('layouts.app')

@section('title', 'My Complaints')

@section('content')

<style>
.my-complaints {
    min-height: 100vh;
    padding: 55px 6%;
    background: #080d19;
    color: #ffffff;
}

/* HEADER */

.complaints-header {
    position: relative;
    overflow: hidden;
    padding: 38px;
    margin-bottom: 35px;
    border-radius: 20px;
    border: 1px solid #263b5e;
    background: linear-gradient(135deg, #132847, #101827);
}

.complaints-header::after {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #00d9ff, transparent);
    animation: lineMove 4s linear infinite;
}

@keyframes lineMove {
    to { left: 100%; }
}

.header-label {
    color: #00d9ff;
    font-size: 12px;
    letter-spacing: 3px;
    font-weight: 600;
    margin-bottom: 15px;
}

.complaints-header h1 {
    font-family: 'Orbitron', sans-serif;
    font-size: 30px;
    margin-bottom: 12px;
}

.complaints-header h1 span {
    color: #00d9ff;
}

.complaints-header p {
    color: #a9bad3;
    line-height: 1.7;
}

.header-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 22px;
}

.action-btn {
    display: inline-block;
    padding: 12px 20px;
    border-radius: 8px;
    background: linear-gradient(135deg, #00d9ff, #4169e1);
    color: #fff;
    text-decoration: none;
    font-weight: 600;
    transition: .3s;
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 0 20px rgba(0,217,255,.4);
}

/* ALERTS */

.alert {
    padding: 15px 20px;
    margin-bottom: 20px;
    border-radius: 10px;
}

.alert-success {
    background: #104333;
    color: #00e6a8;
    border: 1px solid #00e6a8;
}

/* SUMMARY */

.complaint-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
    gap: 18px;
    margin-bottom: 35px;
}

.summary-card {
    background: #121b2b;
    padding: 23px;
    border: 1px solid #293d5b;
    border-radius: 14px;
    transition: .3s;
}

.summary-card:hover {
    border-color: #00d9ff;
    transform: translateY(-5px);
    box-shadow: 0 0 20px rgba(0,217,255,.13);
}

.summary-card p {
    color: #9db1ce;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.summary-card h2 {
    margin-top: 12px;
    font-family: 'Orbitron', sans-serif;
    font-size: 28px;
}

.total h2 { color: #00d9ff; }
.pending h2 { color: #ffc247; }
.processing h2 { color: #a78bfa; }
.resolved h2 { color: #00e6a8; }
.rejected h2 { color: #ff647c; }

/* SEARCH */

.search-box {
    display: flex;
    gap: 10px;
    margin-bottom: 25px;
}

.search-box input {
    flex: 1;
    min-width: 0;
    padding: 14px 17px;
    border-radius: 9px;
    border: 1px solid #344b6d;
    background: #121b2b;
    color: #fff;
    outline: none;
}

.search-box input:focus {
    border-color: #00d9ff;
}

.search-box button {
    padding: 12px 20px;
    border: none;
    border-radius: 9px;
    background: #00bfe8;
    color: #07111f;
    font-weight: 700;
    cursor: pointer;
}

/* COMPLAINT CARD */

.complaint-card {
    padding: 27px;
    margin-bottom: 23px;
    background: #121b2b;
    border: 1px solid #293d5b;
    border-radius: 17px;
    transition: .3s;
}

.complaint-card:hover {
    border-color: #00d9ff;
    box-shadow: 0 0 23px rgba(0,217,255,.14);
    transform: translateY(-3px);
}

.complaint-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    padding-bottom: 18px;
    border-bottom: 1px solid #293d5b;
    margin-bottom: 20px;
}

.complaint-id {
    color: #00d9ff;
    font-size: 13px;
    font-weight: 700;
}

.status {
    display: inline-block;
    padding: 8px 15px;
    border-radius: 30px;
    font-size: 11px;
    font-weight: 700;
}

.status-pending {
    background: #493819;
    color: #ffc247;
}

.status-processing {
    background: #302454;
    color: #b9a3ff;
}

.status-resolved {
    background: #104333;
    color: #00e6a8;
}

.status-rejected {
    background: #4b2029;
    color: #ff8092;
}

.complaint-title {
    font-size: 21px;
    margin-bottom: 12px;
}

.complaint-description {
    color: #a9bad3;
    font-size: 14px;
    line-height: 1.8;
    margin-bottom: 20px;
}

.complaint-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 13px;
    margin-bottom: 20px;
}

.info-box {
    padding: 14px;
    background: #0b1423;
    border: 1px solid #25334a;
    border-radius: 9px;
    overflow-wrap: anywhere;
}

.info-box small {
    display: block;
    color: #8299b7;
    font-size: 11px;
    margin-bottom: 8px;
}

.info-box strong {
    color: #e1eafa;
    font-size: 13px;
}

/* IMAGE */

.complaint-image {
    display: block;
    width: 190px;
    max-width: 100%;
    height: 130px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid #344b6d;
    margin-bottom: 20px;
}

/* TRACKING */

.tracking-section {
    padding-top: 20px;
    border-top: 1px solid #293d5b;
}

.tracking-section h3 {
    color: #00d9ff;
    font-family: 'Orbitron', sans-serif;
    font-size: 14px;
    margin-bottom: 20px;
}

.tracking-steps {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

.tracking-step {
    position: relative;
    text-align: center;
    padding: 15px 8px;
    background: #0b1423;
    border: 1px solid #293d5b;
    border-radius: 10px;
    color: #8299b7;
    font-size: 12px;
}

.tracking-step.active {
    border-color: #00d9ff;
    color: #00d9ff;
    background: rgba(0,217,255,.08);
    box-shadow: 0 0 13px rgba(0,217,255,.1);
}

.tracking-step.completed {
    border-color: #00e6a8;
    color: #00e6a8;
    background: rgba(0,230,168,.07);
}

.tracking-note {
    margin-top: 15px;
    color: #a9bad3;
    font-size: 12px;
}

/* EMPTY */

.empty-state {
    padding: 60px 20px;
    text-align: center;
    background: #121b2b;
    border: 1px solid #293d5b;
    border-radius: 17px;
}

.empty-icon {
    font-size: 45px;
    margin-bottom: 15px;
}

.empty-state h2 {
    color: #00d9ff;
    margin-bottom: 12px;
}

.empty-state p {
    color: #9db1ce;
    margin-bottom: 22px;
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
    color: #00d9ff !important;
}

/* RESPONSIVE */

@media(max-width: 600px) {
    .my-complaints {
        padding: 35px 5%;
    }

    .complaints-header {
        padding: 25px;
    }

    .complaints-header h1 {
        font-size: 22px;
    }

    .complaint-card {
        padding: 18px;
    }

    .tracking-steps {
        grid-template-columns: 1fr;
    }

    .search-box {
        flex-direction: column;
    }
}
</style>


<div class="my-complaints">

    {{-- HEADER --}}

    <div class="complaints-header">

        <div class="header-label">
            URBIX CITIZEN PORTAL
        </div>

        <h1>
            MY <span>COMPLAINTS</span>
        </h1>

        <p>
            Track your reported city problems and monitor their resolution progress.
        </p>

        <div class="header-actions">

            <a href="{{ route('report') }}" class="action-btn">
                + Report a Problem
            </a>

            <a href="{{ route('citizen.dashboard') }}" class="action-btn">
                Dashboard
            </a>

        </div>

    </div>


    {{-- SUCCESS MESSAGE --}}

    @if(session('success'))
        <div class="alert alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif


    {{-- SUMMARY --}}

    <div class="complaint-summary">

        <div class="summary-card total">
            <p>Total Complaints</p>
            <h2>{{ $complaints->total() }}</h2>
        </div>

        <div class="summary-card pending">
            <p>Pending</p>
            <h2>{{ $complaints->getCollection()->where('status', 'Pending')->count() }}</h2>
        </div>

        <div class="summary-card processing">
            <p>Processing</p>
            <h2>{{ $complaints->getCollection()->where('status', 'Processing')->count() }}</h2>
        </div>

        <div class="summary-card resolved">
            <p>Resolved</p>
            <h2>{{ $complaints->getCollection()->where('status', 'Resolved')->count() }}</h2>
        </div>

        <div class="summary-card rejected">
            <p>Rejected</p>
            <h2>{{ $complaints->getCollection()->where('status', 'Rejected')->count() }}</h2>
        </div>

    </div>


    {{-- SEARCH --}}

    <form action="{{ route('my-complaints') }}" method="GET" class="search-box">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by Complaint ID or Title..."
        >

        <button type="submit">
            Search
        </button>

    </form>


    {{-- COMPLAINT LIST --}}

    @forelse($complaints as $complaint)

        <div class="complaint-card">

            <div class="complaint-top">

                <span class="complaint-id">
                    ID: {{ $complaint->complaint_id }}
                </span>

                <span class="status status-{{ strtolower($complaint->status) }}">
                    {{ $complaint->status }}
                </span>

            </div>


            <h2 class="complaint-title">
                {{ $complaint->title }}
            </h2>


            <p class="complaint-description">
                {{ $complaint->description }}
            </p>


            <div class="complaint-info">

                <div class="info-box">
                    <small>CATEGORY</small>
                    <strong>{{ $complaint->category }}</strong>
                </div>

                <div class="info-box">
                    <small>LOCATION</small>
                    <strong>{{ $complaint->location }}</strong>
                </div>

                <div class="info-box">
                    <small>SUBMITTED DATE</small>
                    <strong>{{ $complaint->created_at->format('d M Y') }}</strong>
                </div>

            </div>


            {{-- IMAGE --}}

            @if($complaint->image)

                <img
                    src="{{ asset('storage/' . $complaint->image) }}"
                    class="complaint-image"
                    alt="Complaint Image"
                >

            @endif


            {{-- TRACKING TIMELINE --}}

            @php
                $status = $complaint->status;
            @endphp

            <div class="tracking-section">

                <h3>COMPLAINT STATUS TIMELINE</h3>

                <div class="tracking-steps">

                    <div class="tracking-step completed">
                        ✓ Submitted
                    </div>

                    <div class="tracking-step
                        {{ in_array($status, ['Processing', 'Resolved']) ? 'completed' : ($status === 'Pending' ? 'active' : '') }}">

                        @if($status === 'Processing' || $status === 'Resolved')
                            ✓
                        @else
                            ⚙
                        @endif

                        Processing

                    </div>

                    <div class="tracking-step
                        {{ $status === 'Resolved' ? 'completed' : ($status === 'Rejected' ? 'active' : '') }}">

                        @if($status === 'Resolved')
                            ✓
                        @else
                            ◎
                        @endif

                        Resolved

                    </div>

                </div>

                <p class="tracking-note">

                    @if($status === 'Pending')
                        Your complaint has been submitted and is waiting for staff review.

                    @elseif($status === 'Processing')
                        Staff is currently working on your complaint.

                    @elseif($status === 'Resolved')
                        Your complaint has been successfully resolved.

                    @elseif($status === 'Rejected')
                        Your complaint was rejected. Please contact the support team for more information.

                    @endif

                </p>

            </div>

        </div>

    @empty

        <div class="empty-state">

            <div class="empty-icon">🏙️</div>

            <h2>No Complaints Found</h2>

            <p>
                You haven't submitted any complaints yet.
                Start by reporting a city problem.
            </p>

            <a href="{{ route('report') }}" class="action-btn">
                + Report a Problem
            </a>

        </div>

    @endforelse


    {{-- PAGINATION --}}

    @if($complaints->hasPages())

        <div class="pagination">
            {{ $complaints->links() }}
        </div>

    @endif

</div>

@endsection