<div
    class="bl-max-w-3xl bl-w-full bl-mx-auto"
    x-init
>
    <form
        method="post"
        action=""
        enctype="multipart/form-data"
        class="bl-space-y-6"
    >
        @csrf
        <div class="bl-relative">
            <label class="bl-form-label">Title</label>
            <input
                wire:model="title"
                type="text"
                name="title"
                class="bl-form-input @error('title') bl-form-input-error @enderror"
                placeholder="Enter post title"
            />
            @error('title')
            <p class="bl-form-error"> {{ $message }}</p>
            @enderror
        </div>


        <div class="bl-grid bl-grid-cols-2 bl-gap-6">
            <div class="bl-relative">
                <label class="bl-form-label">Category</label>
                <select
                    wire:model="category"
                    name="category"
                    id="category"
                    class="bl-form-input @error('category') bl-form-input-error @enderror"
                >
                    <option value="">-- select category --</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category')
                <p class="bl-form-error"> {{ $message }}</p>
                @enderror
            </div>
            <div class="bl-relative">
                <label class="bl-form-label">Status</label>
                <select
                    wire:model="status"
                    name="status"
                    id="status"
                    class="bl-form-input @error('status') bl-form-input-error @enderror"
                >
                    <option value="">select status</option>
                    <option value="true">published</option>
                    <option value="false">not published</option>
                </select>
                @error('status')
                <p class="bl-form-error"> {{ $message }}</p>
                @enderror
            </div>
        </div>


        <div class="bl-relative">
            <label class="bl-form-label">Image</label>
            <div class="bl-flex bl-justify-center bl-items-center bl-bg-gray-200 bl-w-2/3 bl-h-64 bl-rounded-xl bl-p-1 bl-relative @error('image') bl-form-input-error @enderror">
                @if ($image)
                    <img
                        class="bl-aspect-auto bl-h-64 bl-w-auto bl-rounded-lg"
                        style="object-fit: contain"
                        src="{{ is_string($image) ? $image : $image->temporaryUrl() }}"
                        alt=""
                    />
                @else
                    <button
                        type="button"
                        @click="() => {
                        const input = document.getElementById('postImage');
                        input.click()
                    }"
                        class="bl-inline-flex bl-items-center bl-px-2.5 bl-py-1.5 bl-border bl-border-gray-300 bl-shadow-sm bl-text-xs bl-font-medium bl-rounded bl-text-gray-700 bl-bg-white hover:bl-bg-gray-50 focus:bl-outline-none"
                    >
                        <x-heroicon-o-arrow-up-on-square class="bl-mr-1 bl-h-4 bl-w-4"/>
                        {{ __('Upload Image') }}
                    </button>
                @endif

            </div>
            <input
                id="postImage"
                class="bl-hidden"
                wire:model="image"
                type="file"
                accept="image/*"
            />
            @error('image')
            <p class="bl-form-error !bl--bottom-5"> {{ $message }}</p>
            @enderror
            @if ($image)
                <div class="bl-absolute !bl--bottom-5 bl-w-2/3">
                    <button
                        type="button"
                        wire:click="$set('image', null)"
                        class="bl-text-red-600 bl-font-semibold bl-flex bl-items-center bl-text-xs bl-ml-auto"
                    >
                        <x-heroicon-o-trash class="bl-mr-1 bl-h-4 bl-w-4"/>
                    </button>
                </div>
            @endif
        </div>


        <div class="bl-relative @error('content') error @enderror">
            <div wire:ignore>
                <label class="bl-form-label">Content</label>
                <textarea
                    class="ckeditor-- bl-form-control-- bl-min-h-fit bl-h-48 "
                    wire:model="content"
                    name="content"
                    id="message"
                ></textarea>
            </div>
            @error('content')
            <p class="bl-form-error"> {{ $message }}</p>
            @enderror
        </div>


        <div class="bl-flex bl-justify-end bl-space-x-4 bl-mt-6">
            @if(!$post)
                <button
                    type="button"
                    class="bl-btn bl-btn-white bl-btn-sm"
                >Save draft
                </button>
            @else
                <button
                    type="button"
                    class="bl-btn bl-btn-red bl-btn-sm"
                >Delete
                </button>
            @endif
            <button
                wire:click="publish"
                wire:loading.attr="disabled"
                wire:click="publish"
                type="button"
                class="bl-btn bl-default-btn"
            >
                <span
                    class="mr-2"
                    wire:loading
                    wire:target="publish"
                >
                    <x-blog-livewire::loading-icon/>
                </span>
                Publish Post
            </button>
        </div>
    </form>
</div>


@push('scripts')
    {{--    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>--}}
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#message'), {
                ckfinder: {
                    {{--uploadUrl: '{{route('ckeditor.image-upload').'?_token='.csrf_token()}}',--}}
                },
            })
            .then(editor => {
                editor.setData('{!! $content !!}')
                editor.model.document.on('change:data', () => {
                @this.set('content', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });

        window.addEventListener('load', () => {
            // console.log("page is ready")
            // setInterval(() => {
            // @this.call('saveDraft')
            // }, 10000)
        })
    </script>
@endpush

