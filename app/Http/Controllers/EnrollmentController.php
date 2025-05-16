<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Enrollment;
use App\Models\Batches;
use App\Models\Student;

class EnrollmentController extends Controller
{
    public function index(): View
    {
        $enrollments = Enrollment::with(['batch', 'student'])->get(); // Eager load relations
        return view('enrollments.index', compact('enrollments'));
    }

    public function create(): View
    {
        $batches = Batches::pluck('name', 'id');
        $students = Student::pluck('name', 'id');
        return view('enrollments.create', compact('batches', 'students'));
    }

    public function store(Request $request): RedirectResponse
    {
            $validated = $request->validate([
            'enroll_no' => 'required|string|max:255',
            'batch_id' => 'required|exists:batches,id',
            'student_id' => 'required|exists:students,id', // ✅ Corrected here
            'join_date' => 'required|date',
            'fee' => 'required|numeric',
        ]);

        Enrollment::create($validated);
        return redirect()->route('enrollments.index')->with('flash_message', 'Enrollment Added!');
    }

    public function show(string $id): View
    {
        $enrollments = Enrollment::with(['batch', 'student'])->findOrFail($id);
        return view('enrollments.show', compact('enrollments'));
    }

    public function edit(string $id): View
    {   
       $enrollments = Enrollment::findOrFail($id);
        // Get batches and students as an associative array with id as the key and name as the value
        $batches = Batches::pluck('name', 'id');
        $students = Student::pluck('name', 'id');
        
        return view('enrollments.edit', compact('enrollments', 'batches', 'students'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
       $validated = $request->validate([
        'enroll_no' => 'required|string|max:255',
        'batch_id' => 'required|exists:batches,id',
        'student_id' => 'required|exists:students,id', // Corrected here
        'join_date' => 'required|date',
        'fee' => 'required|numeric',
    ]);

    $enrollments = Enrollment::findOrFail($id);
    $enrollments->update($validated);

    return redirect()->route('enrollments.index')->with('flash_message', 'Enrollment Updated!');
    }

    public function destroy(string $id): RedirectResponse
    {
        Enrollment::destroy($id);
        return redirect()->route('enrollments.index')->with('flash_message', 'Enrollment deleted!');
    }
}
