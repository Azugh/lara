<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            //
            'name' => $this->faker->name(),
//            'image' => $this->faker->imageUrl(640,480, 'cats'),
            'quantity' => $this->faker->randomDigit(),
            'price' => $this->faker->randomDigit(),
//            'category' => $this->faker->randomElements([1, 2, 3, 4], rand(0, 4)),
            'description' => $this->faker->text(),

//            'image' => $this->faker->image('public/storage/images',640,480, null, false),
        ];
    }
}
