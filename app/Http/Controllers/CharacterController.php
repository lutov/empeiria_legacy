<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller {

    private $slug = 'characters';
    private $model = Character::class;

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
     * @return Character
     */
    public function store(Request $request) {

        $character = new Character();

        $user = Auth::user();
        $name = $request->input('name');

        if(!empty($name)) {
            $character->user_id = $user->id;
            $character->name = $name;
            $character->save();
        }

        return $character;

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
        $character = Character::find($id);
        if(isset($character->id)) {
            //
        }
        return $character;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id) {
        $character = Character::find($id);
        if(isset($character->id)) {
            $character->delete();
        }
        return $character;
    }

}
