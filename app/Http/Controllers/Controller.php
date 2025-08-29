<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controller
{   
    /**
     * Display the wedding gallery page
     */
    public function wedding()
    {
        return view('wedding-gallery');
    }

    /**
     * Display the corporate events gallery page
     */
    public function corporate()
    {
        return view('corporate-gallery');
    }

    /**
     * Display the birthday parties gallery page
     */
    public function birthday()
    {
        return view('birthday-gallery');
    }
}
