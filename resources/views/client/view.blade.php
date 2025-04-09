@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
@section('content')

<a href="{{ route('client') }}" class="btn btn-sm btn-dark" style="float:right; margin-right:10px">
    <i class="bi bi-plus"></i> Add Client
</a>
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h4 class="mb-4 fw-bold">CLIENTS</h4>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET">
            <!-- <select class="form-select form-select-sm w-auto" name="per_page" onchange="document.getElementById('paginationForm').submit();">
                <option value="5" >5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select> -->
        </form>
        <form method="GET" action="{{ route('client-view') }}">
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search by client name..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table align-middle table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($clients) && count($clients) > 0)
                    @foreach ($clients as $index => $client)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img src="{{ asset('storage/images/profile.jpg') }}" class="rounded-circle" width="40" height="40" alt="avatar">
                        </td>
                        <td>{{ $client->first_name.' '.$client->last_name }}</td>
                        <td>{{ $client->contact }}</td>
                        <td>{{ $client->email }}</td>
                        <td>
                            <span class="badge bg-success">{{ $client->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('client-edit', $client->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $client->id }}">
                            <i class="bi bi-trash"></i>
                            </button>
                            <form id="delete-form-{{ $client->id }}" action="{{ route('client-delete', $client->id) }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <button type="button" class="btn btn-secondary btn-sm view-client-btn" data-id="{{ $client->id }}"data-bs-toggle="modal"data-bs-target="#clientDetailsModal">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                @else
                <p>No records found</p>
                @endif
            </tbody>
        </table>
    </div>
    <!-- client model -->
    <div class="modal fade" id="clientDetailsModal" tabindex="-1" aria-labelledby="clientDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Client Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/images/profile.jpg') }}" alt="Client Image" class="rounded-circle" width="100">
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-4"><strong>First Name :</strong></div>
                        <div class="col-sm-8" id="client-fname"></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-4"><strong>Last Name :</strong></div>
                        <div class="col-sm-8" id="client-lname"></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-4"><strong>Name :</strong></div>
                        <div class="col-sm-8" id="client-name"></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-4"><strong>Contact :</strong></div>
                        <div class="col-sm-8" id="client-contact"></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-4"><strong>Email Address :</strong></div>
                        <div class="col-sm-8" id="client-email"></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-4"><strong>Date of Birth :</strong></div>
                        <div class="col-sm-8" id="client-dob"></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-sm-4"><strong>Address :</strong></div>
                        <div class="col-sm-8" id="client-address"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>

document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const clientId = this.getAttribute('data-id');
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you Sure!',
                    text: 'Do you want to Delete the Selected Client?',
                    showCancelButton: true,
                    confirmButtonText: 'YES',
                    cancelButtonText: 'CANCEL',
                    confirmButtonColor: '#000',
                    cancelButtonColor: '#e3342f',
                    customClass: {
                        popup: 'rounded-lg'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${clientId}`).submit();
                    }
                });
            });
        });
    });

    $(document).ready(function () {
        $(document).on('click', '.view-client-btn', function () {
            const clientId = $(this).data('id');
            $.ajax({
                url: `/client-show/${clientId}`,
                method: 'GET',
                success: function (client) {
                    if(client) {
                        $('#client-fname').text(client.first_name);
                        $('#client-lname').text(client.last_name);
                        $('#client-name').text(client.first_name + ' ' + client.last_name);
                        $('#client-contact').text(client.contact);
                        $('#client-email').text(client.email);
                        $('#client-dob').text(client.dob_year + '-' + client.dob_month + '-'+ client.dob_day);
                        $('#client-address').text(client.street_no +', '+ client.street_address+', ' + client.city);
                    }
                },
                error: function () {
                    alert('Failed to fetch client details.');
                }
            });
        });
    });
</script>
@endpush

