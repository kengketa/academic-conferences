<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Transformers\UserTransformer;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function share(Request $request): array
    {
        $user = null;
        if (Auth::user()) {
            $user = User::where('id', Auth::user()->id)->first();
        }
        return array_merge(parent::share($request), [
            'user' => fractal($user, new UserTransformer())->toArray(),
            'isAdmin' => $user && $user->roles->count() > 0 && $user->roles->contains('name', 'admin'),
            'role' => $user && $user->role ? $user->role->name : null,
            'flash' => [
                'success' => Session::get('success'),
                'error' => Session::get('error'),
            ],
        ]);
    }
}
