<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () { 
    $studyDestinations = \App\Models\Destination::where('category', 'study')->get();
    $workDestinations = \App\Models\Destination::where('category', 'work')->get();
    $team = \App\Models\TeamMember::all();
    return view('home', compact('studyDestinations', 'workDestinations', 'team')); 
})->name('home');

Route::post('/contact', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'message' => 'required|string',
    ]);
    
    \App\Models\Inquiry::create($validated);
    
    return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
})->name('contact.submit');

Route::get('/privacy-policy', function () {
    return view('privacy');
})->name('privacy');
