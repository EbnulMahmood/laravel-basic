@extends('admin.admin-master')
@section('admin')
    



<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Update About</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('about/update/'.$homeabout->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Title</label>
                        <input name="title" value="{{ $homeabout->title }}" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Slider Title">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Short Description</label>
                        <textarea name="short_description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $homeabout->short_description }}</textarea>
                        @error('short_description')
                            <span class="text-danger">{{ $message }}</span>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea2">Long Description</label>
                        <textarea name="long_description" class="form-control" id="exampleFormControlTextarea2" rows="3">{{ $homeabout->long_description }}</textarea>
                        @error('long_description')
                            <span class="text-danger">{{ $message }}</span>    
                        @enderror
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection