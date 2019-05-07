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
                /**
                 * make sure to always use the last on the trail
                 * If a spoofing request comes in the first ip is the one the supposed attack is
                 * coming from ex. 127.0.0.1,231.231.23.43
                 */
                if(!empty($exp)) {
                    $ip = $exp[(count($exp)-1)];
                }
            }

            if (!empty($request->header('true-client-ip'))) {
                $ip = $request->header('true-client-ip');
            }

            if( !in_array($ip, $this->whitelist) ) {
                if(!empty(config('laravel-extensions.comingsoon')) && $request->is('/')) {
                    return response()
                        ->view(config('laravel-extensions.comingsoon'), [], 200);
                }
                abort(404);
            }
        }

        return $next($request);
    }
}