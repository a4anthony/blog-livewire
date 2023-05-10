<?php

namespace A4Anthony\BlogLivewire\Database\Factories;

use A4Anthony\BlogLivewire\Models\BlogCategory;
use A4Anthony\BlogLivewire\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition()
    {
        $title = $this->faker->sentence;
        $content = $this->faker->text(300);
        for ($i = 0; $i < 5; $i++) {
            $content = $content . "\n\n" . $this->faker->paragraph(8);
        }
        return [
            "title" => $this->faker->sentence,
            "slug" => Str::slug($title),
            "author" => $this->faker->name,
            "author_avatar" => "https://picsum.photos/200/200",
            "content" => $content,
            "image" => $this->faker->imageUrl(640, 480, "cats", true),
            "category_id" => BlogCategory::inRandomOrder()->first()->id,
            "published" => $this->faker->boolean,
            "has_practice" => $this->faker->boolean,
            "published_at" => $this->faker->dateTimeBetween("-2 months", "now"),
        ];
    }
}
