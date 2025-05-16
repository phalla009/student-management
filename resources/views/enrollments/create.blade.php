@extends('layout')
@section('content')

<div class="card">
  <div class="card-header">Enrollment Page</div>
  <div class="card-body">
      
    <form action="{{ route('enrollments.store') }}" method="POST">
      @csrf
  
      <label for="enroll_no">Enrollment No</label>
      <input type="text" name="enroll_no" class="form-control">
  
      <label for="batch_id">Batch</label>
      <select name="batch_id" class="form-control">
          <option value="">-- Select Batch --</option>
          @foreach($batches as $id => $name)
              <option value="{{ $id }}">{{ $name }}</option>
          @endforeach
      </select>
  
      <label for="student_id">Student</label>
      <select name="student_id" class="form-control">
          <option value="">-- Select Student --</option>
          @foreach($students as $id => $name)
              <option value="{{ $id }}">{{ $name }}</option>
          @endforeach
      </select>
  
      <label for="join_date">Join Date</label>
      <input type="date" name="join_date" class="form-control">
  
      <label for="fee">Fee</label>
      <input type="number" name="fee" class="form-control">
  
      <button type="submit" class="btn btn-primary mt-3">Submit</button>
  </form>
  
   
  </div>
</div>

@stop
