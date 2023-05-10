<?php

namespace A4Anthony\BlogLivewire\Http\Livewire;

use A4Anthony\BlogLivewire\Models\BlogCategory;
use A4Anthony\BlogLivewire\Models\BlogPost;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Test extends Component
{
    public $category = '';

    public $page = 1;

    public $length = 9;

    public $hasPractice = false;

    protected $queryString = ['category', 'hasPractice'];

    public function mount()
    {
        if (request('category')) {
            $this->category = request('category');
        } else {
            $this->category = 'all';
        }
    }

    public function getCategoriesProperty()
    {
        $categories = BlogCategory::orderBy('name', 'asc')
            ->get()
            ->toArray();
        array_unshift($categories, ['name' => 'All', 'slug' => 'all']);

        return $categories;
    }

    public function setCategory($category)
    {
        $this->length = 9;
        $this->category = $category;
    }

    public function getPostsProperty()
    {
        $category = BlogCategory::where('slug', $this->category)->first();
        if ($category == null) {
            $this->category = 'all';
        }
        if ($this->category == 'all') {
            $posts = new BlogPost();
        } else {
            $posts = BlogPost::where('category_id', $category->id);
        }
        if ($this->hasPractice) {
            $posts = $posts->where('has_practice', true);
        }

        return $posts->orderBy('published_at', 'desc')->paginate($this->length);
    }

    public function loadMore()
    {
        $this->length += 9;
    }

    public function render(): View|Factory|Application
    {
        return view('blog-livewire::livewire.test', [
            'categories' => $this->categories,
            'posts' => $this->posts,
        ]);
    }
}
