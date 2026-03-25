<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::with('institution.destination')->orderBy('name')->paginate(20);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        $institutions = Institution::with('destination')->orderBy('name')->get();
        return view('admin.programs.create', compact('institutions'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'duration'       => 'nullable|string|max:100',
            'fees'           => 'nullable|string|max:100',
            'level'          => 'nullable|string|max:100',
            'category'       => 'required|in:study,work',
            'is_active'      => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);

        Program::create($data);
        return redirect()->route('admin.programs.index')->with('success', 'Program created.');
    }

    public function edit(Program $program)
    {
        $institutions = Institution::with('destination')->orderBy('name')->get();
        return view('admin.programs.edit', compact('program', 'institutions'));
    }

    public function update(Request $request, Program $program)
    {
        $data = $request->validate([
            'institution_id' => 'required|exists:institutions,id',
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'duration'       => 'nullable|string|max:100',
            'fees'           => 'nullable|string|max:100',
            'level'          => 'nullable|string|max:100',
            'category'       => 'required|in:study,work',
            'is_active'      => 'boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active', true);

        $program->update($data);
        return redirect()->route('admin.programs.index')->with('success', 'Program updated.');
    }

    public function destroy(Program $program)
    {
        $program->delete();
        return back()->with('success', 'Program deleted.');
    }
}
