<?php

namespace App\Http\Controllers\Settings\Company;

use App\Dealcloser\Core\Department\Department;
use App\Dealcloser\Interfaces\Repositories\IDepartmentRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsDepartmentController extends Controller
{
    /**
     * IDepartmentRepo implementation.
     *
     * @var IDepartmentRepo
     */
    private $departmentRepo;

    /**
     * Create a new controller instance. Only users with permission
     * edit-company-settings have access to this controller.
     *
     * @param IDepartmentRepo $departmentRepo
     */
    public function __construct(IDepartmentRepo $departmentRepo)
    {
        $this->middleware('permission:edit-company-settings');
        $this->departmentRepo = $departmentRepo;
    }

    /**
     * Show corporation department settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('settings.company.department.show')->with([
            'departments' => $this->departmentRepo->getAll(),
        ]);
    }

    /**
     * Store a department.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|max:50|unique:department']);

        $this->departmentRepo->create($request->only('name'));

        return back()
            ->with('status', 'Afdeling aangemaakt!');
    }

    /**
     * Update department.
     *
     * @param Request    $request
     * @param Department $department
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Department $department)
    {
        $this->validate($request, ['name' => 'required|max:50|unique:department,name,'.$department->name.',name']);

        $this->departmentRepo->update($department->id, $request->only('name'));

        return response()->json(['status' => 'Afdeling geupdatet.']);
    }

    /**
     * Destroy department.
     *
     * @param Department $department
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Department $department)
    {
        if ($this->departmentRepo->hasUsers($department->id)) {
            return response()->json([
                'status' => 'Er zijn nog gebruikers gekoppeld aan deze afdeling.',
            ], 401);
        }

        $this->departmentRepo->delete($department->id);

        return response()->json(['status' => 'Afdeling verwijderd.']);
    }
}
