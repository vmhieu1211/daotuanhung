@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">Edit Order Status</div>
            <div class="card-body">
                <form action="{{ route('order-statuses.update', $orderStatus->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $orderStatus->name }}">
                    </div>
                    <div class="form-group">
                        <label for="identify_name">Identify Name</label>
                        <input type="text" name="identify_name" id="identify_name" class="form-control"
                            value="{{ $orderStatus->identify_name }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
