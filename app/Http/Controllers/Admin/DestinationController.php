<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationController extends Controller
{
    public function index()
    {
        $study = Destination::where('category', 'study')->latest()->get();
        $work  = Destination::where('category', 'work')->latest()->get();
        return view('admin.destinations.index', compact('study', 'work'));
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'               => 'required|string|max:255',
            'category'           => 'required|in:study,work',
            'flag_emoji'         => 'nullable|string|max:10',
            'description'        => 'nullable|string',
            'required_documents' => 'nullable|string',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        Destination::create($data);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination created successfully.');
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $data = $request->validate([
            'name'               => 'required|string|max:255',
            'category'           => 'required|in:study,work',
            'flag_emoji'         => 'nullable|string|max:10',
            'description'        => 'nullable|string',
            'required_documents' => 'nullable|string',
            'image'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if stored in our disk
            if ($destination->image && Storage::disk('public')->exists($destination->image)) {
                Storage::disk('public')->delete($destination->image);
            }
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }

        $destination->update($data);

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination updated successfully.');
    }

    public function destroy(Destination $destination)
    {
        if ($destination->image && Storage::disk('public')->exists($destination->image)) {
            Storage::disk('public')->delete($destination->image);
        }
        $destination->delete();

        return redirect()->route('admin.destinations.index')
            ->with('success', 'Destination deleted.');
    }
}
