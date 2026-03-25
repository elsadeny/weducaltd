<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Student;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_applications' => Application::count(),
            'pending'            => Application::where('status', 'pending')->count(),
            'reviewing'          => Application::where('status', 'reviewing')->count(),
            'approved'           => Application::where('status', 'approved')->count(),
            'rejected'           => Application::where('status', 'rejected')->count(),
            'total_students'     => Student::count(),
        ];

        $recent = Application::with(['student', 'institution', 'destination'])
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent'));
    }
}
