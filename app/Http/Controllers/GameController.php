<?php

namespace App\Http\Controllers;

use App\Helpers\MapHelper;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class GameController extends Controller
{

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * @param Request $request
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

    /**
     * @param Request $request
     * @param int $id
     * @return Factory|View
     * @throws \Exception
     */
    public function world(Request $request, int $id = 0)
    {

        //$map = MapHelper::generate();

        $key = 'world_map_' . $id;
        $seconds = 60 * 60;
        $map = Cache::remember($key, $seconds, function () {
            return MapHelper::generate();
        });

        MapHelper::draw($map, $id);

        echo MapHelper::render($map, $id);

        return view('world', array(
            'id' => $id,
        ));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Factory|View
     */
    public function factions(Request $request, int $id = 0)
    {
        return view('faction', array(
            'request' => $request,
            'id' => $id,
        ));
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function squads(Request $request)
    {
        return view('game.squads', array(
            'request' => $request,
        ));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Factory|\Illuminate\Contracts\View\View
     */
    public function squad(Request $request, int $id)
    {
        return view('game.squad', array(
            'request' => $request,
            'id' => $id,
        ));
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function characters(Request $request)
    {
        return view('game.characters', array(
            'request' => $request,
        ));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Factory|View
     */
    public function character(Request $request, int $id = 0)
    {
        return view('character', array(
            'request' => $request,
            'id' => $id,
        ));
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function conversations(Request $request)
    {
        return view('conversations', array(
            'request' => $request,
        ));
    }

}
