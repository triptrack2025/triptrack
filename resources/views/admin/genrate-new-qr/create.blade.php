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
                    <h4 class="card-title mb-0">Generate QR Code</h4>
                </div>
                <div class="card-body p-4 border-bottom">
                    <form action="{{ route('admin.generate.qrcodes') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-4">
                                    <label for="name" class="form-label">QR Code Quantity</label>
                                    <input type="number" name="qr_code_quantity" class="form-control" placeholder="Enter QR Code Quantity" required>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-12">
                                <div class="d-flex align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
