@include('website.header')

<style>
	.product-title{
		margin-bottom:0;
	}
	</style>
<section id="featured-books" class="py-5 my-5">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-header align-center">
					<h2 class="section-title">All Products</h2>
				</div>

				<div class="product-list" data-aos="fade-up">
					<div class="row">
					@foreach($products as $product)
					
						<div class="col-md-3">
							<div class="product-item">
								<figure class="product-style">
									@php
										$firstImage = $product->images->first() ? asset($product->images->first()->image) : asset('uploads/products/default.png');
									@endphp
									
									<img src="{{ $firstImage }}" alt="{{ $product->name }}" class="product-item">
									<button type="button" class="add-to-cart" data-product-id="{{ $product->id }}">Add to Cart</button>
								</figure>
								<figcaption>
									<a href="{{ url('collection/products/' . $product->slug) }}">
										<h3 class="product-title">{{ $product->name }}</h3>
									</a>

									<span>{{ $product->category->name ?? 'Uncategorized' }}</span>
									<div class="item-price">
										Rs. {{ $product->price }}
										<span class="text-decoration-line-through fw-bold">Rs. {{ $product->cancelled_price }}</span>
									</div>
								</figcaption>
							</div>
						</div>
					@endforeach

					</div>

					{{-- Pagination --}}
					<div class="pagination justify-content-center mt-5">
						{{ $products->links('pagination::bootstrap-4') }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('website.footer')
