<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\ItemCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Tests\Integration\Database\EloquentHasManyThroughTest\Category;
use Storage;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
//        ItemCategory::factory()
//            ->count(4)
//            ->has(Item::factory()->count(3))
//            ->create();

        DB::table('item_categories')->truncate();
        DB::table('items')->truncate();
        DB::table('item_item_category')->truncate();

        for ($i = 1; $i <= 7; $i++) {
            Storage::disk('public')->put(
                'images/item-images/item-image' . $i . '.png',
                file_get_contents(public_path('images/art/c' . $i . '.png'))
            );
        }
//        ItemCategory::factory()->count(3)
//            ->has(Item::factory()->count(3))
//        ->create();

        for ($i = 1; $i <= 4; $i++) {
            $items = Item::create([
                    'name' => 'Итем ' . $i,
                    'image' => Storage::url('images/item-images/item-image' . $i . '.png'),
                ]);
        }
        $categories = [
            'Категория 1' => [1,2,3,4],
            'Категория 2' => [1,4],
            'Категория 3' => [2,3,4],
            'Категория 4' => [3,4],
        ];

        foreach ($categories as $categoryName => $items) {
            $category = ItemCategory::create([
                'category_name' => $categoryName
            ]);

            foreach ($items as $itemData) {
                $category->items()->attach($itemData);
            }
        }
    }
}
