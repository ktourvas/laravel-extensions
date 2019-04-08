<?php

namespace Laravel\extensions\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class ipRestrict
{

    protected $whitelist, $blacklist;

    public function __construct()
    {
        $this->whitelist = config('laravel-extensions.whitelist');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * Make sure that all related rules apply to production environment and not testing/dev
         */
        if(App::environment('production')) {

            $ip = $request->ip();

            if(!empty($request->header('x-forwarded-for'))) {
                $exp = explode(",", $request->header('x-forwarded-for'));
                if(!empty($exp[0])) {
                    $ip = $exp[0];
                }
            }

            if (!empty($request->header('true-client-ip'))) {
                $ip = $request->header('true-client-ip');
            }

            if( !in_array($ip, $this->whitelist) ) {
                abort(404);
            }
        }

        return $next($request);
    }
}