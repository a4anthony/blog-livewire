<?php

namespace A4Anthony\BlogLivewire\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \A4Anthony\BlogLivewire\BlogLivewire
 */
class BlogLivewire extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \A4Anthony\BlogLivewire\BlogLivewire::class;
    }
}
