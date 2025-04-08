@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
<a href="/client-add" style="margin-bottom: 40px; margin-left: 10px">Add user</a>
    <div class="container-fluid">
        <!-- Tables -->
        <div class="row">
            <div class="col-md-12">
                <h4>CLIENTS</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/images/' . $client->image) ?? '' }}" alt="Client Image" width="50" height="50">
                                </td>
                                <td>{{ $client->first_name }} {{ $client->last_name }}</td>
                                <td>{{ $client->contact }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ ucfirst($client->status) }}</td>
                                <td>
                                    <a href="/client-edit/{{ $client->id }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="/client-delete/{{ $client->id }}" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $client->id }})">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script>
    function confirmDelete(clientId) {
        if (confirm('Are you sure you want to delete this client?')) {

            $.ajax({
                url: '/client-delete/' + clientId,
                type: 'DELETE', 
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    alert(response.success); 
                    $('#client-row-' + clientId).remove(); 
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.error);
                }
            });
        }
    }
</script>
