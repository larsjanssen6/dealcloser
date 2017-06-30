<?php

namespace App\Http\Controllers\Settings\Rights;

use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\SettingsRoleRequest;
use Spatie\Permission\Models\Role;

class SettingsRoleController extends Controller
{
    /**
     * Create a new controller instance. Only users with permission
     * edit-role-settings have access to this controller.
     */
    public function __construct()
    {
        $this->middleware('permission:edit-role-settings');
    }

    /**
     * Show role settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.rights.role.show')->with([
                'roles' => Role::all()
            ]
        );
    }

    /**
     * Store role.
     *
     * @param SettingsRoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SettingsRoleRequest $request)
    {
        $this->validate(request(), ['name' => 'unique:roles']);

        Role::create(['name' => ucfirst($request->name)]);

        return back()->with([
            'status' => 'Role aangemaakt'
        ]);
    }

    /**
     * Update role
     *
     * @param SettingsRoleRequest $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SettingsRoleRequest $request, Role $role)
    {
        $role->name = ucfirst($request->name);
        $role->save();

        return response()->json(['status' => 'Rol geupdatet.']);
    }

    /**
     * Destroy role
     *
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role)
    {
        if (Auth::user()->hasRole($role->name)) {
            return response()->json([
                'status' => 'U kunt deze rol niet verwijder. Koppel uzelf eerst aan een andere rol.'
            ], 401);
        }

        $role->delete();

        return response()->json(['status' => 'Rol verwijderd.']);
    }
}
