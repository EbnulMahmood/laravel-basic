@extends('admin.admin-master')
@section('admin')
    



    <div class="py-12">
        <div class="container">
            <div class="bg-light d-flex justify-content-between">
                <h3>Slider Home</h3>
                <a href="{{ route('add-slider') }}"><button type="button" class="btn btn-info">Add Slider</button></a>
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
                          <h5 class="card-title">All Slider</h5>
                        </div>
                    </div>
                      <table class="table">
                          <thead>
                              <tr>
                                  <th scope="col" width="5%">#</th>
                                  <th scope="col" width="15%">Title</th>
                                  <th scope="col" width="25%">Description</th>
                                  <th scope="col" width="15%">Image</th>
                                  <th scope="col" width="5%">Activate</th>
                                  <th scope="col" width="15%">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($sliders as $slider)
                                <tr>
                                    <td scope="row">{{ $sliders->firstItem()+$loop->index }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td><p>{{ $slider->description }}</p></td>
                                    <td><img src="{{ asset($slider->image) }}" style="height: 100px; width: 150px;" alt="Slider Image"></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('slider/delete/'.$slider->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                              @endforeach
                          </tbody>
                      </table>
                      {{ $sliders->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>



@endsection