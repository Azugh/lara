<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use Illuminate\Http\Request;

class ItemCategoryController extends Controller
{
    public function index() {
        $content = ItemCategory::orderBy("created_at","desc")->get();
        return view("itemCategory.item-category-index", ['categories' => $content]);
    }

    public function create() {
        return view('itemCategory.create-category');
    }

    public function store(Request $request) {
        $request = $request->all();
        ItemCategory::create($request);
                return redirect()->route('home.index')
            ->with('success', 'Айтем успешно изменен!');

    }
}
