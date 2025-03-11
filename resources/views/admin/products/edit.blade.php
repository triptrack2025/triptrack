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
                    <h4 class="card-title mb-0">Edit Product</h4>
                </div>
                <div class="card-body p-4 border-bottom">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <input type="hidden" name="id" value="{{$product->id}}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="name" class="form-label">Product Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Product Name" value="{{ $product->name }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="category" class="form-label">Category</label>
                                    <select name="product_category_id" class="form-control" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->product_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" name="price" class="form-control" placeholder="Price" value="{{ $product->price }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="cancelled_price" class="form-label">Cancelled Price</label>
                                    <input type="number" name="cancelled_price" class="form-control" placeholder="Cancelled Price" value="{{ $product->cancelled_price }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" name="stock" class="form-control" placeholder="Stock" value="{{ $product->stock }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="description" hidden>{{ $product->description ?? '' }}</textarea>
                                    <div id="editor-container">
                                        <div id="editor"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="images" class="form-label">Product Images</label>
                                    <input type="file" name="images[]" class="form-control" accept="image/*" multiple>

                                    <!-- Show Existing Images -->
                                    @if($product->images->count() > 0)
                                        <div class="mt-2 d-flex flex-wrap">
                                            @foreach ($product->images as $image)
                                                <div class="position-relative me-2">
                                                    <img src="{{ asset($image->image) }}" width="100" class="img-thumbnail" alt="Product Image">
                                                    <!-- <form action="{{ route('admin.product_images.destroyimage', $image->id) }}" method="POST" style="display:inline;">
                                                        @csrf -->
                                                        <a href="{{ route('admin.product_images.destroyimage', $image->id) }}" class="btn btn-danger btn-sm position-absolute top-0 end-0">×</a>
                                                    <!-- </form> -->
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label">Is Best Seller</label>
                                    <div class="form-check">
                                        <input type="checkbox" name="is_best_seller" class="form-check-input" id="is_best_seller" value="1" 
                                            {{ $product->is_best_seller ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_best_seller">Yes</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label class="form-label">Is Popular Product</label>
                                    <div class="form-check">
                                        <input type="checkbox" name="is_popular_product" class="form-check-input" id="is_popular_product" value="1" 
                                            {{ $product->is_popular_product ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_popular_product">Yes</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-12">
                                <div class="d-flex align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
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

        // Set initial content to Quill Editor from textarea
        const existingContent = document.querySelector('#description').value;
        if (existingContent) {
            quill.root.innerHTML = existingContent;
        }

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