@extends('layouts.app')

@section('title', $title)

@section('content')

<section class="page-hero">

    <div class="page-container">

        <div class="section-label">
            URBIX / {{ $number }}
        </div>

        <h1>
            {{ $title }}
            <span>.</span>
        </h1>

        <p class="page-description">
            {{ $description }}
        </p>

        <div class="page-actions">

            <a href="{{ route('report') }}" class="primary-button">
                Report an Issue ↗
            </a>

            <a href="{{ route('track') }}" class="secondary-button">
                Track Complaint
            </a>

        </div>

    </div>

</section>


<section class="page-content">

    <div class="page-container">

        <div class="page-card-grid">

            @foreach($features as $index => $feature)

                <div class="page-card">

                    <span class="card-number">
                        0{{ $index + 1 }}
                    </span>

                    <div class="card-icon">
                        {{ $feature['icon'] }}
                    </div>

                    <h3>{{ $feature['title'] }}</h3>

                    <p>{{ $feature['description'] }}</p>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection