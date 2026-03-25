<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with(['applications', 'user']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $students = $query->latest()->paginate(15);
        return view('admin.students.index', compact('students'));
    }

    public function show(Student $student)
    {
        $student->load(['applications.institution', 'applications.destination', 'applications.documents']);
        return view('admin.students.show', compact('student'));
    }
}
