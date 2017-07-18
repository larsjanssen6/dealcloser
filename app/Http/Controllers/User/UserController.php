<?php

namespace App\Http\Controllers\User;

use Gate;
use App\Dealcloser\Core\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\User\UserRequest;
use App\Dealcloser\Interfaces\Repositories\IRoleRepo;
use App\Dealcloser\Interfaces\Repositories\IUserRepo;
use App\Dealcloser\Interfaces\Repositories\IDepartmentRepo;

class UserController extends Controller
{
    /**
     * IUserRepo implementation.
     *
     * @var IUserRepo
     */
    private $userRepo;

    /**
     * IDepartment implementation.
     *
     * @var IUserRepo
     */
    private $departmentRepo;

    /**
     * IRoleRepo implementation.
     *
     * @var IUserRepo
     */
    private $roleRepo;

    /**
     * Create a new controller instance. Only users with permission
     * register-users have access to this controller.
     *
     * @param IUserRepo       $userRepo
     * @param IDepartmentRepo $departmentRepo
     * @param IRoleRepo       $roleRepo
     */
    public function __construct(IUserRepo $userRepo, IDepartmentRepo $departmentRepo, IRoleRepo $roleRepo)
    {
        $this->middleware('permission:edit-users')->only('update', 'destroy');
        $this->userRepo = $userRepo;
        $this->departmentRepo = $departmentRepo;
        $this->roleRepo = $roleRepo;
    }

    /**
     * Show all users.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $departments = null; $roles = null;

        if (Gate::allows('edit-users')) {
            $departments = $this->departmentRepo->getAll();
            $roles = $this->roleRepo->getAll();
        }

        return view('user.index')->with([
            'users'       => $this->userRepo->paginate(Paginator::resolveCurrentPage(), ['department', 'roles']),
            'departments' => issetWithReturn($departments),
            'roles'       => issetWithReturn($roles),
        ]);
    }

    /**
     * Update user.
     *
     * @param UserRequest $request
     * @param User        $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $items = collect(['name', 'preposition', 'last_name', 'email', 'function', 'department_id', 'active']);

        if (isset($request->password)) {
            $items = $items->merge('password');
        }

        $user->syncRoles($request->role);
        $this->userRepo->update($user->id, $request->only($items->toArray()));

        return response()->json(['status' => 'Geupdatet']);
    }

    /**
     * Destroy a user.
     *
     * @param User $user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        $this->userRepo->delete($user->id);

        return response()->json(['status' => 'Verwijderd']);
    }
}
