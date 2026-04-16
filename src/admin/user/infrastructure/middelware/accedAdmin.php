<?php

namespace Src\admin\user\infrastructure\middelware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class accedAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->roles[0]['name'] !== 'Admin') {
            abort(403);
        }
        return $next($request);
    }
}
