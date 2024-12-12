<?php

namespace App\Http\Controllers\Dashboard;

use App\Actions\Dashboard\SaveUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreateOrUpdateUserRequest;
use App\Http\Transformers\DepartmentTransformer;
use App\Models\Department;
use App\Models\Role;
use App\Http\Transformers\UserTransformer;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(30);
        $userData = fractal($users, new UserTransformer())->toArray();
        return Inertia::render('Dashboard/User/Index')->with([
            'users' => $userData,
        ]);
    }

    public function edit(User $user)
    {
        $userData = fractal($user, new UserTransformer())->toArray();
        $roles = Role::all()->toArray();
        $departments = Department::all();
        $departmentData = fractal($departments, new DepartmentTransformer())->toArray()['data'];
        return Inertia::render('Dashboard/User/Edit')->with([
            'user' => $userData,
            'roles' => $roles,
            'departments' => $departmentData,
        ]);
    }

    public function update(CreateOrUpdateUserRequest $request, User $user, SaveUserAction $action)
    {
        $action->execute($user, $request->validated());
        return redirect()->route('dashboard.users.index')->with(['success' => 'User was successfully updated']);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard.users.index')->with('success', 'user deleted');
    }
}
