<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table('sliders')->truncate();
//        Storage::disk('storage')->put('images/slider-images/', asset('public/images/art/slider2-bg1.jpg'));
        for ($i = 1; $i <= 3; $i++) {
            Storage::disk('public')->put(
                'images/slider-images/slider'.$i.'.jpg',
                file_get_contents(public_path('images/art/slider-bg'.$i.'.jpg'))
            );
            DB::table('sliders')->insert([
                'title' => 'Имя '.$i,
                'content' => 'Контент '.$i,
                'btn_text' => 'Кнопка '.$i,
                'image' => Storage::url('images/slider-images/slider'.$i.'.jpg'),
                'isActive' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
