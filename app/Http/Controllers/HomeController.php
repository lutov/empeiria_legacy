<?php

namespace App\Http\Controllers;

use App\Models\World;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller {

	/**
	 * HomeController constructor.
	 */
    public function __construct() {
        $this->middleware('auth');
    }

	/**
	 * @param Request $request
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index(Request $request) {

        //Cache::remember('laravel:categories', 30, function() {return 'redis';});
        //$data = Redis::set('laravel:categories', 'redis');
        //$data = Redis::get('laravel:categories');
        //dd($data);

		$world = new World();

        return view('home', array(
        	'world' => $world,
		));

    }
}
