@extends('admin.admin-master')
@section('admin')



    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
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
                            <h5 class="card-title">Update Brand</h5>
                            <form action="{{ url('brand/update/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group">
                                <label for="formGroupExampleInput">Brand Name</label>
                                <input name="brand_name" value="{{ $brand->brand_name }}" type="text" class="form-control">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>    
                                    @enderror
                                </div>
                                <div class="form-group">
                                <label for="formGroupExampleInput">Brand Image</label>
                                <input name="brand_image" type="file" class="form-control">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>    
                                    @enderror
                                </div>
                                <br>
                                <input type="hidden" name="old_image" value="{{ $brand->brand_image }}">
                                <div class="form-group">
                                    <img src="{{ asset($brand->brand_image) }}" style="height: 200px; width: 400px;" alt="Brand Image">
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