<?php

namespace App\Http\Controllers;

use App\Models\World;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorldsController extends Controller {

    private $slug = 'worlds';
    private $model = World::class;

    /**
     * HomeController constructor.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * @return mixed
     */
    public function list() {
        $user = Auth::user();
        return $this->model::where('user_id', $user->id)->get();
    }

    /**
     * @param Request $request
     * @return World
     */
    public function add(Request $request) {

        $world = new World();

        $user = Auth::user();
        $name = $request->input('name');

        if(!empty($name)) {
            $world->user_id = $user->id;
            $world->name = $name;
            $world->save();
        }

        return $world;

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function get(int $id) {
        return $this->model::find($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function update(int $id) {
        $world = World::find($id);
        if(isset($world->id)) {
            //
        }
        return $world;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id) {
        $world = World::find($id);
        if(isset($world->id)) {
            $world->delete();
        }
        return $world;
    }

}