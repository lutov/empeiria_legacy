<?php

namespace App\Http\Controllers;

use App\Models\World;
use Illuminate\Http\Request;

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

		$world = new World();

        return view('home', array(
        	'world' => $world,
		));

    }
}
