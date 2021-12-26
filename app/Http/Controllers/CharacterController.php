<?php

namespace App\Http\Controllers;

use App\Interfaces\MoveInterface;
use App\Models\Character;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CharacterController extends Controller implements MoveInterface
{

    private $slug = 'characters';
    private $model = Character::class;
    private $rules = [
        'name' => ['required', 'string', 'max:255'],
        'nickname' => ['string', 'max:255', 'nullable'],
        'last_name' => ['string', 'max:255', 'nullable'],
        'age' => ['numeric', 'nullable'],
    ];

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        //$this->middleware('auth');
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
     * @param Request $request
     * @return Character
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $character = new Character();
        $user = Auth::user();
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->passes()) {
            $character->fill($validator->validated());
            if ($request->has('avatar')) {
                $character->avatar_id = $request->get('avatar')['id'];
            }
            if ($request->has('gender')) {
                $character->gender_id = $request->get('gender')['id'];
            }
            $character->user_id = $user->id;
            $character->save();
        } else {
            return response()->json($validator->messages(), 422);
        }
        return $character->fresh();
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
     * @param int $id
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function update(int $id, Request $request)
    {
        $character = Character::find($id);
        if (isset($character->id)) {
            $validator = Validator::make($request->all(), $this->rules);
            if ($validator->passes()) {
                $character->fill($validator->validated());
                if ($request->has('avatar')) {
                    $character->avatar_id = $request->get('avatar')['id'];
                }
                if ($request->has('gender')) {
                    $character->gender_id = $request->get('gender')['id'];
                }
                $character->save();
            } else {
                return response()->json($validator->messages(), 422);
            }
        }
        return $character->fresh();
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
            $distance = $character->position->distance($destination);
            if (0 < $distance) {
                $character->position->x = $destination->x;
                $character->position->y = $destination->y;
                $character->position->save();
            }
            $character->refresh();
        }
        return $character;
    }

}
