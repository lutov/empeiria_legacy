<?php

namespace App\Http\Controllers;

use App\Helpers\MapHelper;
use App\Helpers\RandomHelper;
use App\Models\Name;
use App\Models\World\Region;
use App\Models\World\Tile;
use App\Properties\RandomColor;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
}
