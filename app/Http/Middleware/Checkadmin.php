<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Checkadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            redirect()->route('auth.login');
        }

         $user = Auth::user();

        $isAdmin = $user->roles()
            ->where('name', 'admin')
            ->exists();

        if (! $isAdmin) {
            abort(403, 'شما اجازه دسترسی به این بخش را ندارید');
        }
        return $next($request);
    }
}
