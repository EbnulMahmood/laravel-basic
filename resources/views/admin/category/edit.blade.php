<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Category
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
                                  <h5 class="card-title">Update Category</h5>
                                  <form action="{{ url('category/update/'.$category->id) }}" method="POST">
                                    @csrf
                                      <div class="form-group">
                                        <label for="formGroupExampleInput">Category Name</label>
                                        <input name="category_name" value="{{ $category->category_name }}" type="text" class="form-control" id="formGroupExampleInput">
                                            @error('category_name')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
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
        </div>
    </div>
</x-app-layout>
