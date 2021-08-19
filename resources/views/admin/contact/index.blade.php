@extends('admin.admin-master')
@section('admin')
    



    <div class="py-12">
        <div class="container">
            <div class="bg-light d-flex justify-content-between">
                <h3>Contact</h3>
                <a href="{{ route('add-contact') }}"><button type="button" class="btn btn-info">Add Contact</button></a>
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
                          <h5 class="card-title">All Contact</h5>
                        </div>
                    </div>
                      <table class="table">
                          <thead>
                              <tr>
                                  <th scope="col" width="5%">#</th>
                                  <th scope="col" width="15%">Address</th>
                                  <th scope="col" width="25%">Email</th>
                                  <th scope="col" width="15%">Phone</th>
                                  <th scope="col" width="15%">Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach ($contacts as $contact)
                                <tr>
                                    <td scope="row">{{ $contacts->firstItem()+$loop->index }}</td>
                                    <td>{{ $contact->address }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>
                                        <a href="{{ url('contact/edit/'.$contact->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('contact/delete/'.$contact->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                              @endforeach
                          </tbody>
                      </table>
                      {{ $contacts->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>



@endsection