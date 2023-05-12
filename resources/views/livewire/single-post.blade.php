<div class="bl-py-12 sm:bl-py-20 bl-max-w-7xl bl-mx-auto bl-px-6">
    <div class="bl-max-w-4xl bl-mx-auto">
        <img
            src="{{ $post->image }}"
            alt=""
            class="bl-aspect-[16/9] bl-w-full bl-rounded-2xl bl-bg-gray-100 bl-object-cover sm:bl-aspect-[2/1] lg:bl-aspect-[3/2]"
        >


        <div class="bl-mt-6 sm:bl-mt-10">
            <ul class="bl-flex bl-items-center bl-space-x-3 bl-text-sm bl-text-gray-600">
                <li>
                    <a href="{{ route(config('blog-livewire.blog_index_route')) }}">Blog</a>
                </li>
                <li>></li>
                <li class="bl-font-semibold">{{ $post->category->name }}</li>
            </ul>
        </div>

        <h1 class="bl-mt-6 bl-text-2xl bl-font-bold bl-text-gray-900 sm:bl-text-3xl sm:bl-leading-10 lg:bl-text-4xl lg:bl-leading-none">
            {{ $post->title }}
        </h1>

        <div class="bl-relative bl-mt-8 bl-flex bl-items-center bl-gap-x-2">
            <img
                src="{{ $post->author_avatar }}"
                alt=""
                class="bl-h-6 bl-w-6 sm:bl-h-8 sm:bl-w-8 bl-rounded-full bl-bg-gray-100 "
            >
            <div class="bl-text-sm bl-leading-6 bl-flex bl-flex-wrap bl-items-center bl-gap-3 sm:bl-gap-4">
                <p class="bl-font-semibold bl-text-gray-900">
                    <a href="#">
                        <span class="bl-absolute bl-inset-0"></span>
                        {{ $post->author }}
                    </a>
                </p>
                <span class="bl-hidden sm:bl-block bl-w-1.5 bl-h-1.5 bl-bg-gray-400 bl-rounded-full"></span>
                <span class="bl-hidden sm:bl-block">{{ Carbon\Carbon::parse($post->published_at)->format('M j, Y') }}</span>
                <span class="bl-hidden sm:bl-block bl-w-1.5 bl-h-1.5 bl-bg-gray-400 bl-rounded-full"></span>
                <span class="bl-hidden sm:bl-block">{{ $post->read_time }}</span>
            </div>
        </div>
        <div class="bl-relative bl-mt-3 bl-flex sm:bl-hidden bl-items-center bl-gap-x-2">
            <div class="bl-text-xs bl-leading-6 bl-flex bl-flex-wrap bl-items-center bl-gap-3 sm:bl-gap-4">
                <span>{{ Carbon\Carbon::parse($post->published_at)->format('M j, Y') }}</span>
                <span class="bl-block bl-w-1.5 bl-h-1.5 bl-bg-gray-400 bl-rounded-full"></span>
                <span>{{ $post->read_time }}</span>
            </div>
        </div>

        <div>
            <p
                class="!bl-leading-8 bl-text-gray-800 bl-mt-6 sm:bl-mt-12 bl-text-base sm:bl-text-base bl-whitespace-pre-wrap bl-break-words"
            >{!! $post->content !!}</p>
        </div>


        @if(config('blog-livewire.has_single_post_ad') )
            <div class="bl-mt-16 bl-text-center bl-bg-violet-200 bl-rounded-lg bl-px-10 bl-py-12 bl-shadow-sm">
                <h1 class="bl-text-2xl sm:bl-text-3xl bl-font-bold bl-mb-4  bl-text-gray-800">{{ config('blog-livewire.single_post_ad.header') }}</h1>
                <p class="bl-max-w-lg bl-mx-auto bl-text-base sm:bl-text-lg bl-mb-10 bl-text-gray-700">
                    {{ config('blog-livewire.single_post_ad.sub_header') }}
                </p>
                <a
                    href="{{ route(config('blog-livewire.single_post_ad.link')) }}"
                    class="bl-btn-primary"
                >
                    {{ config('blog-livewire.single_post_ad.action') }}
                </a>
            </div>
        @endif

        <div class="bl-flex bl-mt-10 sm:bl-mt-16 bl-gap-3 sm:bl-gap-6">
            @if($post->has_practice && config('blog-livewire.project') === 'fluentnow' && config('blog-livewire.practice_quiz_show_route'))
                <a
                    class="bl-btn-outline"
                    href="{{ route(config('blog-livewire.practice_quiz_show_route'), ['vocabulary']) }}"
                >
                    <x-heroicon-o-bolt class="bl-w-5 bl-h-5 bl-mr-2"/>
                    Try practice quiz
                </a>
            @endif
            <button class="bl-btn-outline-gray">
                <x-heroicon-o-share class="bl-w-5 bl-h-5 bl-mr-2"/>
                Share
            </button>
        </div>
    </div>


    <div>
        <h1 class="bl-mt-24 bl-mb-6 bl-text-2xl bl-font-bold bl-text-gray-800 sm:bl-text-3xl sm:bl-leading-10 lg:bl-text-4xl lg:bl-leading-none">
            Read more
        </h1>
        <div class="bl-mt-4 bl-mx-auto bl-grid bl-max-w-2xl bl-grid-cols-1 bl-gap-y-16 bl-gap-x-6 lg:bl-mx-0 lg:bl-max-w-none lg:bl-grid-cols-3">
            @foreach($relatedPosts as $post)
                <x-blog-livewire::post-card :post="$post"/>
            @endforeach
        </div>
    </div>


</div>
