@extends('layout')
@section('content')

<div class="card">
    <div class="card-header">Edit Payment</div>
    <div class="card-body">

        <form method="POST" action="{{ route('payments.update', $payment->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="enrollment_id">Enrollment No</label>
                <select name="enrollment_id" id="enrollment_id" class="form-control">
                    @foreach ($enrollments as $enrollment)
                        <option value="{{ $enrollment->id }}" 
                            {{ $payment->enrollment_id == $enrollment->id ? 'selected' : '' }}>
                            {{ $enrollment->enroll_no }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="paid_date">Paid Date</label>
                <input type="date" name="paid_date" id="paid_date" class="form-control"
                    value="{{ old('paid_date', $payment->paid_date) }}">
            </div>

            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" name="amount" id="amount" class="form-control"
                    value="{{ old('amount', $payment->amount) }}">
            </div>

            <br>
            <input type="submit" value="Update" class="btn btn-success">
        </form>

    </div>
</div>

@stop
