<?php

namespace App\Http\Controllers\Settings\Rights;

use App\Dealcloser\Interfaces\Repositories\IRoleRepo;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Rights\RoleRequest;
use Spatie\Permission\Models\Role;

class SettingsRoleController extends Controller
{
    /**
     * IUserRepo implementation
     *
     * @var IRoleRepo
     */
    private $roleRepo;

    /**
     * Create a new controller instance. Only users with permission
     * edit-role-settings have access to this controller.
     *
     * @param IRoleRepo $roleRepo
     */
    public function __construct(IRoleRepo $roleRepo)
    {
        $this->middleware('permission:edit-role-settings');
        $this->roleRepo = $roleRepo;
    }

    /**
     * Show role settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.rights.role.show')->with([
                'roles' => $this->roleRepo->getAll()
            ]
        );
    }

    /**
     * Store role.
     *
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleRequest $request)
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
     * @param RoleRequest $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(RoleRequest $request, Role $role)
    {
        $this->roleRepo->update($role->id, ['name' => $request->name]);

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

        $this->roleRepo->delete($role->id);

        return response()->json(['status' => 'Rol verwijderd.']);
    }
}
