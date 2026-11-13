@extends('layouts.app')

@section('title', 'Report a Problem')

@section('content')

<style>
.report-page {
    min-height: 100vh;
    padding: 80px 20px;
    background: #080808;
    color: #fff;
}

.report-container {
    max-width: 850px;
    margin: auto;
}

.report-heading {
    text-align: center;
    margin-bottom: 40px;
}

.report-heading span {
    color: #00d9ff;
    letter-spacing: 4px;
}

.report-heading h1 {
    font-size: 48px;
    margin: 20px 0;
}

.report-heading h1 strong {
    color: #00d9ff;
}

.report-heading p {
    color: #aaa;
}

.report-form {
    background: #141722;
    padding: 35px;
    border: 1px solid #34394a;
    border-radius: 20px;
}

.report-form h2 {
    color: #00d9ff;
    margin-bottom: 25px;
}

.form-group {
    margin-bottom: 22px;
}

.form-group label {
    display: block;
    margin-bottom: 10px;
    color: #ddd;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 14px;
    background: #090b12;
    color: white;
    border: 1px solid #34394a;
    border-radius: 10px;
    box-sizing: border-box;
    outline: none;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #00d9ff;
    box-shadow: 0 0 15px #00d9ff30;
}

.location-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.location-button,
.submit-button {
    padding: 14px 22px;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 700;
    transition: .3s;
}

.location-button {
    background: #141e2e;
    color: #00d9ff;
    border: 1px solid #00d9ff;
}

.submit-button {
    width: 100%;
    margin-top: 25px;
    background: linear-gradient(90deg, #00d9ff, #7867ff);
    border: none;
    color: #080808;
    font-size: 16px;
}

.location-button:hover,
.submit-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 0 25px #00d9ff70;
}

.success-message {
    padding: 20px;
    background: #102b24;
    color: #7dffc7;
    border: 1px solid #1e9e72;
    border-radius: 12px;
    margin-bottom: 25px;
}

.error-message {
    padding: 20px;
    background: #35171d;
    color: #ff9da9;
    border-radius: 12px;
    margin-bottom: 25px;
}

@media(max-width:600px) {
    .report-heading h1 {
        font-size: 34px;
    }

    .report-form {
        padding: 22px;
    }

    .location-grid {
        grid-template-columns: 1fr;
        gap: 0;
    }
}
</style>

<div class="report-page">

    <div class="report-container">

        <div class="report-heading">
            <span>URBIX / CITIZEN SERVICES</span>
            <h1>Report a <strong>Problem.</strong></h1>
            <p>Help us build a smarter city. Report an issue in your area.</p>
        </div>

        @if(session('success'))
            <div class="success-message">
                <h3>✓ Complaint Submitted Successfully!</h3>
                <p>{{ session('success') }}</p>
                <strong>Complaint ID: {{ session('complaint_id') }}</strong>
            </div>
        @endif

        @if($errors->any())
            <div class="error-message">
                <strong>Please correct these errors:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('report.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="report-form">

            @csrf

            <h2>Complaint Information</h2>

            <div class="form-group">
                <label>Problem Category *</label>
                <select name="category" required>
                    <option value="">Select Category</option>
                    @foreach(['Road Damage','Garbage','Streetlight','Water Supply','Drainage','Public Safety','Other'] as $category)
                        <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Complaint Title *</label>
                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       placeholder="Example: Damaged road near bus stand"
                       required>
            </div>

            <div class="form-group">
                <label>Description *</label>
                <textarea name="description"
                          rows="5"
                          placeholder="Describe the problem..."
                          required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label>Location / Address *</label>
                <input type="text"
                       name="location"
                       value="{{ old('location') }}"
                       placeholder="Enter problem location"
                       required>
            </div>

            <div class="form-group">
                <label>Upload Problem Image</label>
                <input type="file"
                       name="image"
                       id="problemImage"
                       accept="image/png,image/jpeg,image/webp">

                <img id="imagePreview"
                     style="display:none; max-width:250px; margin-top:15px; border-radius:12px;"
                     alt="Image preview">
            </div>

            <h2>Location Coordinates</h2>

            <div class="location-grid">
                <div class="form-group">
                    <label>Latitude</label>
                    <input type="text" name="latitude" id="latitude"
                           value="{{ old('latitude') }}" placeholder="Latitude">
                </div>

                <div class="form-group">
                    <label>Longitude</label>
                    <input type="text" name="longitude" id="longitude"
                           value="{{ old('longitude') }}" placeholder="Longitude">
                </div>
            </div>

            <button type="button" class="location-button" onclick="getLocation()">
                📍 Detect My Location
            </button>

            <p id="locationMessage"></p>

            <button type="submit" class="submit-button">
                Submit Complaint →
            </button>

        </form>

    </div>

</div>

<script>
function getLocation() {
    const message = document.getElementById('locationMessage');

    if (!navigator.geolocation) {
        message.textContent = 'Geolocation is not supported.';
        return;
    }

    message.textContent = 'Detecting location...';

    navigator.geolocation.getCurrentPosition(
        function(position) {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
            message.textContent = '✓ Location detected successfully!';
        },
        function() {
            message.textContent = 'Unable to detect location. Enter coordinates manually.';
        }
    );
}

document.getElementById('problemImage').addEventListener('change', function(event) {
    const preview = document.getElementById('imagePreview');
    const file = event.target.files[0];

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
    }
});
</script>

@endsection