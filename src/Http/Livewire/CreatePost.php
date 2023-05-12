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

    public function testData()
    {
        $this->title = "Test Title " . Str::random(rand(5, 10));
        $this->content = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad deserunt, doloremque doloribus ducimus, eos incidunt
             ipsum iste itaque iusto magni obcaecati sed suscipit vitae? Adipisci aperiam assumenda beatae consequuntur cumque dolores 
             dolorum error excepturi illum incidunt iure laboriosam laudantium, maiores optio, perferendis, qui quis sapiente unde velit voluptates?
              Blanditiis corporis ex fugit laudantium pariatur, sed sit totam! Quaerat, voluptatem, voluptatum? Accusamus ad assumenda atque corporis dolorem
               doloremque facilis, fugiat molestias nemo nihil quisquam recusandae sequi sit. Atque consectetur eius harum illo nam soluta tenetur. Aliquid
                beatae consequuntur corporis deleniti deserunt dignissimos dolores dolorum, facilis ipsum iste iusto, laborum maiores molestias nam nemo nulla odio officiis
                 quaerat quasi quia quos recusandae sequi sit sunt tempora temporibus vero voluptate! Ad dignissimos dolore doloremque ducimus eaque eum mollitia necessitatibus
                  obcaecati reprehenderit repudiandae. Cum, dolor ea error excepturi inventore magnam magni necessitatibus nesciunt nihil, perspiciatis quam, quas qui repellat
                   rerum similique vel voluptas voluptatum. Beatae ea eaque numquam perspiciatis quam quas repellat soluta veniam voluptatem, voluptatibus. Blanditiis cumque deleniti,
                    dolore eaque excepturi in laudantium nisi officia quam, quas quia quis similique tempora voluptas voluptatum. Beatae commodi dignissimos dolores earum eos eveniet
                     excepturi facere in itaque quam! Ab aliquid amet assumenda at, aut consequatur corporis cum dolorum excepturi inventore modi nesciunt, numquam odio possimus rerum sapiente voluptas! Cum laboriosam laudantium necessitatibus neque perferendis perspiciatis quos veniam. Aliquid debitis earum error fugiat magni necessitatibus neque perferendis quos, similique veniam?
                      Assumenda beatae eos et exercitationem maiores minima minus nesciunt porro suscipit voluptatum. Adipisci, alias autem dolores fugit ipsa ipsum, itaque magnam, praesentium sunt veniam 
                      vitae voluptatem. Accusamus amet distinctio dolorum enim est eveniet excepturi expedita fugit, illo ipsam ipsum maxime nisi odit perspiciatis placeat, qui quia quibusdam quidem quisquam
                       recusandae reiciendis sed ut vel, velit vero voluptas voluptatum? Adipisci atque consectetur dolores, eaque eos esse exercitationem expedita, in incidunt laboriosam magni numquam quia
                        quidem quo repellendus totam unde voluptates voluptatibus! Ab alias aliquam architecto asperiores at consequatur cum dignissimos dolorem dolores ducimus, eius facilis illum impedit
                         incidunt inventore laudantium libero modi nobis, omnis provident, quae quidem reiciendis rerum sapiente vero voluptates voluptatum? Aliquid aspernatur, at, consectetur cupiditate 
                         doloremque doloribus earum enim eum exercitationem expedita id magni maiores, modi pariatur perspiciatis quis rerum sequi similique sunt ut veritatis vero voluptatibus. Aspernatur
                          earum error expedita necessitatibus nostrum praesentium quia quibusdam quo sunt vel. Consectetur enim eos error explicabo facilis fuga ipsa perspiciatis sapiente? Esse fugiat labore";
        $this->category = 1;
        $this->status = "true";
        $this->dispatchBrowserEvent("trix-change", ["value" => $this->content]);
    }

    public function render(): View|Factory|Application
    {
        return view("blog-livewire::livewire.create-post", [
            "categories" => $this->categories,
        ]);
    }
}
