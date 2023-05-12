<?php

namespace A4Anthony\BlogLivewire\Http\Livewire;

use A4Anthony\BlogLivewire\Models\BlogCategory;
use A4Anthony\BlogLivewire\Models\BlogPost;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;
    public $title;

    public $content;

    public $category;

    public $status;

    public $image;

    public $post;

    public function getCategoriesProperty()
    {
        return BlogCategory::all();
    }

    public function updatedImage()
    {
        $this->validate([
            "image" => "image | max:1024",
        ]);
    }

    public function publish()
    {
        $rules = [
            "title" => "required | unique:blog_posts,title",
            "content" => "required",
            "category" => "required",
            "status" => "required",
            "image" => "image | max:1024",
        ];

        if ($this->image && is_string($this->image)) {
            unset($rules["image"]);
        }

        if ($this->post && !$this->image) {
            unset($rules["image"]);
            $this->image = $this->post->image;
        }

        if ($this->post && $this->image) {
            $rules["title"] =
                "required | unique:blog_posts,title," . $this->post->id;
        }

        $this->validate($rules);

        $data = [
            "title" => $this->title,
            "slug" => Str::slug($this->title),
            "content" => $this->content,
            "category_id" => $this->category,
            "published" => $this->status === "true" ? 1 : 0,
            "image" => is_string($this->image)
                ? $this->image
                : $this->savePhoto(),
            "author" => "John Doe",
            "author_avatar" => "https://i.pravatar.cc/300",
            "published_at" => now(),
        ];
        $this->resetErrorBag();

        if ($this->post) {
            $this->post->update($data);
        } else {
            BlogPost::create($data);
        }

        return redirect()
            ->route(config("blog-livewire.admin_blog_index_route"))
            ->with("success", "Post created");
    }

    /**
     * Save photo to S3
     *
     *
     * @return string
     */
    public function savePhoto(): string
    {
        $ext = $this->image->getClientOriginalExtension();
        $fileName = Str::slug($this->title) . "." . $ext;
        $this->image->storePubliclyAs("blog-photos", $fileName, "s3");
        return Storage::disk("s3")->url("blog-photos/" . $fileName);
    }

    public function render(): View|Factory|Application
    {
        return view("blog-livewire::livewire.create-post", [
            "categories" => $this->categories,
        ]);
    }
}
