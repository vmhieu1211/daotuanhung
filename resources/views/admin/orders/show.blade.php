@extends('layouts.app')

@section('content')
    <!-- breadcrumb -->
    <nav area-label="breadcrumb">

        <ol class="breadcrumb">
            <a href="{{ route('home') }}" class="text-decoration-none mr-3">
                <li class="breadcrumb-item">Trang chủ</li>
            </a>
            <li class="breadcrumb-item active">{{ $order->billing_fullname }}'s Order</li>
        </ol>

        <div class="card">
            <div class="card-header">{{ $order->order_number }} <strong class="ml-5">Tổng tiền:
                    {{ $order->billing_total }}đ </strong></div>
            <div class="card-body">
                <h4>Sản phẩm đã đặt hàng</h4>
                <table class="table table-bordered table-responsive table-dark">
                    <thead>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Số lượng</th>
                    </thead>
                    <tbody>
                        @foreach ($products as $p)
                            <tr>
                                <td>{{ $p->code }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->price }}đ</td>
                                <td>{{ $p->pivot->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <h4>Thông tin khách hàng</h4>
                <table class="table table-bordered table-responsive table-success">
                    <thead>
                        <th>Tên Khách Hàng</th>
                        <th>Điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Thành phố</th>
                        <th>Ghi chú</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $order->billing_fullname }}</td>
                            <td>{{ $order->billing_phone }}</td>
                            <td>{{ $order->billing_address }}</td>
                            <td>{{ $order->billing_city }}</td>
                            <td>{{ $order->notes }}</td>
                        </tr>
                    </tbody>
                </table>
                <h4>Trạng thái đơn hàng <strong class="text-capitalize text-danger">{{ $order->status->name }}</strong>
                </h4>

                <form action="{{ route('orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="status">Cập nhật trạng thái đơn hàng</label>
                        <select name="order_status_id" id="status" class="form-control">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}"
                                    {{ $order->order_status_id == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger">Cập nhật trạng thái</button>
                    </div>
                </form>
            </div>
        </div>

    </nav>
@endsection
