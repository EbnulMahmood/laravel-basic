@extends('admin.admin-master')
@section('admin')





    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (session('message'))
                    <div class="alert alert-{{ session('alert') }} alert-dismissible fade show" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                @endif
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($images as $image)
                        <div class="col-4">
                            <div class="card h-100">
                                <img src="{{ asset($image->image) }}" class="card-img-top" alt="Image">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Images</h5>
                        <form action="{{ route('store-image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                            <label for="formGroupExampleInput">Brand Images</label>
                            <input name="image[]" type="file" class="form-control" multiple="" id="formGroupExampleInput">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>    
                                @enderror
                            </div>
                            <br>
                        <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                    </div>
            </div>
        </div>
    </div>





@endsection