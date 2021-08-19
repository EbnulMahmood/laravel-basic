@extends('admin.admin-master')
@section('admin')





<div class="card card-default">
    <div class="card-header card-header-border-bottom">
      <h2>Change Password</h2>
    </div>
    <div class="card-body">
      <form action="{{ route('update-password') }}" method="POST" class="form-pill">
        @csrf
        <div class="form-group">
            <label for="current_password">Current Password</label>
            <input id="current_password" name="current_password" type="password" class="form-control"
                placeholder="Current Password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>    
            @enderror
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            <input id="password" name="password" type="password" class="form-control"
                placeholder="New Password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>    
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control"
                placeholder="Confirm Password">
            @error('password')
                <span class="text-danger">{{ $message }}</span>    
            @enderror
        </div>
          <div class="form-footer pt-4 pt-5 mt-4 border-top">
            <button type="submit" class="btn btn-primary btn-default">Save</button>
        </div>
      </form>
    </div>
  </div>





@endsection