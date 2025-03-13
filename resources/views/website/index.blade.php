
@include('website.header')
	@if(session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
	@endif

	@if(session('error'))
		<div class="alert alert-danger">
			{{ session('error') }}
		</div>
	@endif

	<section id="billboard">
        <div class="container banner-container">
            <div class="row">
                <div class="col-md-12">

                    <!-- Previous Button -->
                    <button class="prev slick-arrow">
                        <i class="icon icon-arrow-left"></i>
                    </button>

                    <!-- Main Slider -->
                    <div class="main-slider pattern-overlay">
                        <div class="slider-item">
						<img src="{{ asset('assets/images/Home_page_1.jpg') }}" alt="banner" class="banner-image">
						<div class="banner-content">
                                <h3 class="banner-title banner-title-color">Pack Your Bags, Forget Your Worries</h3>
                                <div class="btn-wrap">
                                    <a href="{{ url('/collection/all') }}" class="btn btn-outline-accent btn-accent-arrow">Shop Now <i class="icon icon-ns-arrow-right"></i></a>
                                </div>
                            </div>
                        </div><!--slider-item-->

						<div class="slider-item">
						<img src="{{ asset('assets/images/Home_page_9.jpg') }}" alt="banner" class="banner-image">
						<div class="banner-content">
                                <h3 class="banner-title">Gifts as Unique as Them, Customized Delights for Every Occasion</h3>
                                <div class="btn-wrap">
                                    <a href="{{ url('/collection/all') }}" class="btn btn-outline-accent btn-accent-arrow">Shop Now <i class="icon icon-ns-arrow-right"></i></a>
                                </div>
                            </div>
                        </div><!--slider-item-->

                        <div class="slider-item">
						<img src="{{ asset('assets/images/Home_page_5.jpg') }}" alt="banner" class="banner-image">
						<div class="banner-content">
                                <h3 class="banner-title banner-title-color">Effortlessly Track Your Daily Necessities</h3>
                                <div class="btn-wrap">
                                    <a href="{{ url('/collection/all') }}" class="btn btn-outline-accent btn-accent-arrow">Shop Now <i class="icon icon-ns-arrow-right"></i></a>
                                </div>
                            </div>
                        </div><!--slider-item-->

						<div class="slider-item">
						<img src="{{ asset('assets/images/Home_page_8.webp') }}" alt="banner" class="banner-image">
						<div class="banner-content">
                                <h3 class="banner-title banner-title-color">Never Let Go of What Matters Most</h3>
                                <div class="btn-wrap">
                                    <a href="{{ url('/collection/all') }}" class="btn btn-outline-accent btn-accent-arrow">Shop Now <i class="icon icon-ns-arrow-right"></i></a>
                                </div>
                            </div>
                        </div><!--slider-item-->

			
                    </div><!--slider-->

                    <!-- Next Button -->
                    <button class="next slick-arrow">
                        <i class="icon icon-arrow-right"></i>
                    </button>

                </div>
            </div>
        </div>
    </section>

	<section id="featured-books" class="py-5 my-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<div class="section-header align-center">
						<div class="title">
							<span>Some Best items</span>
						</div>
						<h2 class="section-title">Best Sellers</h2>
					</div>

					<div class="product-list" data-aos="fade-up">
						<div class="row">
							@foreach($bestSellers as $product)
							<div class="col-md-3">
								<div class="product-item">
									<figure class="product-style">
										@php
											$firstImage = $product->images->first() ? asset($product->images->first()->image) : asset('uploads/products/default.png');
										@endphp
										<img src="{{ $firstImage }}" alt="{{ $product->name }}" class="product-item">
										<button type="button" class="add-to-cart" data-product-tile="add-to-cart">Add to Cart</button>
									</figure>
									<figcaption>
										<a href="{{ url('collection/products/' . $product->slug) }}">
											<h3 class="product-title">{{ $product->name }}</h3>
										</a>
										<span>{{ $product->category->name ?? 'Uncategorized' }}</span>
										<div class="item-price">	
											Rs. {{ $product->price }}
											<span class="text-decoration-line-through fw-bold">Rs.  {{ $product->cancelled_price }}</span>
										</div>
									</figcaption>
								</div>
							</div>
							@endforeach
						</div>
					</div>

				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="btn-wrap align-right">
						<a href="{{ url('/collection/all') }}" class="btn-accent-arrow">View all products <i class="icon icon-ns-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="popular-books" class="bookshelf py-5 my-5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-header align-center">
						<div class="title">
							<span>Some Popular items</span>
						</div>
						<h2 class="section-title">Popular Products</h2>
					</div>
					<div class="row">
						@foreach($populerProducts as $populer_product)
						<div class="col-md-3">
							<div class="product-item">
								<figure class="product-style">
									@php
										$firstImage = $populer_product->images->first() ? asset($populer_product->images->first()->image) : asset('uploads/products/default.png');
									@endphp
									<img src="{{ $firstImage }}" alt="{{ $populer_product->name }}" class="product-item">
									<button type="button" class="add-to-cart" data-product-tile="add-to-cart">
										Add to Cart
									</button>
								</figure>
								<figcaption>
									<a href="{{ url('collection/products/' . $populer_product->slug) }}">
										<h3 class="product-title">{{ $populer_product->name }}</h3>
									</a>
									<span>{{ $populer_product->category->name ?? 'Uncategorized' }}</span>
									<div class="item-price">	
										Rs. {{ $populer_product->price }}
										<span class="text-decoration-line-through fw-bold">Rs.  {{ $populer_product->cancelled_price }}</span>

									</div>
								</figcaption>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>
	

@include('website.footer')