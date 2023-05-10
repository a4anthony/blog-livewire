<div>
    <x-blog-livewire::header
        :categories="$categories"
        :category="$category"
        :length="$length"
    />


    <div class="bl-min-h-screen bl-py-16 sm:bl-py-24 bl-wrapper bl-bg-white">

		<span class="bl-text-sm bl-font-semibold bl-text-gray-600">
			Showing {{ $posts->firstItem() }} - {{ $posts->lastItem() }} of {{ $posts->total() }} articles
		</span>

        <div class="bl-mt-4 bl-mx-auto bl-grid bl-max-w-2xl bl-grid-cols-1 bl-gap-y-20 bl-gap-x-12 lg:bl-mx-0 lg:bl-max-w-none lg:bl-grid-cols-3">
            @foreach($posts as $post)
                <x-blog-livewire::post-card :post="$post" :category="$category"/>
            @endforeach
        </div>
    </div>



    <div class="bl-mt-20 bl-flex bl-justify-center">
        <button
            type="button"
            wire:click="loadMore"
            @disabled($posts->lastItem() === $posts->total())
            class="bl-bg-white hover:bl-bg-bg-gray-300 hover:bl-shadow-xl bl-animate bl-border bl-border-gray-300 bl-text-gray-700 bl-text-sm bl-px-8 bl-py-3 bl-rounded-3xl bl-font-medium"
        >Load more...
        </button>
    </div>
</div>
