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
        $group = $request->input('group', 'general');
        $inputs = $request->except(['_token', '_method', 'group']);

        foreach ($inputs as $key => $value) {
            if (str_ends_with($key, '_file')) {
                continue;
            }

            // If a file is uploaded for this setting key, skip updating with text value
            if ($request->hasFile("{$key}_file")) {
                continue;
            }

            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                $setting->value = $value;
                $setting->save();
                Cache::forget("setting_{$key}");
            } else {
                Setting::create([
                    'key' => $key,
                    'value' => $value,
                    'group' => $group,
                    'label' => ucwords(str_replace('_', ' ', $key)),
                ]);
                Cache::forget("setting_{$key}");
            }
        }

        // Also handle any file uploads in settings
        foreach ($request->allFiles() as $fileKey => $file) {
            $actualKey = preg_replace('/_file$/', '', $fileKey);
            $path = $file->store('settings', 'public');
            $setting = Setting::where('key', $actualKey)->first();
            if ($setting) {
                $setting->value = $path;
                $setting->save();
            } else {
                Setting::create([
                    'key' => $actualKey,
                    'value' => $path,
                    'group' => $group,
                    'label' => ucwords(str_replace('_', ' ', $actualKey)),
                ]);
            }
            Cache::forget("setting_{$actualKey}");
        }

        return redirect()->route('admin.settings.index', ['group' => $group])
            ->with('success', ucfirst($group).' settings updated successfully and changes are live.');
    }
}
