@extends('admin.admin-master')
@section('admin')



    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session('message'))
                                <div class="alert alert-{{ session('alert') }} alert-dismissible fade show" role="alert">
                                <strong>{{ session('message') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                            @endif
                            <h3 class="card-title">Update Slider</h3>
                            <form action="{{ url('slider/update/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                <label for="formGroupExampleInput">Title</label>
                                <input name="title" value="{{ $slider->title }}" type="text" class="form-control">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>    
                                    @enderror
                                </div>
                                <div class="form-group">
                                <label for="formGroupExampleInput">Description</label>
                                <input name="description" value="{{ $slider->description }}" type="text" class="form-control">
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>    
                                    @enderror
                                </div>
                                <div class="form-group">
                                <label for="formGroupExampleInput">Image</label>
                                <input name="image" type="file" class="form-control">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>    
                                    @enderror
                                </div>
                                <br>
                                <input type="hidden" name="old_image" value="{{ $slider->image }}">
                                <div class="form-group">
                                    <img src="{{ asset($slider->image) }}" style="height: 400px; width: 800px;" alt="Slider Image">
                                </div>
                                <br>
                            <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection