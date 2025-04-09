@extends('layouts.dashboard')

@section('title', 'Create Client')

@section('content')
<div class="container mt-5">
    <a href="{{ url()->previous() }}" class="btn btn-dark mb-4">
        <i class="bi bi-arrow-left"></i> BACK
    </a>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h4 class="text-center mb-4 fw-bold">CREATE NEW CLIENT</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('client-store') }}" method="POST">
        @csrf
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name *</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name *</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="contact" class="form-label">Contact *</label>
                        <input type="text" name="contact" class="form-control" value="{{ old('contact') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="gender" class="form-label">Gender *</label>
                        <select name="gender" class="form-select" required>
                            <option value="male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date of Birth *</label>
                        <div class="d-flex gap-2">
                            <select name="dob_year" class="form-select" required>
                                <option value="">Year</option>
                                @for($year = 1950; $year <= now()->year; $year++)
                                    <option value="{{ $year }}" {{ old('dob_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>

                            <select name="dob_month" id="dob_month" class="form-select" required>
                                <option value="">Month</option>
                                @foreach(range(1, 12) as $month)
                                    <option value="{{ $month }}" {{ old('dob_month') == $month ? 'selected' : '' }}>{{ $month }}</option>
                                @endforeach
                            </select>

                            <select name="dob_day" id="dob_day" class="form-select" required>
                                <option value="">Date</option>
                                @foreach(range(1, 31) as $day)
                                    <option value="{{ $day }}" {{ old('dob_day') == $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="street_no" class="form-label">Street No</label>
                        <input type="text" name="street_no" class="form-control" value="{{ old('street_no') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="street_address" class="form-label">Street Address</label>
                        <input type="text" name="street_address" class="form-control" value="{{ old('street_address') }}">
                    </div>

                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" name="city" class="form-control" value="{{ old('city') }}">
                    </div>

                    <div class="col-md-6 d-flex flex-column">
                        <label class="form-label mb-2">Active/Inactive</label>
                        <input type="hidden" name="status" value="inactive">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" value="active"
                                {{ old('status', 'inactive') == 'active' ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-dark px-5 py-2">SAVE</button>
                </div>
            </div>
        </div>
    </form>
</div>

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
            }else{
                daySelect.innerHTML = '<option value="">Day</option>';
            }
        }

        monthSelect.addEventListener('change', updateDays);
        document.querySelector('[name="dob_year"]').addEventListener('change', updateDays);
        updateDays();
    });
</script>