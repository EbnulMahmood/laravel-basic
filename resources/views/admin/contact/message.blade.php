@extends('admin.admin-master')
@section('admin')
    



    <div class="py-12">
        <div class="container">
            <div class="bg-light d-flex justify-content-between">
                <h3>Message</h3>
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
                          <h5 class="card-title">All Message</h5>
                        </div>
                    </div>
                      <table class="table">
                          <thead>
                              <tr>
                                  <th scope="col" width="5%">#</th>
                                  <th scope="col" width="15%">Name</th>
                                  <th scope="col" width="25%">Email</th>
                                  <th scope="col" width="15%">Subject</th>
                                  <th scope="col" width="15%">Message</th>
                                  <th scope="col" width="15%">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($messages as $message)
                                <tr>
                                    <td scope="row">{{ $messages->firstItem()+$loop->index }}</td>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->subject }}</td>
                                    <td>{{ $message->message }}</td>
                                    <td>
                                        <a href="{{ url('message/delete/'.$message->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                              @endforeach
                          </tbody>
                      </table>
                      {{ $messages->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>



@endsection