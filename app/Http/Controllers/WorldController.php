<?php

namespace App\Http\Controllers;

use App\Models\World;
use Illuminate\Http\Request;

class WorldController extends Controller {

    /**
     * @param Request $request
     * @return array
     */
    public function index(Request $request) {

		$world = new World();

        return $world->getStructure();

    }
}
