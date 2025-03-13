@extends('layouts.app')

@section('content')

<!-- breadcrumb -->
<nav area-label="breadcrumb">

	<ol class="breadcrumb">
		<a href="{{ route('home') }}" class="text-decoration-none mr-3">
			<li class="breadcrumb-item">Home</li>
		</a>
		<li class="breadcrumb-item active">Mã giảm giá</li>
	</ol>
	
</nav>

<div class="card">
	<div class="card-header d-flex justify-content-between btn-sm">
		<span>Mã giảm giá</span>
		<a href="{{ route('coupon.create') }}" class="btn btn-dark">Tạo mã giảm giá</a>
	</div>
	<div class="card-body">
		<table class="table table-dark table-bordered">
			<thead>
				<th>Loại</th>
				<th>Mã giảm giá</th>
				<th>Giá trị</th>
				<th>Chỉnh sửa</th>
				<th>Xóa</th>
			</thead>
			<tbody>
				@foreach($coupons as $coupon)
				<tr class="text-capitalize">
					<td> {{ $coupon->type }} </td>
					<td> {{ $coupon->code }} </td>
					<td> {{ $coupon->value ?? $coupon->percent_off }} </td>
					<td>
						<a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-sm btn-primary">Chỉnh sửa</a>
					</td>
					<td>
						<form action="{{ route('coupon.destroy', $coupon->id) }}" method="post">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-sm btn-danger">Xóa</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@endsection