<?php

namespace Laravel\extensions\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class setLocale
{
    /**
     * @var locales
     * the list of available locales for the application. Gets populated through configuration file laravel-extensions
     * which loads values from env var LE_LOCALES
     */
    protected $locales;

    public function __construct() {
        $this->locales = explode(";", config('laravel-extensions.locales'));
    }

    /**
     * Handle an incoming request. Check available locales and return 404 for the ones not found.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( in_array($request->segment(1), $this->locales) ) {
            app()->setLocale($request->segment(1));
            return $next($request);
        }

        abort(404);

    }
}