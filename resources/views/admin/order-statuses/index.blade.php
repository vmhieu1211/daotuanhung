@extends('layouts.app')

@section('content')
    <!-- breadcrumb -->
    <nav area-label="breadcrumb">

        <ol class="breadcrumb">
            <a href="{{ route('home') }}" class="text-decoration-none mr-3">
                <li class="breadcrumb-item">Home</li>
            </a>
            <li class="breadcrumb-item active">Order Statuses</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header d-flex justify-content-between btn-sm">
            <span>Order Status</span>
            <a href="{{ route('order-statuses.create') }}" class="btn btn-dark">Tạo trạng thái đơn hàng</a>
        </div>
        <div class="card-body">
            <table class="table table-dark table-bordered">
                <thead>
                    <th>Tên</th>
                    <th>Identify Name</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </thead>
                <tbody>
                    @foreach ($orderStatuses as $status)
                        <tr class="text-capitalize">
                            <td> {{ $status->name }} </td>
                            <td> {{ $status->identify_name }} </td>

                            <td>
                                <a href="{{ route('order-statuses.edit', $status->id) }}"
                                    class="btn btn-sm btn-primary">Chỉnh
                                    sửa</a>
                            </td>
                            <td>
                                <form action="{{ route('order-statuses.destroy', $status->id) }}" method="post">
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
