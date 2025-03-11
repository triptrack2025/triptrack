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
                    <h4 class="card-title mb-0">Add Product</h4>
                </div>
                <div class="card-body p-4 border-bottom">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Product Name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="product_category_id" class="form-label">Category</label>
                                    <select name="product_category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control" placeholder="Price" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="cancelled_price" class="form-label">Cancelled Price</label>
                                    <input type="number" name="cancelled_price" class="form-control" placeholder="Cancelled Price" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" name="stock" class="form-control" placeholder="Stock" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" hidden></textarea>
                                    <div id="editor-container">
                                            <div id="editor"></div>
                                        </div>
                                 
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="is_best_seller" class="form-label">Is Best Seller</label>
                                    <div class="form-check">
                                        <input type="checkbox" name="is_best_seller" class="form-check-input" id="is_best_seller" value="1">
                                        <label class="form-check-label" for="is_best_seller">Yes</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="is_popular_product" class="form-label">Is Popular Product</label>
                                    <div class="form-check">
                                        <input type="checkbox" name="is_popular_product" class="form-check-input" id="is_popular_product" value="1">
                                        <label class="form-check-label" for="is_popular_product">Yes</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row pt-4">
                            <div class="col-12">
                                <div class="d-flex align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('products.index') }}" class="btn bg-danger-subtle text-danger">Cancel</a>
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        // Set content to hidden textarea before form submit
        document.querySelector('form').onsubmit = function () {
            document.querySelector('#description').value = quill.root.innerHTML;
        };

        // MutationObserver to detect changes
        const observer = new MutationObserver(() => {
            console.log('Mutation detected');
        });

        observer.observe(document.querySelector('.ql-editor'), {
            childList: true,
            subtree: true
        });
    });
</script>