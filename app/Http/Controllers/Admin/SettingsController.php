<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name'          => 'nullable|string|max:100',
            'contact_email'      => 'nullable|email|max:255',
            'contact_phone'      => 'nullable|string|max:30',
            'contact_address'    => 'nullable|string|max:500',
            'facebook_url'       => 'nullable|url|max:255',
            'instagram_url'      => 'nullable|url|max:255',
            'whatsapp_number'    => 'nullable|string|max:30',
            'smtp_host'          => 'nullable|string|max:255',
            'smtp_port'          => 'nullable|integer',
            'smtp_encryption'    => 'nullable|in:tls,ssl,',
            'smtp_username'      => 'nullable|string|max:255',
            'smtp_password'      => 'nullable|string|max:255',
            'mail_from_address'  => 'nullable|email|max:255',
            'mail_from_name'     => 'nullable|string|max:100',
            'logo'               => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $old = Setting::get('logo_path');
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }
            $path = $request->file('logo')->store('settings', 'public');
            Setting::set('logo_path', $path);
        }

        $textFields = [
            'site_name', 'contact_email', 'contact_phone', 'contact_address',
            'facebook_url', 'instagram_url', 'whatsapp_number',
            'smtp_host', 'smtp_port', 'smtp_encryption',
            'smtp_username', 'smtp_password',
            'mail_from_address', 'mail_from_name',
        ];

        foreach ($textFields as $field) {
            if ($request->filled($field)) {
                Setting::set($field, $request->input($field));
            }
        }

        return back()->with('success', 'Settings saved successfully.');
    }
}
