<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function index()
    {
        $profile = CompanyProfile::first();
        return view('admin.company.index', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:20',
            'open_time' => 'nullable|date_format:H:i',
            'close_time' => 'nullable|date_format:H:i',
            'is_open' => 'nullable|boolean',
        ]);

        $profile = CompanyProfile::first();
        $data = $request->only(['name', 'description', 'address', 'phone', 'email', 'instagram', 'whatsapp', 'open_time', 'close_time']);
        $data['is_open'] = $request->has('is_open');

        if ($profile) {
            $profile->update($data);
        } else {
            CompanyProfile::create($data);
        }

        return back()->with('success', 'Informasi usaha berhasil diperbarui');
    }

    public function toggleStatus()
    {
        $profile = CompanyProfile::first();
        
        if ($profile) {
            $profile->update(['is_open' => !$profile->is_open]);
            $status = $profile->is_open ? 'dibuka' : 'ditutup';
            return back()->with('success', "Toko berhasil $status");
        }

        return back()->with('error', 'Profil usaha belum diatur');
    }
}
