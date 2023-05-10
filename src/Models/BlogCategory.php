<?php

namespace A4Anthony\BlogLivewire\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function newFactory()
    {
        return \A4Anthony\BlogLivewire\Database\Factories\BlogCategoryFactory::new();
    }
}
