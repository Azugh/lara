<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\Slider;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function index() {
        $content = Item::with('categories')->orderBy("created_at", "desc")->get();
        return view("item.item-index", ['items' => $content]);
    }

    public function create() {
        $content = ItemCategory::orderBy("category_name")->get();
        return view("item.create-item", ['categories' => $content]);
    }

    public function store(ItemRequest $request) {
        // dd($request);
        // $item = new Item();
        // $item->category = $request->category;
        // dd($item);
        // dd($request->all());
        // if ($request->has('category')) {
        //     dd($request->all());
        // }
        // dd($request->all());
        $request = $request->all();
        if ($request['image']) {
            $imagePath = $request['image']->store('images/item-images', 'public');
            $request['image'] = $imagePath;
        }

        // Item::create($request)->categories()->attach($request['category']);

        $item = Item::create($request);
        if ($request['category']){
            $item->categories()->sync($request['category']);
        }
        return redirect()->route('home.index')
            ->with('success', 'Айтем успешно изменен!');

        // $item->name = $request->name;
        // $item->image = $request->image;
        // $item->save();

        // if ($request['category']) {
        //     $item->categories()->attach($request['category']);
        // }
    }
}
