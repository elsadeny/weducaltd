<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstitutionController extends Controller
{
    public function index()
    {
        $institutions = Institution::with('destination')->orderBy('name')->paginate(20);
        return view('admin.institutions.index', compact('institutions'));
    }

    public function create()
    {
        $destinations = Destination::orderBy('name')->get();
        return view('admin.institutions.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'destination_id' => 'nullable|exists:destinations,id',
            'country'        => 'nullable|string|max:100',
            'website'        => 'nullable|url|max:255',
            'accreditation'  => 'boolean',
            'logo'           => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('institutions', 'public');
        }
        $data['accreditation'] = $request->boolean('accreditation', true);

        Institution::create($data);
        return redirect()->route('admin.institutions.index')->with('success', 'Institution created.');
    }

    public function edit(Institution $institution)
    {
        $destinations = Destination::orderBy('name')->get();
        return view('admin.institutions.edit', compact('institution', 'destinations'));
    }

    public function update(Request $request, Institution $institution)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'destination_id' => 'nullable|exists:destinations,id',
            'country'        => 'nullable|string|max:100',
            'website'        => 'nullable|url|max:255',
            'accreditation'  => 'boolean',
            'logo'           => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            if ($institution->logo) Storage::disk('public')->delete($institution->logo);
            $data['logo'] = $request->file('logo')->store('institutions', 'public');
        }
        $data['accreditation'] = $request->boolean('accreditation', true);

        $institution->update($data);
        return redirect()->route('admin.institutions.index')->with('success', 'Institution updated.');
    }

    public function destroy(Institution $institution)
    {
        if ($institution->logo) Storage::disk('public')->delete($institution->logo);
        $institution->delete();
        return back()->with('success', 'Institution deleted.');
    }
}
