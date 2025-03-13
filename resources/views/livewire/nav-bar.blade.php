<nav class="main-navbar">
    <div class="container">
        <!-- menu -->
        <ul class="main-menu">
            <li><a href="/">Trang chủ</a></li>
            <li><a href="{{ route('frontendCategories') }}">Cửa hàng của chúng tôi</a>
                <ul class="sub-menu">
                    @foreach ($navCategories as $cat)
                        <li><a href="{{ route('frontendCategory', $cat->slug) }}">{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{ route('on-sale') }}">Giảm giá
                    <span class="new">Sale</span>
                </a></li>
            {{-- <li><a href="#">Blog</a></li> --}}
            <li><a href="{{ route('contact-us') }}">Liên hệ</a></li>
            @auth
                <li><i class="flaticon-profile mr-2  text-light"></i><a href="#">{{ auth()->user()->name }}</a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('my-profile.edit') }}">Cài đặt</a></li>
                        <li><a href="{{ route('my-orders.index') }}">Đơn hàng của tôi</a></li>
                        @if (auth()->user()->hasAnyRole(['Super Admin', 'admin']))
                            <li><a href="{{ route('home') }}" target="_blank">Bảng điều khiển quản trị</a></li>
                        @endif
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                {{ __('Đăng xuất') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @else
                <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                <li> <a href="{{ route('register') }}">Đăng ký</a></li>
            @endauth
        </ul>
    </div>
</nav>
