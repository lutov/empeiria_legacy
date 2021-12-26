<?php


namespace App\Http\Controllers;


use App\Models\Character\Avatar;
use Illuminate\Http\Request;

class AvatarController
{

    private $slug = 'avatars';
    private $model = Avatar::class;

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->model::get();
    }

    /**
     * @param Request $request
     * @param int $genderId
     * @param int $limit
     * @return mixed
     */
    public function random(Request $request, int $genderId = 1, int $limit = 9)
    {
        if ($request->has('gender_id')) {
            $genderId = (int)$request->get('gender_id');
        }
        if ($request->has('limit')) {
            $limit = (int)$request->get('limit');
        }
        return $this->model::where('gender_id', '=', $genderId)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }
}
