<?php

namespace App\Http\Controllers;

use App\Models\Batches;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BatchController extends Controller
{
    public function index(): View
    {
        $batches = Batches::with('course')->get();
        return view('batches.index', compact('batches'));
    }

    public function create(): View
    {
        $courses = Courses::all();
        return view('batches.create', compact('courses'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'required|integer',
            'start_date' => 'required|date',
        ]);

        $input = $request->all();
        $input['start_date'] = \Carbon\Carbon::parse($input['start_date'])->format('Y-m-d');
        Batches::create($input);

        return redirect('batches')->with('flash_message', 'Batch added!');
    }

    public function show(string $id): View
    {
        $batches = Batches::find($id);
        return view('batches.show', compact('batches'));
    }

    public function edit(string $id): View
    {
        $batches = Batches::findOrFail($id);
        $courses = Courses::all(); // For dropdown
        return view('batches.edit', compact('batches', 'courses'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'required|integer',
            'start_date' => 'required|date',
        ]);

        $input = $request->all();
        $input['start_date'] = \Carbon\Carbon::parse($input['start_date'])->format('Y-m-d');
        $batch = Batches::findOrFail($id);
        $batch->update($input);

        return redirect('batches')->with('flash_message', 'Batch updated!');
    }

    public function destroy(string $id): RedirectResponse
    {
        Batches::destroy($id);
        return redirect('batches')->with('flash_message', 'Batch deleted!');
    }
}
