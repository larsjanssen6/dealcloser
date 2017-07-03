<?php

namespace App\Http\Controllers\Settings\Usage;

use App\Dealcloser\Core\Settings\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Usage\UsageRequest;

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
     * Update corporation usage settings.
     *
     * @param UsageRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(UsageRequest $request)
    {
        Settings::set($request->only('users', 'active', 'license'));

        return back()
            ->with('status', 'Bedrijfsgebruik geupdatet!');
    }
}
