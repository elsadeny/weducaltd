<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user    = Auth::user();
        $student = $user->student;

        $applications = $student
            ? $student->applications()->with(['institution', 'destination', 'documents'])->latest()->get()
            : collect();

        $stats = [
            'total'     => $applications->count(),
            'pending'   => $applications->where('status', 'pending')->count(),
            'reviewing' => $applications->where('status', 'reviewing')->count(),
            'approved'  => $applications->where('status', 'approved')->count(),
            'rejected'  => $applications->where('status', 'rejected')->count(),
        ];

        return view('student.dashboard', compact('user', 'student', 'applications', 'stats'));
    }
}
