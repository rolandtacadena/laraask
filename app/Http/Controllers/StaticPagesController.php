<?php

namespace App\Http\Controllers;

class StaticPagesController extends Controller
{

    /**
     * Guide for the site.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function howItWorks()
    {
        return view('static.how-it-works');
    }

    /**
     * About page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('static.about');
    }

}
