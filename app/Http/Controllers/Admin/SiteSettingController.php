<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function edit(): View
    {
        $settings = SiteSetting::first();

        if (!$settings) {
            $settings = SiteSetting::create([
                'business_name' => 'BengkuluKita',
                'footer_text' => 'Pusatnya Oleh-Oleh Bengkulu.',
            ]);
        }

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'business_name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'whatsapp' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'instagram' => [
                'nullable',
                'string',
                'max:255',
            ],

            'facebook' => [
                'nullable',
                'string',
                'max:255',
            ],

            'tiktok' => [
                'nullable',
                'string',
                'max:255',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'opening_hours' => [
                'nullable',
                'string',
                'max:255',
            ],

            'footer_text' => [
                'nullable',
                'string',
                'max:255',
            ],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $settings = SiteSetting::first();

        if (!$settings) {
            $settings = new SiteSetting();
        }

        $settings->business_name = $request->business_name;
        $settings->description = $request->description;
        $settings->phone = $request->phone;
        $settings->whatsapp = $request->whatsapp;
        $settings->email = $request->email;
        $settings->instagram = $request->instagram;
        $settings->facebook = $request->facebook;
        $settings->tiktok = $request->tiktok;
        $settings->address = $request->address;
        $settings->opening_hours = $request->opening_hours;
        $settings->footer_text = $request->footer_text;

        if ($request->hasFile('logo')) {

            if (
                $settings->logo &&
                Storage::disk('public')->exists($settings->logo)
            ) {
                Storage::disk('public')->delete($settings->logo);
            }

            $settings->logo = $request->file('logo')
                ->store('site', 'public');
        }

        $settings->save();

        return redirect()
            ->route('admin.settings.edit')
            ->with('success', 'Informasi website berhasil diperbarui.');
    }
}