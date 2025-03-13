<section class="footer-section">
	<div class="container">
		<div class="footer-logo text-center">
			<a href="/"><img src="" alt=""></a>
		</div>
		<div class="row">
			<div class="col-lg-3 col-sm-6">
				<div class="footer-widget about-widget">
					<h2>About</h2>
					<p>{{ $systemDetail->description }}</p>
					<img src="{{ asset('frontend/img/cards.png') }}" alt="">
				</div>
			</div>
			<div class="col-lg-3 col-sm-6">
				<div class="footer-widget about-widget">
					<h2>Liên kết hữu ích</h2>
					<ul>
						{{-- <li><a href="{{ route('about-us') }}">Về Chúng Tôi</a></li> --}}
						{{-- <li><a href="">Track Orders</a></li>
						<li><a href="">Shipping</a></li> --}}
						{{-- <li><a href="{{ route('contact-us') }}">Liên hệ</a></li> --}}
						{{-- <li><a href="{{ route('my-orders.index') }}">Đơn hàng của tôi</a></li> --}}
					</ul>
					<ul>
						{{-- <li><a href="{{ route('contact-us') }}">Hỗ trợ</a></li> --}}
						{{-- <li><a href="{{ route('terms.conditions') }}">Terms of Use</a></li> --}}
						{{-- <li><a href="">Blog</a></li> --}}
					</ul>
				</div>
			</div>
			{{-- <div class="col-lg-3 col-sm-6">
				<div class="footer-widget about-widget">
					<h2>Blog</h2>
					<div class="fw-latest-post-widget">
						<div class="lp-item">
							<div class="lp-thumb set-bg" data-setbg="{{ asset('frontend/img/blog-thumbs/1.jpg') }}"></div>
							<div class="lp-content">
								<h6>How to order?</h6>
								<span>July 11, 2020</span>
								<a href="#" class="readmore">Read More</a>
							</div>
						</div>
						<div class="lp-item">
							<div class="lp-thumb set-bg" data-setbg="{{ asset('frontend/img/blog-thumbs/2.jpg') }}"></div>
							<div class="lp-content">
								<h6>Returns</h6>
								<span>July 11, 2020</span>
								<a href="#" class="readmore">Read More</a>
							</div>
						</div>
					</div>
				</div>
			</div> --}}
			<div class="col-lg-3 col-sm-6">
				<div class="footer-widget contact-widget">
					<h2>Contact</h2>
					<div class="con-info">
						<span>C.</span>
						<p>{{ $systemDetail->name }} </p>
					</div>
					<div class="con-info">
						<span>B.</span>
						<p>{{ $systemDetail->address }} </p>
					</div>
					<div class="con-info">
						<span>T.</span>
						<p>{{ $systemDetail->tel }}</p>
					</div>
					<div class="con-info">
						<span>E.</span>
						<p>{{ $systemDetail->email }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- <div class="social-links-warp">
		<div class="container">
			<p class="text-white text-center mt-5">Bản quyền &copy;<script>document.write(new Date().getFullYear());</script> Tất cả các quyền được bảo lưu | Phát triển bởi <a href="" target="_blank">Vu Minh Hieu</a></p>
		</div>
	</div> --}}
</section>
