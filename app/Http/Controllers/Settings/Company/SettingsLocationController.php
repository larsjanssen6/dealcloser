<?php

namespace App\Http\Controllers\Settings\Company;

use App\Dealcloser\Core\Settings\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\settings\Company\LocationRequest;

class SettingsLocationController extends Controller
{
    /**
     * Create a new controller instance. Only users with permission
     * edit-company-settings have access to this controller.
     */
    public function __construct()
    {
        $this->middleware('permission:edit-company-settings');
    }

    /**
     * Show corporation location settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.company.location.show');
    }

    /**
     * Update corporation location settings.
     *
     * @param LocationRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LocationRequest $request)
    {
        Settings::set($request->only('address', 'zip', 'city'));

        return back()
            ->with('status', 'Bedrijfslocatie geupdatet!');
    }
}
