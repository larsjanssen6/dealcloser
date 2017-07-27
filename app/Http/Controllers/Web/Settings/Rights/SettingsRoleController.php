<?php

namespace App\Http\Controllers\Web\Settings\Rights;

use Auth;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Dealcloser\Interfaces\Repositories\IRoleRepo;

class SettingsRoleController extends Controller
{
    /**
     * IUserRepo implementation.
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
                'roles' => $this->roleRepo->getAll(),
            ]
        );
    }

    /**
     * Store role.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'max:15|required|unique:roles']);

        $this->roleRepo->create($request->only('name'));

        return back()->with([
            'status' => 'Role aangemaakt',
        ]);
    }

    /**
     * Update role.
     *
     * @param Request $request
     * @param Role    $role
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request, ['name' => 'max:15|required|unique:roles,name,'.$role->name.',name']);

        $this->roleRepo->update($role->id, $request->only('name'));

        return response()->json(['status' => 'Rol geupdatet.']);
    }

    /**
     * Destroy role.
     *
     * @param Role $role
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Role $role)
    {
        if (Auth::user()->hasRole($role->name)) {
            return response()->json([
                'status' => 'U kunt deze rol niet verwijder. Koppel uzelf eerst aan een andere rol.',
            ], 401);
        }

        $this->roleRepo->delete($role->id);

        return response()->json(['status' => 'Rol verwijderd.']);
    }
}
