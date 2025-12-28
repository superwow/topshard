<?php

namespace App\Controllers;

class StaticPageController extends BaseController
{
    public function rules()
    {
        return view('pages/rules');
    }

    public function promo()
    {
        return view('pages/promo');
    }

    public function about()
    {
        return view('pages/about');
    }
}
