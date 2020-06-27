<?php

namespace App\Http\Controllers;

use App\Models\Squad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SquadController extends Controller {

    private $slug = 'squads';
    private $model = Squad::class;

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
        $user = Auth::user();
        return $this->model::where('user_id', $user->id)->get();
    }

    /**
     * @param Request $request
     * @return Squad
     */
    public function store(Request $request) {

        $squad = new Squad();

        $user = Auth::user();
        $name = $request->input('name');

        if(!empty($name)) {
            $squad->user_id = $user->id;
            $squad->name = $name;
            $squad->save();
        }

        return $squad;

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id) {
        return $this->model::find($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function update(int $id) {
        $squad = Squad::find($id);
        if(isset($squad->id)) {
            //
        }
        return $squad;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id) {
        $squad = Squad::find($id);
        if(isset($squad->id)) {
            $squad->delete();
        }
        return $squad;
    }

}
