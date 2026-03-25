<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Student\ApplicationController as StudentApplication;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\ApplicationController as AdminApplication;
use App\Http\Controllers\Admin\StudentController as AdminStudent;
use App\Http\Controllers\Admin\DestinationController as AdminDestination;
use App\Http\Controllers\Admin\SettingsController as AdminSettings;
use App\Http\Controllers\Admin\InstitutionController as AdminInstitution;
use App\Http\Controllers\Admin\ProgramController as AdminProgram;

// ─── Public routes ───────────────────────────────────────────────────────────
Route::get('/', function () {
    $studyDestinations = \App\Models\Destination::where('category', 'study')->get();
    $workDestinations  = \App\Models\Destination::where('category', 'work')->get();
    $team              = \App\Models\TeamMember::all();
    $programs          = \App\Models\Program::with('institution.destination', 'destination')
        ->where('is_active', true)
        ->get();

    if ($programs->count() < 15) {
        $needed = 15 - $programs->count();
        $mockPrograms = collect(range(1, $needed))->map(function ($i) {
            $isWork = $i % 2 === 0;
            $countries = [
                ['name' => 'Canada',    'flag' => '🇨🇦'],
                ['name' => 'UK',        'flag' => '🇬🇧'],
                ['name' => 'Germany',   'flag' => '🇩🇪'],
                ['name' => 'Australia', 'flag' => '🇦🇺'],
                ['name' => 'USA',       'flag' => '🇺🇸'],
            ];
            $c = $countries[($i - 1) % 5];
            $destObj = (object) ['name' => $c['name'], 'flag_emoji' => $c['flag']];

            if ($isWork) {
                return (object) [
                    'name'        => "International Skilled Worker Track {$i}",
                    'category'    => 'work',
                    'level'       => 'Full-Time',
                    'fees'        => '$' . number_format(2500 + ($i * 200)) . '/month',
                    'criteria'    => "Valid passport\nAge 18–40\nNo criminal record\nBasic English proficiency\nHealth clearance certificate",
                    'destination' => $destObj,
                    'institution' => null,
                ];
            } else {
                return (object) [
                    'name'        => "Global Study Pathway {$i}",
                    'category'    => 'study',
                    'level'       => ['Diploma', 'Bachelor', 'Master'][($i - 1) % 3],
                    'fees'        => '$' . number_format(6500 + ($i * 350)) . '/year',
                    'criteria'    => null,
                    'destination' => null,
                    'institution' => (object) [
                        'name'        => "Weduca Partner Institute {$i}",
                        'destination' => $destObj,
                    ],
                ];
            }
        });

        $programs = $programs->concat($mockPrograms);
    }

    return view('home', compact('studyDestinations', 'workDestinations', 'team', 'programs'));
})->name('home');

Route::get('/destinations', function () {
    $studyDestinations = \App\Models\Destination::where('category', 'study')->get();
    $workDestinations  = \App\Models\Destination::where('category', 'work')->get();
    return view('destinations', compact('studyDestinations', 'workDestinations'));
})->name('destinations');

Route::post('/contact', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'phone'   => 'nullable|string|max:20',
        'message' => 'required|string',
    ]);
    \App\Models\Inquiry::create($validated);
    return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
})->name('contact.submit');

Route::get('/privacy-policy', function () { return view('privacy'); })->name('privacy');

// ─── Auth routes ─────────────────────────────────────────────────────────────
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// ─── Student Portal ──────────────────────────────────────────────────────────
Route::prefix('portal')->name('student.')->middleware(['auth', 'student'])->group(function () {
    Route::get('/',                                               [StudentDashboard::class,   'index'])->name('dashboard');
    Route::get('/applications',                                   [StudentApplication::class, 'index'])->name('applications.index');
    Route::get('/applications/apply',                             [StudentApplication::class, 'create'])->name('applications.create');
    Route::post('/applications',                                  [StudentApplication::class, 'store'])->name('applications.store');
    Route::get('/applications/{application}',                     [StudentApplication::class, 'show'])->name('applications.show');
    Route::post('/applications/{application}/upload-document',    [StudentApplication::class, 'uploadDocument'])->name('applications.upload');
});

// ─── Admin Portal ─────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/',                                      [AdminDashboard::class,   'index'])->name('dashboard');
    Route::get('/applications',                          [AdminApplication::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}',            [AdminApplication::class, 'show'])->name('applications.show');
    Route::patch('/applications/{application}/status',   [AdminApplication::class, 'updateStatus'])->name('applications.update-status');
    Route::get('/students',                              [AdminStudent::class,      'index'])->name('students.index');
    Route::get('/students/{student}',                    [AdminStudent::class,      'show'])->name('students.show');
    Route::resource('/destinations',  AdminDestination::class)->except(['show']);
    Route::resource('/institutions',  AdminInstitution::class)->except(['show']);
    Route::resource('/programs',      AdminProgram::class)->except(['show']);
    Route::get('/settings',  [AdminSettings::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettings::class, 'update'])->name('settings.update');
});

