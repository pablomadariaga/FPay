<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class LocaleMiddleware
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
        // Locale is activated
        if (config('locale.status')) {
            if (
                session()->has('locale') &&
                array_key_exists(session()->get('locale'), config('locale.languages'))
            ) {
                app()->setLocale(session()->get('locale'));
            } else {
                $userLanguages = preg_split('/[,;]/', $request->server('HTTP_ACCEPT_LANGUAGE'));
                foreach ($userLanguages as $language) {
                    if (array_key_exists($language, config('locale.languages'))) {
                        // Set the Laravel locale
                        app()->setLocale($language);
                        // Set php setLocale
                        setlocale(LC_TIME, config('locale.languages')[$language][1]);
                        // Set the locale configuration for Carbon
                        Carbon::setLocale(config('locale.languages')[$language][0]);
                        //Sets the session variable if it has RTL support
                        if (config('locale.languages')[$language][2]) {
                            session(['lang-rtl' => true]);
                        } else {
                            session()->forget('lang-rtl');
                        }
                        break;
                    }
                }
            }
        }
        return $next($request);
    }
}
