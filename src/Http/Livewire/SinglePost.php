<?php

namespace A4Anthony\BlogLivewire\Http\Livewire;

use A4Anthony\BlogLivewire\Models\BlogPost;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SinglePost extends Component
{
    public BlogPost $post;

    public function mount($post)
    {
        $this->post = $post;
    }

    public function getPostProperty()
    {
        return BlogPost::where('slug', request('postSlug'))->firstOrFail();
    }

    public function getRelatedPostProperty()
    {
        return BlogPost::where('category_id', $this->post->category_id)
            ->where('id', '!=', $this->post->id)
            ->limit(3)
            ->get();
    }

    public function render(): View|Factory|Application
    {
        return view('blog-livewire::livewire.single-post', [
            'relatedPosts' => $this->relatedPost,
        ]);
    }
}
