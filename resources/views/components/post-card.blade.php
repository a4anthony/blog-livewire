@props(['post', 'category'])
<article class="bl-flex bl-flex-col bl-items-start bl-justify-between">
    <div class="bl-relative bl-w-full">
        <img
            src="{{ $post->image }}"
            alt=""
            class="bl-aspect-[16/9] bl-w-full bl-rounded-2xl bl-bg-gray-100 bl-object-cover sm:bl-aspect-[2/1] lg:bl-aspect-[3/2]"
        >
        <div class="bl-absolute bl-inset-0 bl-rounded-2xl bl-ring-1 bl-ring-inset bl-ring-gray-900/10"></div>
    </div>
    <div class="bl-max-w-xl">
        <div class="bl-mt-8 bl-flex bl-items-center bl-gap-x-2 bl-text-xs">
            <time
                datetime="2020-03-16"
                class="bl-text-gray-500"
            >{{ Carbon\Carbon::parse($post->published_at)->format('M j, Y') }}  </time>
            <a
                href="{{ route(config('blog-livewire.blog_category_posts_route'), ['categorySlug'=>$post->category->slug, 'postSlug'=>$post->slug]) }}"
                class="bl-relative bl-z-10 bl-rounded-full bl-bg-gray-50 bl-py-1.5 bl-px-3 bl-font-medium bl-text-gray-600 hover:bl-bg-gray-100"
            >{{ $post->category->name }}</a>
            @if($post->has_practice)
                <span
                    class="bl-relative bl-z-10 bl-inline-flex bl-items-center bl-rounded-full bl-bg-green-50 bl-py-1.5 bl-px-3 bl-font-medium bl-text-green-600"
                >
									<x-heroicon-s-check-circle class="bl-w-4 bl-h-4 bl-mr-1 bl-text-green-500"/> Practice quiz
								</span>
            @endif
        </div>
        <div class="bl-group bl-relative">
            <h3 class="bl-mt-3 bl-text-lg bl-font-semibold bl-leading-6 bl-text-gray-900 group-hover:bl-text-gray-600 bl-h-12">
                <a href="{{ route(config('blog-livewire.blog_show_route'), [$post->slug]) }}">
                    <span class="bl-absolute bl-inset-0"></span>
                    {{ $post->title }}
                </a>
            </h3>
            <p class="bl-mt-5 bl-text-sm bl-leading-6 bl-text-gray-600 bl-line-clamp-3">{!!  $post->content !!}</p>
        </div>
        <div class="bl-relative bl-mt-8 bl-flex bl-items-center bl-gap-x-2">
            <img
                src="{{ $post->author_avatar }}"
                alt=""
                class="bl-h-8 bl-w-8 bl-rounded-full bl-bg-gray-100"
            >
            <div class="bl-text-sm bl-leading-6">
                <p class="bl-font-semibold bl-text-gray-900">
                    <a href="#">
                        <span class="bl-absolute bl-inset-0"></span>
                        {{ $post->author }}
                    </a>
                </p>
            </div>
        </div>
    </div>
</article>
