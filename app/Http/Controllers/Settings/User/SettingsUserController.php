<?php

namespace App\Http\Controllers\Settings\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsUsageRequest;

class SettingsUserController extends Controller
{
    /**
     * Show user settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.user.show');
    }

    public function update(SettingsUsageRequest $request)
    {
//        Settings::set($request->only('users', 'domain', 'active', 'license'));
//
//        return back()
//            ->with('status', 'Bedrijfsgebruik geupdatet!');
    }
}
