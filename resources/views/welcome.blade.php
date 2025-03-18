@extends('layouts.frontend')

@section('seo')
    <title>Welcome To | {{ $systemName->name }}</title>
    <meta charset="UTF-8">
    <meta name="description" content="{{ $systemName->description }}">
    <meta name="keywords" content="{{ $systemName->name }}, {{ $systemName->name }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@endsection

@section('content')

    @if ($slides->count() > 0)
        <!-- Hero section -->
        <section class="hero-section">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
                <ol class="carousel-indicators">
                    @foreach ($slides as $index => $slide)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $index }}"
                            class="{{ $index == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach ($slides as $index => $slide)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img class="d-block w-100" src="/storage/{{ $slide->image }}" alt="Slide {{ $index + 1 }}">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>
        <!-- Hero section end -->
        <!-- Features section -->
        {{-- <section class="features-section">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 p-0 feature">
                        <div class="feature-inner">
                            <div class="feature-icon">
                                <img src="{{ asset('frontend/img/icons/1.png') }}" alt="#">
                            </div>
                            <h4>Fast Secure Payments</h4>
                        </div>
                    </div>
                    <div class="col-md-4 p-0 feature">
                        <div class="feature-inner">
                            <div class="feature-icon">
                                <img src="{{ asset('frontend/img/icons/2.png') }}" alt="#">
                            </div>
                            <h4 class="text-white">Premium Products</h4>
                        </div>
                    </div>
                    <div class="col-md-4 p-0 feature">
                        <div class="feature-inner">
                            <div class="feature-icon">
                                <img src="{{ asset('frontend/img/icons/3.png') }}" alt="#">
                            </div>
                            <h4>Affordable Delivery</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- Features section end -->
    @endif


    <!-- letest product section -->
    <section class="top-letest-product-section">
        <div class="container">
            <div class="section-title">
                <h3>Sản phẩm nổi bật</h3>
            </div>
            <div class="product-slider owl-carousel">
                @foreach ($products as $p)
                    <div class="product-item">
                        <div class="pi-pic">
                            @if ($p->on_sale == 1)
                                <div class="tag-sale">ON SALE</div>
                            @endif
                            @if ($p->is_new == 1)
                                <div class="tag-new">New</div>
                            @endif
                            <a href="{{ route('single-product', $p->slug) }}">
                                @if ($p->photos->count() > 0)
                                    <img src="/storage/{{ $p->photos->first()->images }} " alt="">
                                @else
                                    <img src="{{ asset('frontend/img/no-image.png') }}" alt="">
                                @endif
                            </a>
                            <div class="pi-links">
                                <form action="{{ route('cart.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $p->id }}">
                                    <input type="hidden" name="name" value="{{ $p->name }}">
                                    <input type="hidden" name="price" value="{{ $p->price }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="add-card"><i class="flaticon-bag"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6> {{ $p->price }}đ</h6>
                            <a href="{{ route('single-product', $p->slug) }}">
                                <p>{{ $p->name }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- letest product section end -->



    <!-- Product filter section -->
    <section class="product-filter-section">
        <div class="container">
            <div class="section-title">
                <h3>Danh mục sản phẩm</h3>
            </div>
            <ul class="product-filter-menu">
                @foreach ($categories as $cat)
                    <li><a href="{{ route('frontendCategory', $cat->slug) }}">{{ $cat->name }}</a></li>
                @endforeach
            </ul>
            <div class="row">
                @foreach ($products as $p)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6">
                        <div class="product-item">
                            <div class="pi-pic">
                                @if ($p->on_sale == 1)
                                    <div class="tag-sale">ON SALE</div>
                                @endif
                                @if ($p->is_new == 1)
                                    <div class="tag-new">New</div>
                                @endif
                                <a href="{{ route('single-product', $p->slug) }}">
                                    <a href="{{ route('single-product', $p->slug) }}">
                                        @if ($p->photos->count() > 0)
                                            <img src="/storage/{{ $p->photos->first()->images }} " alt="">
                                        @else
                                            <img src="{{ asset('frontend/img/no-image.png') }}" alt="">
                                        @endif
                                    </a>
                                </a>
                                <div class="pi-links">
                                    <form action="{{ route('cart.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $p->id }}">
                                        <input type="hidden" name="name" value="{{ $p->name }}">
                                        <input type="hidden" name="price" value="{{ $p->price }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="add-card"><i class="flaticon-bag"></i><span>ADD TO
                                                CART</span></button>
                                    </form>
                                </div>
                            </div>
                            <div class="pi-text">
                                <h6>{{ $p->price }}đ</h6>
                                <p> {{ $p->name }} </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($products->count() > 8)
                <div class="text-center pt-5">
                    <a href="{{ route('frontendCategories') }}" class="site-btn sb-line sb-dark">VIEW MORE</a>
                </div>
            @endif
        </div>
    </section>
    <!-- Product filter section end -->

@endsection
