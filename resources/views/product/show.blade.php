@extends('layouts.frontend')

@section('seo')
    <title>{{ $product->name }} | {{ $systemName->name }}</title>
    <meta charset="UTF-8">
    <meta name="description" content="{{ $product->meta_description }}">
    <meta name="keywords" content="{{ $product->meta_keywords }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('content')

    <!-- Page info -->
    <div class="page-top-info">
        <div class="container">
            <h4>{{ $product->category->name }}</h4>
            <div class="site-pagination">
                <a href="{{ route('welcome') }}">Trang chủ</a> /
                <a href="">Cửa hàng</a>
            </div>
        </div>
    </div>
    <!-- Page info end -->


    <!-- product section -->
    <section class="product-section">
        <div class="container">
            <div class="back-link">
                <a href="{{ route('frontendCategories') }}"> &lt;&lt; Quay lại Danh mục</a>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-pic-zoom">

                        @if ($singleImage != null)
                            <img class="product-big-img" src="/storage/{{ $singleImage->images }}" alt="">
                        @else
                            <img src="{{ asset('frontend/img/no-image.png') }}" alt="">
                        @endif
                    </div>
                    <div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
                        <div class="product-thumbs-track">
                            @foreach ($product->photos as $image)
                                <div class="pt active"
                                    data-imgbigurl="
								@if ($image->count() > 0) /storage/{{ $image->images }}
		                            @else
		                                {{ asset('frontend/img/no-image.png') }} @endif
								">
                                    @if ($image->count() > 0)
                                        <img src="/storage/{{ $image->images }}" alt="">
                                    @else
                                        <img src="{{ asset('frontend/img/no-image.png') }}" alt="">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 product-details">
                    <h2 class="p-title">{{ $product->name }}</h2>
                    <h3 class="p-price">{{ $product->price }}đ</h3>
                    @if ($pieces)
                        <h4 class="p-stock">Pieces:
                            <span>
                                {{ $pieces->attribute_value }}
                            </span>
                        </h4>
                    @endif
                    <h4 class="p-stock">Availability:
                        <span>
                            @if ($product->inStock())
                                In Stock
                            @else
                                Out Of Stock
                            @endif
                        </span>
                    </h4>
                    <!-- Add to cart logic -->
                    <form action="{{ route('cart.store') }}" method="post">
                        @csrf
                        @if (!empty($color))
                            <div class="fw-size-choose">
                                <p>Màu</p>
                                @foreach ($color as $c)
                                    <div class="sc-item">
                                        <input type="radio" name="Color" id="{{ $c->attribute_value }}"
                                            value="{{ $c->attribute_value }}">
                                        <label for="{{ $c->attribute_value }}"
                                            class="choose-color">{{ $c->attribute_value }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if (!empty($sizes))
                            <div class="fw-size-choose">
                                <p>Size</p>
                                @foreach ($sizes as $size)
                                    <div class="sc-item">
                                        <input type="radio" name="Size" id="{{ $size->attribute_value }}"
                                            value="{{ $size->attribute_value }}">
                                        <label for="{{ $size->attribute_value }}">{{ $size->attribute_value }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endif


                        <div class="quantity">
                            <p>Số lượng</p>
                            <div class="pro-qty"><input type="text" name="quantity" value="1"></div>
                        </div>
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{ $product->price }}">
                        <button type="submit" class="site-btn">Add To Cart</button>
                    </form>

                    <div id="accordion" class="accordion-area">
                        <div class="panel">
                            <div class="panel-header" id="headingOne">
                                <button class="panel-link active" data-toggle="collapse" data-target="#collapse1"
                                    aria-expanded="true" aria-controls="collapse1">Mô tả</button>
                            </div>
                            <div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="panel-body">
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-header" id="headingThree">
                                <button class="panel-link" data-toggle="collapse" data-target="#collapse3"
                                    aria-expanded="false" aria-controls="collapse3">Vận chuyển & Đổi trả</button>
                            </div>
                            <div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="panel-body">
                                    <h4>Đổi hàng tr ong 7 ngày</h4>
                                    <p>Có dịch vụ thanh toán khi nhận hàng<br>Giao hàng tận nhà <span>3 - 4 ngày</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product section end -->


    <!-- RELATED PRODUCTS section -->
    <section class="related-product-section">
        <div class="container">
            <div class="section-title">
                <h2>RELATED PRODUCTS</h2>
            </div>
            <div class="product-slider owl-carousel">
                @foreach ($relatedProducts as $related)
                    <div class="product-item">
                        <div class="pi-pic">
                            <a href="{{ route('single-product', $related->slug) }}">
                                @if ($related->photos->count() > 0)
                                    <img src="/storage/{{ $related->photos->first()->images }}" alt="">
                                @else
                                    <img src="{{ asset('frontend/img/no-image.png') }}" alt="">
                                @endif
                            </a>
                            <div class="pi-links">
                                <form action="{{ route('cart.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $related->id }}">
                                    <input type="hidden" name="name" value="{{ $related->name }}">
                                    <input type="hidden" name="price" value="{{ $related->price }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="add-card"><i class="flaticon-bag"></i><span>ADD TO
                                            CART</span></button>
                                </form>
                                <form action="{{ route('wishlist.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $related->id }}">
                                    <input type="hidden" name="name" value="{{ $related->name }}">
                                    <input type="hidden" name="price" value="{{ $related->price }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="wishlist-btn"><i class="flaticon-heart"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6>${{ $related->price }}</h6>
                            <p>{{ $related->name }} </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- RELATED PRODUCTS section end -->

@endsection
