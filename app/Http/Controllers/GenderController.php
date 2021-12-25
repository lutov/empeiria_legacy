<?php


namespace App\Http\Controllers;


use App\Models\Character\Gender;

class GenderController
{

    private $slug = 'genders';
    private $model = Gender::class;

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->model::get();
    }
}
