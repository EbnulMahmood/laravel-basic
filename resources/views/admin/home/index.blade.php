@extends('admin.admin-master')
@section('admin')
    



    <div class="py-12">
        <div class="container">
            <div class="bg-light d-flex justify-content-between">
                <h3>About Home</h3>
                <a href="{{ route('add-about') }}"><button type="button" class="btn btn-info">Add About</button></a>
            </div>
            <br>
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
                          <h5 class="card-title">All About</h5>
                        </div>
                    </div>
                      <table class="table">
                          <thead>
                              <tr>
                                  <th scope="col" width="5%">#</th>
                                  <th scope="col" width="15%">Title</th>
                                  <th scope="col" width="25%">Short Description</th>
                                  <th scope="col" width="15%">Long Description</th>
                                  <th scope="col" width="15%">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($homeabout as $about)
                                <tr>
                                    <td scope="row">{{ $homeabout->firstItem()+$loop->index }}</td>
                                    <td>{{ $about->title }}</td>
                                    <td><p>{{ $about->short_description }}</p></td>
                                    <td><p>{{ substr($about->long_description, 0, 100) }}...</p></td>
                                    <td>
                                        <a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('about/delete/'.$about->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                              @endforeach
                          </tbody>
                      </table>
                      {{ $homeabout->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>



@endsection