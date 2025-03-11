@include('admin.header')
    <div class="container-fluid">
        <div class="datatables">
            <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title pb-10">Product Category</h4>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('product-categories.create')}}" class="btn btn-primary">Add Category</a>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p id="modalMessage"></p> <!-- Dynamic Message -->
                            </div>
                            <div class="modal-footer">
                                <form id="deleteForm" method="POST">
                                    @csrf
                                    @method('DELETE') <!-- Hidden Delete Method -->
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="table-responsive">
                    <table id="alt_pagination" class="table table-striped table-bordered display text-nowrap">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $key => $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $key }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    @if($category->image)
                                    <img src="{{ asset($category->image) }}" width="50" height="50" alt="Image">
                                    @else
                                    <img src="{{ asset('uploads/category/product-category-default.png') }}" width="50" height="50" alt="Image">
                                    @endif
                                </td>
                                <td>
                                <a href="{{ route('product-categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                <a href="#" class="btn btn-sm btn-danger deleteItem" 
                                            data-category-id="{{ $category->id }}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal">
                                Delete
                                </a>
                                <!-- <a href="#" class="btn btn-sm btn-danger">Delete</a> -->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $categories->links('pagination::bootstrap-5') }}
                </div>
                
            </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
  document.querySelectorAll('.deleteItem').forEach(button => {
    button.addEventListener('click', function () {
        let categoryId = this.getAttribute('data-category-id');
        let modalMessage = document.getElementById('modalMessage');
        let deleteForm = document.getElementById('deleteForm');

        // Change Modal Message
        modalMessage.innerHTML = `Are you sure you want to delete this category?`;

        // Set Dynamic Form Action URL
        deleteForm.action = "{{ url('admin/product-categories') }}/" + categoryId;
    });
});


</script>




 