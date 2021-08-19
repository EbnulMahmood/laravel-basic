@extends('admin.admin-master')
@section('admin')
    



<div class="row">
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Add Contact</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('store-contact') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Address</label>
                        <input name="address" type="text" class="form-control" id="exampleFormControlInput1" placeholder="# Road, # Street">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Email</label>
                        <input name="email" type="email" class="form-control" id="exampleFormControlInput2" placeholder="example@gmail.com">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>    
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput3">Phone</label>
                        <input name="phone" type="text" class="form-control" id="exampleFormControlInput3" placeholder="+881234567891">
                        @error('phone')
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