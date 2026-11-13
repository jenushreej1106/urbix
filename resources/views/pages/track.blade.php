@extends('layouts.app')

@section('title', 'Track Complaint')

@section('content')

<style>
.track-page {
    min-height: 100vh;
    background: #080808;
    color: white;
    padding: 80px 20px;
}

.track-container {
    max-width: 750px;
    margin: auto;
}

.track-heading {
    text-align: center;
    margin-bottom: 40px;
}

.track-heading h1 {
    font-size: 45px;
}

.track-heading span {
    color: #00d9ff;
}

.track-form {
    display: flex;
    gap: 10px;
    margin-bottom: 35px;
}

.track-form input {
    flex: 1;
    padding: 15px;
    background: #141722;
    border: 1px solid #34394a;
    border-radius: 10px;
    color: white;
}

.track-form button {
    padding: 15px 22px;
    background: #00d9ff;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
}

.track-result {
    background: #141722;
    padding: 30px;
    border: 1px solid #34394a;
    border-radius: 18px;
}

.track-result h2 {
    color: #00d9ff;
}

.timeline {
    margin-top: 30px;
    border-left: 3px solid #34394a;
    padding-left: 25px;
}

.timeline-item {
    margin-bottom: 28px;
    position: relative;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: -34px;
    top: 5px;
    width: 15px;
    height: 15px;
    background: #555;
    border-radius: 50%;
}

.timeline-item.active::before {
    background: #00d9ff;
    box-shadow: 0 0 15px #00d9ff;
}

.timeline-item h3 {
    margin: 0 0 5px;
}

.timeline-item p {
    color: #aaa;
}

.not-found {
    text-align: center;
    color: #ff8585;
    padding: 20px;
}

@media(max-width:600px) {
    .track-form {
        flex-direction: column;
    }

    .track-heading h1 {
        font-size: 34px;
    }
}
</style>

<div class="track-page">

    <div class="track-container">

        <div class="track-heading">
            <h1>Track Your <span>Complaint.</span></h1>
            <p>Enter your URBIX Complaint ID to check its status.</p>
        </div>

        <form action="{{ route('track') }}" method="GET" class="track-form">

            <input
                type="text"
                name="complaint_id"
                value="{{ request('complaint_id') }}"
                placeholder="Example: URBIX-20261109-KWUUG8"
                required>

            <button type="submit">Track Now →</button>

        </form>

        @if(request()->filled('complaint_id'))

            @if($complaint)

                <div class="track-result">

                    <p>COMPLAINT ID</p>

                    <h2>{{ $complaint->complaint_id }}</h2>

                    <h3>{{ $complaint->title }}</h3>

                    <p>Category: {{ $complaint->category }}</p>

                    <p>Location: {{ $complaint->location }}</p>

                    <p>
                        Current Status:
                        <strong>{{ $complaint->status }}</strong>
                    </p>

                    <div class="timeline">

                        @foreach(['Pending', 'Processing', 'Resolved'] as $status)

                            <div class="timeline-item
                                {{ $complaint->status === $status ||
                                   (
                                       $status === 'Pending' &&
                                       in_array($complaint->status, ['Processing', 'Resolved'])
                                   ) ||
                                   (
                                       $status === 'Processing' &&
                                       $complaint->status === 'Resolved'
                                   )
                                   ? 'active' : '' }}">

                                <h3>{{ $status }}</h3>

                                <p>
                                    @if($status === 'Pending')
                                        Complaint successfully registered.
                                    @elseif($status === 'Processing')
                                        Department is working on the issue.
                                    @else
                                        Complaint has been resolved.
                                    @endif
                                </p>

                            </div>

                        @endforeach

                        @if($complaint->status === 'Rejected')
                            <div class="timeline-item active">
                                <h3>Rejected</h3>
                                <p>This complaint was rejected.</p>
                            </div>
                        @endif

                    </div>

                </div>

            @else

                <div class="not-found">
                    <h3>Complaint Not Found!</h3>
                    <p>Please check your Complaint ID.</p>
                </div>

            @endif

        @endif

    </div>

</div>

@endsection