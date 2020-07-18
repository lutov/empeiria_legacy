<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{

    private $slug = 'characters';
    private $model = Character::class;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $user = Auth::user();
        return Character::where('user_id', $user->id)->get();
    }

    /**
     * @param  Request  $request
     * @return Character
     */
    public function store(Request $request)
    {
        $character = new Character();

        $user = Auth::user();
        $name = $request->input('name');

        if (!empty($name)) {
            $character->user_id = $user->id;
            $character->name = $name;
            $character->save();

            $character->inventory()->create();
        }

        return $character;
    }

    /**
     * @param  int  $id
     * @return mixed
     */
    public function show(int $id)
    {
        return Character::find($id);
    }

    /**
     * @param  int  $id
     * @return mixed
     */
    public function update(int $id)
    {
        $character = Character::find($id);
        if (isset($character->id)) {
            //
        }
        return $character;
    }

    /**
     * @param  int  $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        $character = Character::find($id);
        if (isset($character->id)) {
            $character->delete();
        }
        return $character;
    }

    /**
     * @param  Request  $request
     * @param  int  $id
     * @return mixed
     */
    public function move(Request $request, int $id)
    {
        $character = Character::find($id);

        $x = $request->input('x');
        $y = $request->input('y');

        if (isset($character->id)) {

            $destination = new Position();
            $destination->x = $x;
            $destination->y = $y;

            $character->move($destination);

        }
        return $character;
    }

}
