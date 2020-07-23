<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App;

class GeneralController extends Controller
{
    public function changeLanguage($locale)
    {

        try {

            if (array_key_exists($locale, config('locale.languages'))) {
                
                Session::put('locale', $locale);
                App::setLocale($locale);
                return redirect()->back();
            }

            return redirect()->back();

        } catch (\Exception $exception) {

            return redirect()->back();

        }

    }
}
