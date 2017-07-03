<?php

namespace App\Http\Controllers\Settings\Rights;

use App\Dealcloser\Core\Settings\Category;
use App\Dealcloser\Interfaces\Repositories\IRoleRepo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\Rights\PermissionRequest;

class SettingsPermissionController extends Controller
{
    /**
     * IUserRepo implementation
     *
     * @var IRoleRepo
     */
    private $roleRepo;

    /**
     * Create a new controller instance. Only users with permission
     * edit-permission-settings have access to this controller.
     * @param IRoleRepo $roleRepo
     */
    public function __construct(IRoleRepo $roleRepo)
    {
        $this->middleware('permission:edit-permission-settings');
        $this->roleRepo = $roleRepo;
    }

    /**
     * Show permission settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.rights.permission.show')->with([
                'categories' => Category::all(),
                'roles' => $this->roleRepo->getAll()
            ]
        );
    }

    /**
     * Add or revoke permissions to a role.
     *
     * @param PermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PermissionRequest $request)
    {
        $role = $this->roleRepo->find($request->role);

        if ($role->hasPermissionTo($request->permission)) {
            $role->revokePermissionTo($request->permission);

            return back()->with('status', 'Permissie ingetrokken');
        }

        $role->givePermissionTo($request->permission);

        return back()->with('status', 'Permissie toegevoegd');
    }
}
