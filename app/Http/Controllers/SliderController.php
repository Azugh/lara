<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{

    public function index()
    {
        $content = ['sliders' => Slider::orderBy("created_at", "desc")->get()];
        return view('admin/admin', $content);
    }

    public function show($id)
    {
        // dd($slider);
        $slider = Slider::find($id);

        return view('admin/slider/slider-show', compact('slider'));
    }

    public function create()
    {
        return view('admin/slider/slider-create');
    }


    public function store(SliderRequest $request): RedirectResponse
    {
        dd($request);
        $request = $request->all();
        if ($request['image']) {
            $imagePath = $request['image']->store('images/slider-images', 'public');
            $request['image'] = $imagePath;
        }
        $request['isActive'] = false;
        Slider::create($request);

        return redirect()->route('admin.index')
            ->with('success', 'Слайдер успешно создан!');
    }

    public function edit($id)
    {
        $slider = Slider::find($id);

        return view('admin/slider/slider-edit', compact('slider'));
    }

    public function update(SliderRequest $request, $id)
    {
        // dd($request);

        //находим запись в бд
        $slider = Slider::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }

            $imagePath = $request->file('image')->store('images/slider-images', 'public');
            $validated['image'] = $imagePath;
        }

        $slider->update($validated);

        return redirect()->route('admin.index')
            ->with('success', 'Слайдер успешно изменен!');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('admin.index')
            ->with('success', 'Слайдер успешно удален!');
    }


}
