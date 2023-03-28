@extends('layouts.app')
@section('title', 'Change Password')
@section('content')


    <div class="card mx-auto" style="max-width:35rem;">
        <div class="card-header" style="background-color:#166ccf;">
            <h4 class="text-white my-auto">Change Password</h4>
        </div>
        <div class="card-body">
            <div>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </div>
                @elseif (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </div>
                @elseif (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                    </div>
                @endif
            </div>
            <form action="{{ url('update-password') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Current Password</label>
                    <input type="password" name="current_password" class="form-control" placeholder="Enter current password"
                        required />
                    @error('current_password')
                        <p class="text-danger font-weight-light ml-1" style="font-size: 14px;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter new password" required>
                    @error('password')
                        <p class="text-danger font-weight-light ml-1" style="font-size: 14px;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Re-enter password" required />
                    @error('password_confirmation')
                        <p class="text-danger font-weight-light ml-1" style="font-size: 14px;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3 text-end">


                    <button type="submit" class="btn btn-sm btn-primary float-right">Change Password</button>
                </div>
            </form>
        </div>
        <div class="card-foter">


        </div>
    </div>
@endsection
