<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function landingpage($kodeunik){
        return view("landingpage",['kode'=>$kodeunik]);
    }
}
