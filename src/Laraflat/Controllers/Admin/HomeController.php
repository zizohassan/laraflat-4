<?php

namespace Laraflat\Laraflat\Laraflat\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
       return view('laraflat::admin.home.index');
    }
}
