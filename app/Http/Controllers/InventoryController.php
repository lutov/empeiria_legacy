<?php

namespace App\Http\Controllers;

use App\Interfaces\StorageInterface;
use App\Models\Characters\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller implements StorageInterface
{

    private $slug = 'inventories';
    private $model = Inventory::class;

    /**
     * InventoryController constructor.
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
        return Inventory::where('user_id', $user->id)->get();
    }

    /**
     * @param  Request  $request
     * @return Inventory
     */
    public function store(Request $request)
    {
        $inventory = new Inventory();

        $character_id = $request->input('character_id');

        if (!empty($character_id)) {
            $inventory->character_id = $character_id;
            $inventory->save();
        }

        return $inventory;
    }

    /**
     * @param  int  $id
     * @return mixed
     */
    public function show(int $id)
    {
        return Inventory::find($id);
    }

    /**
     * @param  int  $id
     * @return mixed
     */
    public function update(int $id)
    {
        $inventory = Inventory::find($id);
        if (isset($inventory->id)) {
            //
        }
        return $inventory;
    }

    /**
     * @param  int  $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        $inventory = Inventory::find($id);
        if (isset($inventory->id)) {
            $inventory->delete();
        }
        return $inventory;
    }

    /**
     * @param  int  $id
     * @return mixed
     */
    public function items(int $id)
    {
        return Inventory::find($id)->items;
    }

    /**
     * @param  Request  $request
     * @param  int  $id
     * @return mixed
     */
    public function attachItems(Request $request, int $id)
    {
        $items = $request->input('items', array());
        $inventory = Inventory::find($id);
        $inventory->items()->attach($items);
        return $inventory;
    }

    /**
     * @param  Request  $request
     * @param  int  $id
     * @return mixed
     */
    public function detachItems(Request $request, int $id)
    {
        $items = $request->input('items', array());
        $inventory = Inventory::find($id);
        $inventory->items()->detach($items);
        return $inventory;
    }

}
