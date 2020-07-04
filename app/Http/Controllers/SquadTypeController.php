<?php

namespace App\Http\Controllers;

use App\Models\SquadType;
use Illuminate\Http\Request;

class SquadTypeController extends Controller {

    private $slug = 'squads_types';
    private $model = SquadType::class;

    /**
     * HomeController constructor.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * @return mixed
     */
    public function index() {
        return SquadType::all();
    }

    /**
     * @param Request $request
     * @return SquadType
     */
    public function store(Request $request) {

        $squad_type = new SquadType();

        $name = $request->input('name');

        if(!empty($name)) {
            $squad_type->name = $name;
            $squad_type->save();
        }

        return $squad_type;

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id) {
        return SquadType::find($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function update(int $id) {
        $squad_type = SquadType::find($id);
        if(isset($squad_type->id)) {
            //
        }
        return $squad_type;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id) {
        $squad_type = SquadType::find($id);
        if(isset($squad_type->id)) {
            $squad_type->delete();
        }
        return $squad_type;
    }

}
