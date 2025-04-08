@extends('layouts.dashboard')

@section('title', 'Edit Client')

@section('content')

<style>
html, body {
    overflow-x: hidden;
}

.container-fluid { 
    padding-bottom: 20px; 
    overflow-y: auto;
} </style>
<a href="/client-view" style="margin-bottom: 40px; margin-left: 10px">Back to Clients</a>

<div class="container-fluid">
    <h4>Edit Client</h4>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('client-update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- First Name -->
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $client->first_name) }}" required>
            @error('first_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $client->last_name) }}" required>
            @error('last_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Contact -->
        <div class="mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact', $client->contact) }}" required>
            @error('contact')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Gender -->
        <div class="mb-3">
            <label class="form-label">Gender</label><br>
            <input type="radio" id="male" name="gender" value="male" {{ old('gender', $client->gender) == 'male' ? 'checked' : '' }}> Male
            <input type="radio" id="female" name="gender" value="female" {{ old('gender', $client->gender) == 'female' ? 'checked' : '' }}> Female
            @error('gender')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label for="street_address" class="form-label">Street Address</label>
            <input type="text" class="form-control" id="street_address" name="street_address" value="{{ old('street_address', $client->street_address) }}" required>
            @error('street_address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- City -->
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $client->city) }}" required>
            @error('city')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $client->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Date of Birth -->
        <div class="mb-3">
            <label for="dob_year" class="form-label">Date of Birth</label><br>
            <select name="dob_year" class="form-select d-inline-block" style="width: 30%;" required>
                <option value="">Year</option>
                @for($year = 1900; $year <= 2025; $year++)
                    <option value="{{ $year }}" {{ old('dob_year', $client->dob_year) == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endfor
            </select>
            <select name="dob_month" class="form-select d-inline-block" style="width: 30%;" required>
                <option value="">Month</option>
                @foreach(range(1, 12) as $month)
                    <option value="{{ $month }}" {{ old('dob_month', $client->dob_month) == $month ? 'selected' : '' }}>{{ $month }}</option>
                @endforeach
            </select>
            <select name="dob_day" class="form-select d-inline-block" style="width: 30%;" required>
                <option value="">Day</option>
                @foreach(range(1, 31) as $day)
                    <option value="{{ $day }}" {{ old('dob_day', $client->dob_day) == $day ? 'selected' : '' }}>{{ $day }}</option>
                @endforeach
            </select>
            @error('dob_year')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label>Status</label><br>
            <input type="radio" id="active" name="status" value="active" {{ old('status', $client->status) == 'active' ? 'checked' : '' }}> Active
            <input type="radio" id="inactive" name="status" value="inactive" {{ old('status', $client->status) == 'inactive' ? 'checked' : '' }}> Inactive
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Client</button>
    </form>
</div>
@endsection
