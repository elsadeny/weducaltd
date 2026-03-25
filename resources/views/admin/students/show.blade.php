<x-admin.layouts.app title="Student Profile">

    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('admin.students.index') }}" class="inline-flex items-center text-sm text-gray-400 hover:text-navy transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Back to students
            </a>
        </div>

        {{-- Student profile card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-4">
            <div class="flex items-center space-x-5">
                <div class="w-16 h-16 rounded-2xl bg-navy flex items-center justify-center text-white font-bold text-2xl shrink-0">
                    {{ strtoupper(substr($student->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-xl font-bold text-navy">{{ $student->name }}</h2>
                    <p class="text-gray-400 text-sm">{{ $student->email }}</p>
                    <p class="text-gray-400 text-xs mt-1">Joined {{ $student->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-6 pt-6 border-t border-gray-100 text-sm">
                <div>
                    <span class="text-gray-400 text-xs uppercase tracking-wider">Phone</span>
                    <div class="font-semibold text-navy mt-1">{{ $student->phone ?? '—' }}</div>
                </div>
                <div>
                    <span class="text-gray-400 text-xs uppercase tracking-wider">Nationality</span>
                    <div class="font-semibold text-navy mt-1">{{ $student->nationality ?? '—' }}</div>
                </div>
                <div>
                    <span class="text-gray-400 text-xs uppercase tracking-wider">Passport</span>
                    <div class="font-semibold text-navy mt-1">{{ $student->passport_number ?? '—' }}</div>
                </div>
            </div>
        </div>

        {{-- Applications --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-navy">Applications <span class="text-gray-400 font-normal text-sm">({{ $student->applications->count() }})</span></h3>
            </div>

            @if($student->applications->isEmpty())
                <div class="text-center py-12 text-gray-400">No applications submitted yet.</div>
            @else
                <div class="divide-y divide-gray-50">
                    @foreach($student->applications as $app)
                        @php
                            $colors = ['pending'=>'amber','reviewing'=>'blue','approved'=>'green','rejected'=>'red','documents_required'=>'orange'];
                            $c = $colors[$app->status] ?? 'gray';
                        @endphp
                        <div class="flex items-center justify-between px-6 py-4">
                            <div>
                                <div class="font-semibold text-navy text-sm">{{ $app->program }}</div>
                                <div class="text-gray-400 text-xs">{{ $app->institution->name ?? '—' }} · {{ $app->destination->name ?? '—' }}</div>
                                <div class="text-gray-400 text-xs">{{ $app->documents->count() }} document(s) · {{ $app->created_at->format('M d, Y') }}</div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-{{ $c }}-100 text-{{ $c }}-700">
                                    {{ $app->status_label }}
                                </span>
                                <a href="{{ route('admin.applications.show', $app) }}"
                                   class="text-teal text-xs font-semibold hover:underline">
                                    Review →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</x-admin.layouts.app>
