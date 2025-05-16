@extends('layout')
@section('content')
 
 
<div class="card">
  <div class="card-header">Enrollment Page</div>
  <div class="card-body">
   
 
        <div class="card-body">
        <p class="card-text">Enroll No: {{ $enrollments->enroll_no }}</p>
        <p class="card-text">Batch Name: {{ $enrollments->batch->name ?? 'N/A' }}</p> <!-- Safe access to batch name -->
        <p class="card-text">Student Name: {{ $enrollments->student->name ?? 'N/A' }}</p> <!-- Safe access to student name -->
        <p class="card-text">Join Date: {{ $enrollments->join_date }}</p>
        <p class="card-text">Fee: ${{ number_format($enrollments->fee, 2) }}</p>


  </div>
       
    </hr>
  
  </div>
</div>
@endsection