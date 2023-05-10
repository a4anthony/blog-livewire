<?php

namespace A4Anthony\BlogLivewire\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ["read_time"];

    public function getReadTimeAttribute()
    {
        Str::macro("readDuration", function (...$text) {
            $totalWords = str_word_count(implode(" ", $text));
            $minutesToRead = round($totalWords / 200);

            return (int) max(1, $minutesToRead);
        });

        return Str::readDuration($this->attributes["content"]) . " min read";
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public static function newFactory()
    {
        return \A4Anthony\BlogLivewire\Database\Factories\BlogPostFactory::new();
    }
}
