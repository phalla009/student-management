@extends('layout')
@section('content')

<div class="card">
  <div class="card-header">Edit Enrollment</div>
  <div class="card-body">

      <form action="{{ url('enrollments/' .$enrollments->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        
        <input type="hidden" name="id" value="{{$enrollments->id}}" />
        
        <div class="form-group">
          <label for="enroll_no">Enroll No</label>
          <input type="text" name="enroll_no" id="enroll_no" value="{{$enrollments->enroll_no}}" class="form-control" />
        </div>
        
        <div class="form-group">
          <label for="batch_id">Batch Name</label>
          <select name="batch_id" id="batch_id" class="form-control">
            <option value="">Select a Batch</option>
            @foreach($batches as $batchId => $batchName)
              <option value="{{ $batchId }}" 
                {{ $batchId == $enrollments->batch_id ? 'selected' : '' }}>
                {{ $batchName }}
              </option>
            @endforeach
          </select>
        </div>
        
        <div class="form-group">
          <label for="student_id">Student Name</label>
          <select name="student_id" id="student_id" class="form-control">
            <option value="">Select a Student</option>
            @foreach($students as $studentId => $studentName)
              <option value="{{ $studentId }}" 
                {{ $studentId == $enrollments->student_id ? 'selected' : '' }}>
                {{ $studentName }}
              </option>
            @endforeach
          </select>
        </div>
        
        <div class="form-group">
          <label for="join_date">Join Date</label>
          <input type="date" name="join_date" id="join_date" value="{{$enrollments->join_date}}" class="form-control" />
        </div>
        
        <div class="form-group">
          <label for="fee">Fee</label>
          <input type="text" name="fee" id="fee" value="{{$enrollments->fee}}" class="form-control" />
        </div>
        
        <button type="submit" class="btn btn-success">Update Enrollment</button>
        
      </form>

  </div>
</div>

@stop
