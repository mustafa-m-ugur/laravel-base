<?php

namespace App\Http\Middleware\Backend;

use App\Traits\Responder;
use Closure;
use Illuminate\Http\Request;

class CheckUserAccess
{
    use Responder;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $type)
    {
        $action = $request->route()->getActionMethod();

        $role = auth()->guard('backend')->user()->role;

        if ($role && $role->can($type, $action)) {
            return $next($request);
        } else {
            $redirect = null;

            if ($request->isMethod('get')) {
                $redirect = action('Backend\HomeController@index');
            }
            return $this->respond(
                'error',
                'Bu işlemi yapmak için yetkiniz yok!',
                $redirect
            );
        }
    }
}
