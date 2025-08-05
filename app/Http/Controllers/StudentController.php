<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
    public function index()
    {
        $students = Student::orderBy('created_at', 'desc')->get();
        
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'passport_number' => 'required|string|max:20|unique:students',
            'email' => 'required|email|unique:students',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'gpa' => 'required|numeric|min:0|max:4',
            'ielts_score' => 'nullable|numeric|min:0|max:9',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student added successfully!');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'passport_number' => 'required|string|max:20|unique:students,passport_number,' . $student->id,
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'gpa' => 'required|numeric|min:0|max:4',
            'ielts_score' => 'nullable|numeric|min:0|max:9',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully!');
    }
}
