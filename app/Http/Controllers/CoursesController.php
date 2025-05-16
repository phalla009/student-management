<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;          
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Courses;
use Illuminate\View\View;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $courses = Courses::all(); // Get all courses from the database
        return view('courses.index', compact('courses')); // Pass courses to the view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view(view: 'courses.create'); // Return the create Courses view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'syllabus' => 'required|string|max:255',
            'duration' => 'required|string|max:15',
        ]);

        Courses::create($validated); // Create the Courses

        return redirect()->route('courses.index')->with('flash_message', 'Courses Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $Courses = Courses::find($id);
        return view('courses.show')->with('courses', $Courses);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $Courses = Courses::find($id);
        return view('courses.edit')->with('courses', $Courses);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $Courses = Courses::find($id);
        $input = $request->all();
        $Courses->update($input);
        return redirect('courses')->with('flash_message', 'Courses Updated!');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Courses::destroy($id);
        return redirect(to: 'courses')->with('flash_message', 'Courses deleted!'); 
    }
}
