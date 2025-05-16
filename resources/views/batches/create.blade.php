@extends('layout')
@section('content')

<div class="card">
  <div class="card-header">Batches Page</div>
  <div class="card-body">

    {{-- Flash Message --}}
    @if (session('flash_message'))
      <div class="alert alert-success">
        {{ session('flash_message') }}
      </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ url('batches') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="name">Batch Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
      </div>

      <div class="mb-3">
        <label for="course_id">Course</label>
        <select name="course_id" id="course_id" class="form-control" required>
          <option value="">Select Course</option>
          @foreach($courses as $course)
            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
              {{ $course->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="start_date">Start Date</label>
        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" required>
      </div>

      <button type="submit" class="btn btn-success">Save</button>
    </form>

  </div>
</div>

@stop
