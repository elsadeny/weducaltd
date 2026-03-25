<x-student.layouts.app title="My Applications">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-navy">My Applications</h2>
            <p class="text-gray-400 text-sm">Track every application in one place.</p>
        </div>
        <a href="{{ route('student.applications.create') }}" class="btn-primary">+ Apply Now</a>
    </div>

    @if($applications->isEmpty())
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center py-20 text-center px-6">
            <div class="w-16 h-16 bg-teal/10 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <h4 class="text-navy font-bold text-xl mb-2">No applications yet</h4>
            <p class="text-gray-400 mb-6">Submit your first application to get started.</p>
            <a href="{{ route('student.applications.create') }}" class="btn-primary">Apply Now</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($applications as $app)
                @php
                    $colors = ['pending'=>'amber','reviewing'=>'blue','approved'=>'green','rejected'=>'red','documents_required'=>'orange'];
                    $c = $colors[$app->status] ?? 'gray';
                @endphp
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between p-6">
                        <div class="flex items-start space-x-4 mb-4 sm:mb-0">
                            @php $isWork = ($app->application_type ?? 'study') === 'work'; @endphp
                            <div class="w-12 h-12 rounded-xl {{ $isWork ? 'bg-indigo-50' : 'bg-teal/5' }} flex items-center justify-center shrink-0">
                                @if($isWork)
                                    <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-teal" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <div class="flex items-center space-x-2 mb-0.5">
                                    <h4 class="font-bold text-navy">{{ $app->program }}</h4>
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold {{ $isWork ? 'bg-indigo-100 text-indigo-600' : 'bg-teal/10 text-teal' }}">
                                        {{ $isWork ? 'Work' : 'Study' }}
                                    </span>
                                </div>
                                <p class="text-gray-500 text-sm">{{ $app->institution->name ?? '—' }}</p>
                                <p class="text-gray-400 text-xs mt-1">{{ $app->destination->name ?? '—' }} · Submitted {{ $app->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-3 sm:flex-col sm:items-end sm:space-x-0 sm:space-y-2">
                            <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-{{ $c }}-100 text-{{ $c }}-700">
                                {{ $app->status_label }}
                            </span>
                            <div class="flex items-center space-x-2 text-xs text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                </svg>
                                {{ $app->documents->count() }} doc(s)
                            </div>
                            <a href="{{ route('student.applications.show', $app) }}" class="text-teal text-sm font-semibold hover:underline">View details →</a>
                        </div>
                    </div>

                    {{-- Status progress bar --}}
                    @php
                        $steps = ['pending','reviewing','documents_required','approved'];
                        $currentStep = array_search($app->status, $steps) !== false ? array_search($app->status, $steps) : 0;
                        if ($app->status === 'rejected') $currentStep = -1;
                    @endphp
                    @if($app->status !== 'rejected')
                        <div class="px-6 pb-5">
                            <div class="flex items-center space-x-1">
                                @foreach(['Submitted', 'Under Review', 'Docs Checked', 'Approved'] as $i => $stepLabel)
                                    <div class="flex-1">
                                        <div class="h-1.5 rounded-full {{ $i <= $currentStep ? 'bg-teal' : 'bg-gray-100' }}"></div>
                                        <div class="text-xs text-gray-400 mt-1 text-center hidden sm:block">{{ $stepLabel }}</div>
                                    </div>
                                    @if($i < 3) <div class="w-1"></div> @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

</x-student.layouts.app>
