<?php

namespace App\Http\Controllers;

use App\Http\Transformers\ApplicationTransformer;
use App\Models\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only('tab', 'search');
        $applications = Application::filter($filters)->paginate(30);
        $applicationData = fractal($applications, new ApplicationTransformer())
            ->includeProposer()
            ->includeDean()
            ->includeChairMan()
            ->includePresident()
            ->includeSecretary()
            ->toArray();

        $pendingApplicationCount = Application::where('status', '<', 6)->count();
        $doneApplicationCount = Application::where('status', '=', 6)->count();

        return Inertia::render('Dashboard/Application/Index')->with([
            'applications' => $applicationData,
            'pendingApplicationCount' => $pendingApplicationCount,
            'doneApplicationCount' => $doneApplicationCount
        ]);
    }
}
