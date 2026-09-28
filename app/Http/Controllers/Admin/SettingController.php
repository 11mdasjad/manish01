<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function index(Request $request): View
    {
        $group = $request->query('group', 'general');
        $settings = Setting::where('group', $group)->get();
        $allGroups = Setting::select('group')->distinct()->pluck('group');

        return view('admin.settings.index', compact('settings', 'group', 'allGroups'));
    }

    public function update(Request $request): RedirectResponse
    {
        $inputs = $request->except(['_token', '_method', 'group']);

        foreach ($inputs as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                $setting->value = $value;
                $setting->save();
                Cache::forget("setting_{$key}");
            } else {
                Setting::create([
                    'key' => $key,
                    'value' => $value,
                    'group' => $request->input('group', 'general'),
                    'label' => ucwords(str_replace('_', ' ', $key)),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Corporate website settings updated successfully.');
    }
}
