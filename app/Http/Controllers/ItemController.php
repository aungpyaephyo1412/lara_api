<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::when(request()->has("keyword"), function (Builder $query) {
            $query->where("name","like","%".request()->keyword."%");
        })->paginate(10)->withQueryString();
        return response()->json($items,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required"
        ]);
        $item = new Item();
        $item->name = $request->name;
        $item->save();
        return response()->json(["message"=>"Create successfully!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        if (is_null($item)){
            return response()->json(["message"=>"Item not found"],404);
        }
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Item::find($id);
        if (is_null($item)){
            return response()->json(["message"=>"Item not found"],404);
        }
        $request->validate([
            "name"=>"required"
        ]);
        $item->name = $request->name;
        $item->update();
        return response()->json(["message"=>"Update successfully"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::find($id);
        if (is_null($item)){
            return response()->json(["message"=>"Item not found"],404);
        }
        $item->delete();
        return response()->json([],201);
    }
}
