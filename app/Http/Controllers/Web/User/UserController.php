<?php

namespace App\Http\Controllers\Web\User;

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
     * @var IDepartmentRepo
     */
    private $departmentRepo;

    /**
     * IRoleRepo implementation.
     *
     * @var IRoleRepo
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
        return view('user.index')->with([
            'users'       => $this->userRepo->paginate(Paginator::resolveCurrentPage()),
        ]);
    }

    /**
     * Show a user.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->userRepo->find($id, [
            'roles',
            'department',
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
