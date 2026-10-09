<?php

namespace App\Http\Controllers;

use App\Models\Student;
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
    

    public function show(string $id)
    {
        $courses = Course::findOrFail($id);
        $students = Student::where('id', $id)->get();

        return Inertia::render('courses/show', [
            'course' => Course::findOrFail($id),
            'students' => $students,
        ]);
    }

    public function edit(string $id)
    {
        $course = Course::findOrFail($id);

        return Inertia::render('courses/edit', [
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

    public function addStudent(Request $request, string $id)
    {
        $validated = $request->validate([
            'code' => 'required|exists:students,code',
        ]);

        $course = Course::findOrFail($id);
        $student = Student::where('code', $validated['code'])->first();
        $course->students()->attach($student->id);

        return redirect()->route('courses.show', $id);
    }
}
