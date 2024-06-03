<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class MiddlewareAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $infoAdmin = Session::get('infoAdmin');
        if(isset($infoAdmin))
        {
            return $next($request);
        }
        else
        {
            return Redirect::to('/login-admin');
        }

    }
}
