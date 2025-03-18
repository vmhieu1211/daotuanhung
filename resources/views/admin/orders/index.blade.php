@extends('layouts.app')

@section('content')
    <!-- breadcrumb -->
    <nav area-label="breadcrumb">

        <ol class="breadcrumb">
            <a href="{{ route('home') }}" class="text-decoration-none mr-3">
                <li class="breadcrumb-item">Trang chủ</li>
            </a>
            <li class="breadcrumb-item active">Đơn hàng</li>
        </ol>

    </nav>

    <div class="card">
        <div class="card-header">Đơn hàng</div>

        <div class="card-body">

            <table class="table table-bordered table-hover table-dark table-responsive">
                <thead>
                    <th>Tên</th>
                    <th>Điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Thành phố</th>
                    <th>Tổng tiền</th>
                    <th>Phương thức thanh toán</th>
                    <th>Trạng thái</th>
                    <th>Ngày tháng</th>
                    <th>Kiểm tra</th>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->billing_fullname }}</td>
                            <td>{{ $order->billing_phone }}</td>
                            <td>{{ $order->billing_address }}</td>
                            <td>{{ $order->billing_city }}</td>
                            <td> {{ $order->billing_total }}đ</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ $order->status->name }}</td>
                            <td>{{ $order->formatted_created_at }}</td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-success btn-sm">Xem Đơn
                                    Hàng</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </div>
@endsection
