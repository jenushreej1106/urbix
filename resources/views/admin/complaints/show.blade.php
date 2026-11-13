@extends('layouts.app')

@section('title', 'Complaint Details')

@section('content')

<style>
.details-wrapper {
    min-height: 100vh;
    padding: 60px 7%;
    background: #080b16;
    color: #fff;
}

.details-card {
    max-width: 900px;
    margin: auto;
    padding: 35px;
    background: #111827;
    border: 1px solid #263653;
    border-radius: 18px;
}

.details-title {
    font-family: 'Orbitron', sans-serif;
    color: #00d4ff;
    font-size: 25px;
    margin-bottom: 10px;
}

.details-subtitle {
    color: #8d9ab0;
    margin-bottom: 30px;
}

.details-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 22px;
}

.detail-item {
    padding: 17px;
    background: #192338;
    border-radius: 10px;
}

.detail-item small {
    color: #00d4ff;
    display: block;
    margin-bottom: 10px;
    font-size: 11px;
    text-transform: uppercase;
}

.detail-item p {
    color: #fff;
    line-height: 1.6;
    overflow-wrap: anywhere;
}

.full-width {
    grid-column: 1 / -1;
}

.complaint-image {
    width: 100%;
    max-height: 400px;
    object-fit: contain;
    background: #080b16;
    border-radius: 10px;
    margin-top: 10px;
}

.update-section {
    margin-top: 30px;
    padding: 25px;
    background: #192338;
    border-radius: 12px;
}

.update-section h3 {
    margin-bottom: 18px;
    color: #00d4ff;
}

.update-section select {
    width: 100%;
    padding: 14px;
    background: #080b16;
    border: 1px solid #344766;
    color: white;
    border-radius: 8px;
    margin-bottom: 18px;
}

.update-btn {
    padding: 13px 22px;
    background: linear-gradient(90deg, #007cf0, #00d4ff);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
}

.back-btn {
    display: inline-block;
    margin-bottom: 25px;
    color: #00d4ff;
    text-decoration: none;
}

.alert-success {
    padding: 14px;
    background: #124536;
    color: #56e6b1;
    border-radius: 8px;
    margin-bottom: 20px;
}

.alert-error {
    padding: 12px;
    background: #4b202b;
    color: #ff8197;
    border-radius: 8px;
    margin-bottom: 15px;
}

@media(max-width: 650px) {
    .details-grid {
        grid-template-columns: 1fr;
    }

    .full-width {
        grid-column: auto;
    }

    .details-card {
        padding: 20px;
    }
}
</style>

<div class="details-wrapper">

    <div class="details-card">

        <a href="{{ route('admin.complaints.index') }}" class="back-btn">
            ← Back to Admin Dashboard
        </a>

        <h1 class="details-title">
            Complaint Details
        </h1>

        <p class="details-subtitle">
            Review and manage this city complaint.
        </p>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="details-grid">

            <div class="detail-item">
                <small>Complaint ID</small>
                <p>{{ $complaint->complaint_id }}</p>
            </div>

            <div class="detail-item">
                <small>Category</small>
                <p>{{ $complaint->category }}</p>
            </div>

            <div class="detail-item">
                <small>Complaint Title</small>
                <p>{{ $complaint->title }}</p>
            </div>

            <div class="detail-item">
                <small>Location</small>
                <p>{{ $complaint->location }}</p>
            </div>

            <div class="detail-item full-width">
                <small>Description</small>
                <p>{{ $complaint->description }}</p>
            </div>

            <div class="detail-item">
                <small>Current Status</small>
                <p>{{ $complaint->status }}</p>
            </div>

            <div class="detail-item">
                <small>Submitted Date</small>
                <p>{{ $complaint->created_at->format('d M Y, h:i A') }}</p>
            </div>

            @if($complaint->latitude && $complaint->longitude)
                <div class="detail-item full-width">
                    <small>GPS Coordinates</small>
                    <p>
                        Latitude: {{ $complaint->latitude }}<br>
                        Longitude: {{ $complaint->longitude }}
                    </p>
                </div>
            @endif

            @if($complaint->image)
                <div class="detail-item full-width">
                    <small>Uploaded Complaint Image</small>

                    <a
                        href="{{ asset('storage/' . $complaint->image) }}"
                        target="_blank">

                        <img
                            src="{{ asset('storage/' . $complaint->image) }}"
                            class="complaint-image"
                            alt="Complaint Image">

                    </a>
                </div>
            @endif

        </div>

        {{-- STATUS UPDATE --}}

        <div class="update-section">

            <h3>Update Complaint Status</h3>

            <form
                action="{{ route('admin.complaints.update', $complaint->id) }}"
                method="POST">

                @csrf
                @method('PATCH')

                <select name="status" required>

                    <option value="Pending"
                        {{ $complaint->status == 'Pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="Processing"
                        {{ $complaint->status == 'Processing' ? 'selected' : '' }}>
                        Processing
                    </option>

                    <option value="Resolved"
                        {{ $complaint->status == 'Resolved' ? 'selected' : '' }}>
                        Resolved
                    </option>

                    <option value="Rejected"
                        {{ $complaint->status == 'Rejected' ? 'selected' : '' }}>
                        Rejected
                    </option>

                </select>

                <button type="submit" class="update-btn">
                    Update Status →
                </button>

            </form>

        </div>

    </div>

</div>

@endsection