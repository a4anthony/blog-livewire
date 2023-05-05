<?php

namespace A4Anthony\BlogLivewire\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Test extends Component
{
    public function render(): View|Factory|Application
    {
        return view('blog-livewire::livewire.test');
    }
}
