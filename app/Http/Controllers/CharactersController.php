<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Support\Facades\Auth;

class CharactersController extends Controller {

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
    public function list() {
        $user = Auth::user();
        return $this->model::where('user_id', $user->id)->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function get(int $id) {
        return $this->model::find($id);
    }

}
