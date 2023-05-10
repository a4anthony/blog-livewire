<?php

namespace A4Anthony\BlogLivewire\Database\Factories;

use A4Anthony\BlogLivewire\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogCategoryFactory extends Factory
{
    protected $model = BlogCategory::class;

    public function definition()
    {
        $categories = [
            'Grammar',
            'Vocabulary',
            'Pronunciation',
            'Culture',
            'General English',
        ];
        $name = $this->faker->unique()->randomElement($categories);

        return [
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
        ];
    }
}
