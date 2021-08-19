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
                          <h5 class="card-title">All Brand</h5>
                        </div>
                    </div>
                      <table class="table">
                          <thead>
                              <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Brand Name</th>
                                  <th scope="col">Brand Image</th>
                                  <th scope="col">Created At</th>
                                  <th scope="col">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($brands as $brand)
                                <tr>
                                    <td scope="row">{{ $brands->firstItem()+$loop->index }}</td>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td><img src="{{ asset($brand->brand_image) }}" style="height: 30px; width: 50px;" alt="Brand Image"></td>
                                    @if ($brand->created_at)
                                        <td>{{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}</td>
                                    @else
                                        <td><span class="text-danger">No date set</span></td>
                                    @endif
                                    <td>
                                        <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('brand/delete/'.$brand->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                              @endforeach
                          </tbody>
                      </table>
                      {{ $brands->links('pagination::bootstrap-4') }}
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">Add Brand</h5>
                          <form action="{{ route('store-brand') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                              <div class="form-group">
                                <label for="formGroupExampleInput">Brand Name</label>
                                <input name="brand_name" type="text" class="form-control">
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
                            <button type="submit" class="btn btn-primary">Add</button>
                          </form>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>



@endsection