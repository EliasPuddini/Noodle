<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    
    public function index()
    {
        $courses = Course::all();

        return Inertia::render('courses/index', [
            'courses' => $courses
        ]);

    }

    public function create()
    {
        return Inertia::render('courses/create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        Course::create($validated);

        return redirect()->route('courses.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $course = Course::findOrFail($id);

        return Inertia::render('courses/show', [
            'course' => $course
        ]);
    }
    
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
        ]);

        $course = Course::findOrFail($id);
        $course->update($validated);

        return redirect()->route('courses.index');
    }
    
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index');
    }
}
