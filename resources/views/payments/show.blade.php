@extends('layout')
@section('content')

<div class="card">
  <div class="card-header">Payments Page</div>
  <div class="card-body">
    <h5 class="card-title">Enrollment No : {{ $payment->enrollment->enroll_no }}</h5>
    <p class="card-text">Paid Date : {{ $payment->paid_date }}</p>
    <p class="card-text">Amount: ${{ number_format($payment->amount, 2) }}</p>
  </div>
</div>

@endsection
