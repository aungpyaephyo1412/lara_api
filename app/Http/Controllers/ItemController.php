<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
//        return response()->json($items,200);
        return ItemResource::collection($items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "name" => "required"
        ]);
        if ($validator->fails()){
            return response()->json([$validator->messages()],422);
        }
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
//        return response()->json($item);
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            "name" => "required"
        ]);
        if ($validator->fails()){
            return response()->json([$validator->messages()],422);
        }
        $item = Item::find($id);
        if (is_null($item)){
            return response()->json(["message"=>"Item not found"],404);
        }
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
