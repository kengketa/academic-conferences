<?php

namespace App\Http\Controllers;

use App\Actions\Dashboard\SaveApplicationAction;
use App\Http\Requests\Dashboard\CreateOrUpdateApplicationRequest;
use App\Http\Transformers\ApplicationTransformer;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only('tab', 'search');
        $applications = Application::filter($filters)->orderBy('updated_at', 'desc')->paginate(30);
        $applicationData = fractal($applications, new ApplicationTransformer())
            ->includeProposer()
            ->includeDean()
            ->includeChairMan()
            ->includePresident()
            ->includeSecretary()
            ->toArray();

        $pendingApplicationCount = Application::where('status', '<', 6)->count();
        $doneApplicationCount = Application::where('status', '=', 6)->count();

        $user = Auth::user();
        $userDepartmentId = $user?->major?->department?->id;
        if ($userDepartmentId && $user->roles->contains('name', 'dean')) {
            $pendingApplicationCount = Application::whereHas('proposedBy', function ($query) use ($userDepartmentId) {
                $query->whereHas('major', function ($query) use ($userDepartmentId) {
                    $query->where('department_id', $userDepartmentId);
                });
            })->where('status', '<', 6)->count();

            $doneApplicationCount = Application::whereHas('proposedBy', function ($query) use ($userDepartmentId) {
                $query->whereHas('major', function ($query) use ($userDepartmentId) {
                    $query->where('department_id', $userDepartmentId);
                });
            })->where('status', '=', 6)->count();
        }
        if ($user->roles->contains('name', 'proposer') &&
            !$user->roles->contains('name', 'dean') &&
            !$user->roles->contains('name', 'chairman') &&
            !$user->roles->contains('name', 'president') &&
            !$user->roles->contains('name', 'secretary')
        ) {
            $pendingApplicationCount = Application::whereHas('proposedBy', function ($query) use ($userDepartmentId) {
                $query->whereHas('major', function ($query) use ($userDepartmentId) {
                    $query->where('department_id', $userDepartmentId);
                });
            })->where('proposed_by', Auth::id())->where('status', '<', 6)->count();

            $doneApplicationCount = Application::whereHas('proposedBy', function ($query) use ($userDepartmentId) {
                $query->whereHas('major', function ($query) use ($userDepartmentId) {
                    $query->where('department_id', $userDepartmentId);
                });
            })->where('proposed_by', Auth::id())->where('status', '=', 6)->count();
        }
        return Inertia::render('Dashboard/Application/Index')->with([
            'applications' => $applicationData,
            'pendingApplicationCount' => $pendingApplicationCount,
            'doneApplicationCount' => $doneApplicationCount
        ]);
    }

    public function create()
    {
        return Inertia::render('Dashboard/Application/Create');
    }

    public function store(CreateOrUpdateApplicationRequest $request, saveApplicationAction $action)
    {
        $action->execute(new Application(), $request->validated());
        return redirect()->route('dashboard.applications.index')->with('success', 'Application created.');
    }

    public function edit(Request $request, Application $application)
    {
        $applicationData = fractal($application, new ApplicationTransformer())
            ->includeProposer()
            ->includeDean()
            ->includeChairMan()
            ->includePresident()
            ->includeSecretary()
            ->includeDocuments()
            ->toArray();
        return Inertia::render('Dashboard/Application/Edit')->with([
            'application' => $applicationData,
        ]);
    }

    public function update(
        CreateOrUpdateApplicationRequest $request,
        Application $application,
        SaveApplicationAction $action
    ) {
        $action->execute($application, $request->validated());
        return redirect()->back()->with('success', 'Application updated successfully.');
    }

    public function print(Application $application)
    {
        $applicationData = fractal($application, new ApplicationTransformer())
            ->includeProposer()
            ->includeDean()
            ->includeChairMan()
            ->includePresident()
            ->includeSecretary()
            ->includeDocuments()
            ->toArray();
        return Inertia::render('Dashboard/Application/Print')->with([
            'application' => $applicationData,
        ]);
    }
}
