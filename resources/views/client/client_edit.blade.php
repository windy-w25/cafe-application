@extends('layouts.dashboard')

@section('title', 'Edit Client')
<style>
    html, body {
        overflow-x: hidden;
    }

    .container-fluid { 
        padding-bottom: 20px; 
        overflow-y: auto;
    } 
</style>
@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="text-center mb-4">EDIT CLIENT</h4>

            <!-- Show all error messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('client-update', $client->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">First Name *</label>
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $client->first_name) }}" required>
                        @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Last Name *</label>
                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $client->last_name) }}" required>
                        @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Contact *</label>
                        <input type="text" name="contact" class="form-control @error('contact') is-invalid @enderror" value="{{ old('contact', $client->contact) }}" required>
                        @error('contact') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $client->email) }}" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Gender *</label>
                        <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                            <option value="male" {{ old('gender', $client->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $client->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date of Birth *</label>
                        <div class="d-flex gap-2">
                            <select name="dob_year" class="form-select" required>
                                <option value="">Year</option>
                                @for($year = 1950; $year <= now()->year; $year++)
                                    <option value="{{ $year }}" {{ old('dob_year', $client->dob_year) == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                            <select name="dob_month" class="form-select" required>
                                <option value="">Month</option>
                                @foreach(range(1, 12) as $month)
                                    <option value="{{ $month }}" {{ old('dob_month', $client->dob_month) == $month ? 'selected' : '' }}>{{ $month }}</option>
                                @endforeach
                            </select>
                            <select name="dob_day" class="form-select" required>
                                <option value="">Date</option>
                                @foreach(range(1, 31) as $day)
                                    <option value="{{ $day }}" {{ old('dob_day', $client->dob_day) == $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Street No *</label>
                        <input type="text" name="street_no" class="form-control" value="{{ old('street_no', $client->street_no) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Street Address *</label>
                        <input type="text" name="street_address" class="form-control" value="{{ old('street_address', $client->street_address) }}">
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">City *</label>
                        <input type="text" name="city" class="form-control" value="{{ old('city', $client->city) }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                    <div>
                        <label class="form-label d-block">Active/Inactive</label>
                        <input type="hidden" name="status" value="inactive">
                        <div class="form-check form-switch">
                            <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox" name="status" value="active" {{ old('status', $client->status) == 'active' ? 'checked' : '' }}>
                        </div>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-dark shadow px-5">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>

    document.addEventListener('DOMContentLoaded', function () {
        const monthSelect = document.querySelector('[name="dob_month"]');
        const daySelect = document.querySelector('[name="dob_day"]');
        const yearSelect = document.querySelector('[name="dob_year"]');

        const getDaysInMonth = (year, month) => new Date(year, month, 0).getDate();

        const updateDays = () => {
            const year = yearSelect.value;
            console.log(year);
            const month = monthSelect.value;

            if (year && month) {
                const daysInMonth = getDaysInMonth(year, month);
                console.log(year);
                daySelect.innerHTML = '<option value="">Day</option>';
                for (let day = 1; day <= daysInMonth; day++) {
                    const option = document.createElement('option');
                    option.value = day;
                    option.textContent = day;
                    daySelect.appendChild(option);
                }
            } else {
                daySelect.innerHTML = '<option value="">Day</option>';
            }
        };

        monthSelect.addEventListener('change', updateDays);
        yearSelect.addEventListener('change', updateDays);
        updateDays();
    });

</script>
@endpush
