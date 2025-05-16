@extends('layout')
@section('content')
 
<div class="card">
  <div class="card-header">Payments Page</div>
  <div class="card-body">
      
    <form action="{{ url('payments') }}" method="post">
      {!! csrf_field() !!}
  
      <label for="enrollment_id">Enrollment No:</label><br>
      <select name="enrollment_id" id="enrollment_id" class="form-control">
        <option value=""> Select Enrollment </option>
        @foreach ($enrollments as $id)
            <option value="{{ $id->id }}">{{ $id->enroll_no }}</option>
        @endforeach
      </select>
    
      <label for="paid_date">Paid Date:</label><br>
      <input type="date" name="paid_date" id="paid_date" class="form-control"><br>
  
      <label for="amount">Amount:</label><br>
      <input type="text" name="amount" id="amount" class="form-control"><br>
  
      <input type="submit" value="Save" class="btn btn-success"><br>
  </form>
  
   
  </div>
</div>
 
@stop