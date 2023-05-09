<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    /**
     * Display About Us.
     */
    public function aboutUs()
    {
        return view('static.about_us');
    }

    /**
     * Display Contact Us.
     */
    public function contactUs()
    {
        return view('static.contact_us');
    }

    public function privacyPolicy()
    {
        return view('static.privacy_policy');
    }

    public function termsAndConditions()
    {
        return view('static.terms_and_conditions');
    }
}
