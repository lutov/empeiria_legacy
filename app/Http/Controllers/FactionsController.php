<?php

namespace App\Http\Controllers;

use App\Models\Faction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FactionsController extends Controller {

    private $slug = 'factions';
    private $model = Faction::class;

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
     * @return Faction
     */
    public function add(Request $request) {

        $faction = new Faction();

        $user = Auth::user();
        $name = $request->input('name');

        if(!empty($name)) {
            $faction->user_id = $user->id;
            $faction->name = $name;
            $faction->save();
        }

        return $faction;

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
        $faction = Faction::find($id);
        if(isset($faction->id)) {
            //
        }
        return $faction;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id) {
        $faction = Faction::find($id);
        if(isset($faction->id)) {
            $faction->delete();
        }
        return $faction;
    }

}
