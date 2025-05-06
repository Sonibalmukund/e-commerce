<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $category = Category::all();

    $subcategories = [
        ['category_id' => $category[0]->id, 'name' => 'Mobiles'],
        ['category_id' => $category[0]->id, 'name' => 'Laptops'],
        ['category_id' => $category[1]->id, 'name' => 'Men'],
        ['category_id' => $category[1]->id, 'name' => 'Women'],
        ['category_id' => $category[2]->id, 'name' => 'Fiction'],
    ];

    foreach ($subcategories as $sub) {
        Subcategory::create($sub);
    }

    }
}
