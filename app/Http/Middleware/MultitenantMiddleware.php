<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;


class MultitenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        switch ($request->route('entitas')) {
            case "ijf_live":
                $db         = 'ijf_live';
                Config::set(['database.default' => $db]);
                break;
            default:
                $db         = 'ijf17_dev1';
                Config::set(['database.default' => $db]);
        }

        $response = $next($request);
        return $response;
    }
}
