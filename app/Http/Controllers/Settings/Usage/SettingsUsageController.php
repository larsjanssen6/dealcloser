<?php

namespace App\Http\Controllers\Settings\Usage;

use App\Dealcloser\Core\Settings\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsUsageRequest;

class SettingsUsageController extends Controller
{
    /**
     * Create a new controller instance. Only users with permission
     * edit-usage-settings have access to this controller.
     */
    public function __construct()
    {
        $this->middleware('permission:edit-usage-settings');
    }

    /**
     * Show corporation usage settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.usage.show');
    }

    /**
     * Update corporation profile settings.
     *
     * @param SettingsUsageRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(SettingsUsageRequest $request)
    {
        Settings::set($request->only('users', 'active', 'license'));

        return back()
            ->with('status', 'Bedrijfsgebruik geupdatet!');
    }
}
