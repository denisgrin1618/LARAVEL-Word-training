<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Config;
use Cookie;
use Crypt;

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
        
         $locale = $request->cookie('locale', Config::get('app.locale'));
         
//         dd(\Crypt::decrypt(Cookie::get('locale')));
//         dd(encrypt(Cookie::get('locale')));
//         dd(session());
//         dd(Crypt::decrypt($locale, false));
//         dd($locale);
         
        
        App::setLocale($locale);
//        Carbon::setLocale($locale);

        return $next($request);
    }
}
