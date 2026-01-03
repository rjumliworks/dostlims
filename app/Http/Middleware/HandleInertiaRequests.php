<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Models\User;
use App\Http\Resources\UserResource;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'user' => (\Auth::check()) ? new UserResource(User::with('profile')->where('id',\Auth::user()->id)->first()) : null,
            'roles' => (\Auth::check()) ? \Auth::user()->roles()->where('user_roles.is_active', 1)->pluck('name') : null,
            'flash' => [
                'data'    => session('data') ?? null,
                'message' => session('message') ?? null,
                'info'    => session('info') ?? null,
                'status'  => session('status') ?? null,
                'type'    => session('type') ?? null,
            ],
        ];
    }
}
