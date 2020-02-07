<?php

namespace App\Http\Controllers;

use App\Models\World;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorldController extends Controller {

    /**
     * WorldController constructor.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * @return World
     */
    public function index() {

        $user = Auth::user();

        $world = $user->world;

        if(!$world) {

            $world = new World();
            $world->user_id = $user->id;
            $world->name = World::getRandomName();
            $world->save();

        }

        return $world;

    }

}
