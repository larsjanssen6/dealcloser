<?php

namespace App\Http\Controllers\Settings\Rights;

use App\Dealcloser\Core\Settings\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsPermissionRequest;
use Spatie\Permission\Models\Role;

class SettingsPermissionController extends Controller
{
    /**
     * Create a new controller instance. Only users with permission
     * edit-permission-settings have access to this controller.
     */
    public function __construct()
    {
        $this->middleware('permission:edit-permission-settings');
    }

    /**
     * Show permission settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.rights.permission.show')->with([
                'categories'    => Category::all(),
                'roles'         => Role::all()
            ]
        );
    }

    /**
     * Add or remove permissions to a role.
     *
     * @param SettingsPermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SettingsPermissionRequest $request)
    {
        $role = Role::findOrFail($request->role);

        if($role->hasPermissionTo($request->permission)) {
            $role->revokePermissionTo($request->permission);

            return back()->with('status', 'Permissie ingetrokken');
        }

        $role->givePermissionTo($request->permission);

        return back()->with('status', 'Permissie toegevoegd');
    }
}
