@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Add Coupon</div>
        <div class="card-body">
            <form action="{{ route('coupon.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="type">Coupon Type</label>
                    <select name="type" class="custom-select">
                        <option value="percent">Percent Off</option>
                        <option value="fixed">Fixed Amount</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="code">Coupon Code</label>
                    <input type="text" name="code" placeholder="Add Coupon" class="form-control">
                </div>

                <div class="form-group">
                    <label for="value">Coupon Value</label>
                    <input type="text" name="value" placeholder="Add Value" class="form-control">
                </div>
                @if (old('type') == 'fixed')
                    <div class="form-group">
                        <label for="value">Coupon Value</label>
                        <input type="text" name="value" class="form-control" value="{{ old('value') }}"
                            placeholder="Add Fixed Value">
                    </div>
                @elseif (old('type') == 'percent')
                    <div class="form-group">
                        <label for="percent_off">Percent Off</label>
                        <input type="text" name="percent_off" class="form-control" value="{{ old('percent_off') }}"
                            placeholder="Add Percentage">
                    </div>
                @endif


                @if (old('type') == 'percent')
                    <div class="form-group">
                        <label for="percent_off">Percent Off</label>
                        <input type="text" name="percent_off" value="{{ old('percent_off') }}"
                            placeholder="Add Percentage" class="form-control">
                    </div>
                @endif

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add Coupon</button>
                </div>
            </form>
        </div>
    </div>
@endsection
