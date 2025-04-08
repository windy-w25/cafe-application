@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .container {
            min-height: 100vh; /* Ensure the container takes full height of the viewport */
        }
        .card-body {
            overflow-y: auto; /* Allows scrolling inside card body if content overflows */
        }
    </style>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Create New Client</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ url('client-store') }}" method="POST">
            @csrf

            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- First Name -->
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                        @error('first_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Contact -->
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact</label>
                        <input type="text" id="contact" name="contact" class="form-control" value="{{ old('contact') }}" required>
                        @error('contact')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label class="form-label">Gender</label><br>
                        <div class="form-check form-check-inline">
                            <input type="radio" id="male" name="gender" value="male" class="form-check-input" {{ old('gender') == 'male' ? 'checked' : '' }} required>
                            <label for="male" class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" id="female" name="gender" value="female" class="form-check-input" {{ old('gender') == 'female' ? 'checked' : '' }} required>
                            <label for="female" class="form-check-label">Female</label>
                        </div>
                        @error('gender')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-3">
                        <label for="dob_year" class="form-label">Date of Birth</label><br>
                        <select name="dob_year" class="form-select d-inline-block" style="width: 30%;" required>
                            <option value="">Year</option>
                            @for($year = 1900; $year <= 2025; $year++)
                                <option value="{{ $year }}" {{ old('dob_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                        <select name="dob_month" class="form-select d-inline-block" style="width: 30%;" required id="dob_month">
                            <option value="">Month</option>
                            @foreach(range(1, 12) as $month)
                                <option value="{{ $month }}" {{ old('dob_month') == $month ? 'selected' : '' }}>{{ $month }}</option>
                            @endforeach
                        </select>
                        <select name="dob_day" class="form-select d-inline-block" style="width: 30%;" required id="dob_day">
                            <option value="">Day</option>
                            @foreach(range(1, 31) as $day)
                                <option value="{{ $day }}" {{ old('dob_day') == $day ? 'selected' : '' }}>{{ $day }}</option>
                            @endforeach
                        </select>
                        @error('dob_year')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Street Address -->
                    <div class="mb-3">
                        <label for="street_address" class="form-label">Street Address</label>
                        <input type="text" id="street_address" name="street_address" class="form-control" value="{{ old('street_address') }}" required>
                        @error('street_address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- City -->
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" id="city" name="city" class="form-control" value="{{ old('city') }}" required>
                        @error('city')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status</label><br>
                        <div class="form-check form-check-inline">
                            <input type="radio" id="active" name="status" value="active" class="form-check-input" {{ old('status') == 'active' ? 'checked' : '' }} required>
                            <label for="active" class="form-check-label">Active</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" id="inactive" name="status" value="inactive" class="form-check-input" {{ old('status') == 'inactive' ? 'checked' : '' }} required>
                            <label for="inactive" class="form-check-label">Inactive</label>
                        </div>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const monthSelect = document.getElementById('dob_month');
        const daySelect = document.getElementById('dob_day');

        function getDaysInMonth(year, month) {
            return new Date(year, month, 0).getDate();
        }

        function updateDays() {
            const year = document.querySelector('[name="dob_year"]').value;
            const month = monthSelect.value;
            if (year && month) {
                const daysInMonth = getDaysInMonth(year, month);
                daySelect.innerHTML = '<option value="">Day</option>';
                for (let day = 1; day <= daysInMonth; day++) {
                    const option = document.createElement('option');
                    option.value = day;
                    option.textContent = day;
                    daySelect.appendChild(option);
                }
            }
        }

        monthSelect.addEventListener('change', updateDays);
        document.querySelector('[name="dob_year"]').addEventListener('change', updateDays);
        updateDays();
    });
</script>
