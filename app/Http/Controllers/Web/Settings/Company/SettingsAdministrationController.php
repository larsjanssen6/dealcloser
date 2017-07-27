<?php

namespace App\Http\Controllers\Web\Settings\Company;

use App\Http\Controllers\Controller;
use App\Dealcloser\Core\Settings\Settings;
use App\Http\Requests\Settings\Company\AdministrationRequest;

class SettingsAdministrationController extends Controller
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
     * Show corporation administration settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.company.administration.show');
    }

    /**
     * Update corporation administration settings.
     *
     * @param AdministrationRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(AdministrationRequest $request)
    {
        Settings::set($request->only('kvk', 'btw'));

        return back()
            ->with('status', 'Bedrijfsadministratie geupdatet!');
    }
}
