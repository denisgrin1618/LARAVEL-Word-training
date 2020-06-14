<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use URL;

class LocaleController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function setLocale($locale)
    {
        
//        dd($locale);
        if (! in_array($locale,['en','ru', 'uk']))
        {
            $locale = Config::get('app.locale');
        }
        
//        dd($locale); Cookie::queue(Cookie::plain('locale', $locale));
        Cookie::queue('locale', $locale);
//        session(['locale' => $locale]);
//        session()->put('locale', $locale);
        
        return redirect(url(URL::previous()));
    }
    
}
