<?php

namespace App\Http\Controllers\Web\Settings\Rights;

use App\Http\Controllers\Controller;
use App\Dealcloser\Interfaces\Repositories\IRoleRepo;
use App\Http\Requests\Settings\Rights\PermissionRequest;
use App\Dealcloser\Interfaces\Repositories\ICategoryRepo;

class SettingsPermissionController extends Controller
{
    /**
     * IUserRepo implementation.
     *
     * @var IRoleRepo
     */
    private $roleRepo;

    /**
     * ICategory implementation.
     *
     * @var ICategoryRepo
     */
    private $categoryRepo;

    /**
     * Create a new controller instance. Only users with permission
     * edit-permission-settings have access to this controller.
     *
     * @param IRoleRepo     $roleRepo
     * @param ICategoryRepo $categoryRepo
     */
    public function __construct(IRoleRepo $roleRepo, ICategoryRepo $categoryRepo)
    {
        $this->middleware('permission:edit-permission-settings');
        $this->roleRepo = $roleRepo;
        $this->categoryRepo = $categoryRepo;
    }

    /**
     * Show permission settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.rights.permission.show')->with([
                'categories' => $this->categoryRepo->findAll('type', 'permission_category', 'permissions'),
                'roles'      => $this->roleRepo->getAll(),
            ]
        );
    }

    /**
     * Add or revoke permissions to a role.
     *
     * @param PermissionRequest $request
     *
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
