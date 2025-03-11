@include('admin.header')
<div class="container-fluid">
    <div class="datatables">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="card-title pb-10">Products</h4>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('products.create')}}" class="btn btn-primary">Add Product</a>
                    </div>
                </div>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p id="modalMessage"></p>
                            </div>
                            <div class="modal-footer">
                                <form id="deleteForm" method="POST">
                                    @csrf
                                    @method('DELETE')
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
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $key => $product)
                            <tr>
                                <td>{{ $products->firstItem() + $key }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    @if($product->images->first())
                                        <img src="{{ asset($product->images->first()->image) }}" width="50" height="50" alt="Image">
                                    @else
                                        <img src="{{ asset('uploads/products/default.png') }}" width="50" height="50" alt="Image">
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="#" class="btn btn-sm btn-danger deleteItem" 
                                       data-product-id="{{ $product->id }}" 
                                       data-bs-toggle="modal" 
                                       data-bs-target="#deleteModal">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
  document.querySelectorAll('.deleteItem').forEach(button => {
    button.addEventListener('click', function () {
        let productId = this.getAttribute('data-product-id');
        let modalMessage = document.getElementById('modalMessage');
        let deleteForm = document.getElementById('deleteForm');

        modalMessage.innerHTML = `Are you sure you want to delete this product?`;
        deleteForm.action = "{{ url('admin/products') }}/" + productId;
    });
});
</script>