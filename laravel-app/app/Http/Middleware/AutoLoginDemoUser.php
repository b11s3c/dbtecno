<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AutoLoginDemoUser
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! app()->runningInConsole() && Auth::guest()) {
            $user = User::query()->firstOrCreate(
                ['email' => 'demo@dbtecno.test'],
                [
                    'name' => 'Demo Müşteri',
                    'password' => Hash::make('password'),
                ]
            );

            Auth::login($user);
        }

        return $next($request);
    }
}
