<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param  Request  $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        //Cache::remember('laravel:categories', 30, function() {return 'redis';});
        //$data = Redis::set('laravel:categories', 'redis');
        //$data = Redis::get('laravel:categories');
        //dd($data);

        return view('home', array());
    }
}
