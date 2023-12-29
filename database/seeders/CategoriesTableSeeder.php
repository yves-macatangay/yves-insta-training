<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Travel',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Music',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name' => 'Cooking',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ];

        $this->category->insert($categories);
    }
}
