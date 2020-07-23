<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Carbon;
use Session;
use App;

class Locale
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
        if (config('locale.status')) {

            if (Session::has('locale') && array_key_exists(Session::get('locale'), config('locale.languages'))) {

                App::setLocale(Session::get('locale'));

            } else {

                $userLanguages = preg_split('/[,;]/', $request->server('HTTP_ACCEPT_LANGUAGE'));

                foreach ($userLanguages as $languages) {

                    if (array_key_exists($languages, config('locale.languages'))) {

                        App::setLocale($languages);

                        setLocale(LC_TIME,config('locale.languages')[$languages][2]);

                        Carbon::setLocale(config('locale.languages')[$languages][0]);

                        if (config('locale.languages')[$languages][2]) {

                            \session(['lang-rtl' => true]);

                        } else {
                            Session::forget('lang-rtl');
                        }

                        break;

                    }
                }

            }
        }

        return $next($request);
    }
}
