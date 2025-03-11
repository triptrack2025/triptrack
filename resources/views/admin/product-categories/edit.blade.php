@include('admin.header')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0" style="text-align:left;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="card">
                
                <div class="px-4 py-3 border-bottom">
                    <h4 class="card-title mb-0">Edit Product Category</h4>
                </div>
                <div class="card-body p-4 border-bottom">
                    <form action="{{ route('product-categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <input type="hidden" name="id" value="{{$category->id}}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="name" class="form-label">Category Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Category Name" value="{{ $category->name }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    @if($category->image)
                                        <div class="mt-2">
                                            <img src="{{ asset($category->image) }}" width="100" alt="Category Image">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-12">
                                <div class="d-flex align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('product-categories.index') }}" class="btn bg-danger-subtle text-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')
