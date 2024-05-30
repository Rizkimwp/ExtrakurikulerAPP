@extends('app')

@section('title', 'Profile')

@section('style')

@endsection

@section('content')
<div class="container-fluid">

    <div class="container">
        <h2>User Profile</h2>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                Profile Details
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <!-- Add other user details as needed -->
            </div>
        </div>
    </div>
</div>
@endsection
