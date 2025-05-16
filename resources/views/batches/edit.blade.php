@extends('layout')
@section('content')

<div class="card">
  <div class="card-header">Edit Page</div>
  <div class="card-body">
      
      <form action="{{ url('batches/' .$batches->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        
        <input type="hidden" name="id" value="{{$batches->id}}" />
        
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" value="{{$batches->name}}" class="form-control" />
        </div>
        
        <div class="form-group">
          <label for="course_name">Course Name</label>
          <!-- Create a dropdown to select a course -->
          <select name="course_id" id="course_id" class="form-control">
            <option value="">Select a Course</option>
            @foreach($courses as $course)
              <option value="{{ $course->id }}" 
                {{ $batches->course_id == $course->id ? 'selected' : '' }}>
                {{ $course->name }}
              </option>
            @endforeach
          </select>
        </div>
        
        <div class="form-group">
          <label for="start_date">Start Date</label>
          <input type="date" name="start_date" id="start_date" value="{{$batches->start_date}}" class="form-control" />
        </div>
        
        <button type="submit" class="btn btn-success">Update</button>
        
      </form>
   
  </div>
</div>

@stop
