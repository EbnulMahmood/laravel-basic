@extends('admin.admin-master')
@section('admin')





<div class="card card-default">
    <div class="card-header card-header-border-bottom">
      <h2>Update Profile</h2>
    </div>
    <div class="card-body">
      @if (session('message'))
            <div class="alert alert-{{ session('alert') }} alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
      <form action="{{ route('update-user-profile') }}" method="POST" enctype="multipart/form-data" class="form-pill">
        @csrf
        <input type="hidden" name="old_image" value="{{ $user->profile_photo_path }}">
        <div class="form-group">
            <img src="{{ $user->profile_photo_url }}" style="height: 150px; width: 150px;" alt="Profile Image">
        </div>
        <div class="form-group">
          <label for="formGroupExampleInput">User Image</label>
          <input name="image" type="file" class="form-control">
            @error('image')
                <span class="text-danger">{{ $message }}</span>    
            @enderror
        </div>
        <div class="form-group">
            <label for="name">User Name</label>
            <input id="name" name="name" type="text" class="form-control"
                value="{{ $user->name }}">
            @error('name')
                <span class="text-danger">{{ $message }}</span>    
            @enderror
        </div>
        <div class="form-group">
            <label for="email">User email</label>
            <input id="email" name="email" type="email" class="form-control"
                value="{{ $user->email }}">
            @error('email')
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