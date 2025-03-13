@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Update Coupon</div>
        <div class="card-body">
            <form action="{{ route('coupon.update', $coupon->id) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="type">Coupon Type</label>
                    <select name="type" class="custom-select">
                        <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percent Off</option>
                        <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="code">Coupon Code</label>
                    <input type="text" name="code" class="form-control" value="{{ $coupon->code }}">
                </div>

                <div class="form-group">
                    <label for="value">Coupon Value</label>
                    <input type="text" name="value" class="form-control" value="{{ $coupon->value }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Coupon</button>
                </div>
            </form>
        </div>
    </div>
@endsection
