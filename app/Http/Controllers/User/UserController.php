<?php

namespace App\Http\Controllers\User;

use App\Dealcloser\Core\User\User;
use App\Dealcloser\Interfaces\Repositories\IDepartmentRepo;
use App\Dealcloser\Interfaces\Repositories\IRoleRepo;
use App\Dealcloser\Interfaces\Repositories\IUserRepo;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    /**
     * IUserRepo implementation
     *
     * @var IUserRepo
     */
    private $userRepo;

    /**
     * IDepartment implementation
     *
     * @var IUserRepo
     */
    private $departmentRepo;

    /**
     * IRoleRepo implementation
     *
     * @var IUserRepo
     */
    private $roleRepo;

    /**
     * Create a new controller instance. Only users with permission
     * register-users have access to this controller.
     *
     * @param IUserRepo $userRepo
     * @param IDepartmentRepo $departmentRepo
     * @param IRoleRepo $roleRepo
     */
    public function __construct(IUserRepo $userRepo, IDepartmentRepo $departmentRepo, IRoleRepo $roleRepo)
    {
        $this->middleware('permission:edit-users')->only('update');
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
        return view('user.users')->with([
            'users' => $this->userRepo->paginate(Paginator::resolveCurrentPage(), ['department', 'roles']),
            'departments' => $this->departmentRepo->getAll(),
            'roles' => $this->roleRepo->getAll()
        ]);
    }

    /**
     * Update user
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $items = collect(['name', 'last_name', 'email', 'function', 'department_id', 'active']);

        if (isset($request->password)) {
            $items = $items->merge('password');
        }

        $user->syncRoles($request->role);
        $this->userRepo->update($user->id, $request->only($items->toArray()));

        return response()->json(['status' => 'Geupdatet']);
    }
}
