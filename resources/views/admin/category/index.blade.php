<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
                                  <h5 class="card-title">All Category</h5>
                                </div>
                              </div>
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th scope="col">#</th>
                                          <th scope="col">Category Name</th>
                                          <th scope="col">User</th>
                                          <th scope="col">Created At</th>
                                          <th scope="col">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach ($categories as $category)
                                        <tr>
                                            <td scope="row">{{ $categories->firstItem()+$loop->index }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $category->user->name }}</td>
                                            @if ($category->created_at)
                                                <td>{{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</td>
                                            @else
                                                <td><span class="text-danger">No date set</span></td>
                                            @endif
                                            <td>
                                                <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ url('softdelete/category/'.$category->id) }}" class="btn btn-warning">Trash</a>
                                            </td>
                                        </tr>
                                      @endforeach
                                  </tbody>
                              </table>
                              {{ $categories->links() }}
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                  <h5 class="card-title">Add Category</h5>
                                  <form action="{{ route('store-category') }}" method="POST">
                                    @csrf
                                      <div class="form-group">
                                        <label for="formGroupExampleInput">Category Name</label>
                                        <input name="category_name" type="text" class="form-control" id="formGroupExampleInput">
                                            @error('category_name')
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
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">Thash Category</h5>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($trashCategories as $category)
                                        <tr>
                                            <td scope="row">{{ $trashCategories->firstItem()+$loop->index }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $category->user->name }}</td>
                                            @if ($category->created_at)
                                                <td>{{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}</td>
                                            @else
                                                <td><span class="text-danger">No date set</span></td>
                                            @endif
                                            <td>
                                                <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info">Restore</a>
                                                <a href="{{ url('permanentdelete/category/'.$category->id) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $trashCategories->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
