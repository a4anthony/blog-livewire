@props(['categories', 'category'])

<div>
    <div class="bl-border-b bl-py-8 sm:bl-py-12 bl-text-center bl-bg-white">
        <div class="bl-px-4 bl-max-w-7xl bl-mx-auto">
            <div class="bl-max-w-xl bl-mx-auto">
                <h1 class="bl-text-2xl sm:bl-text-4xl bl-font-extrabold bl-mb-3">Our Blog</h1>
                <p class="bl-text-sm sm:bl-text-base bl-text-gray-500">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus beatae deleniti ducimus eaque iusto laborum nesciunt quis quod velit voluptate.
                </p>
            </div>


            <div
                x-data="{ selected: '{{ $category }}' }"
                class="bl-flex bl-gap-4 bl-mt-10 bl-justify-center bl-flex-wrap"
            >
                @foreach($categories as $cat)
                    <button
                        x-init="() => console.log(selected)"
                        x-data="{ show: false }"
                        @click="() => {
                                            $wire.setCategory('{{$cat['slug']}}').then(() => {
                                                console.log(selected)
                                                show = selected === '{{$cat['slug']}}';
                                                selected = '{{$cat['slug']}}';
                                                console.log(selected)
                                            })
                                       }"
                        type="button"
                        class="bl-relative bl-bg-violet-100 bl-flex bl-rounded-3xl bl-py-2 bl-px-8 bl-text-sm bl-border-2 bl-border-transparent bl-shadow-sm hover:bl-border-violet-500 bl-animate hover:bl-shadow-lg"
                    >
                        <x-heroicon-s-check-circle
                            style="display: none"
                            x-show="selected === '{{$cat['slug']}}'"
                            class="bl-w-5 bl-h-5 bl-text-violet-500 bl-absolute bl-left-1.5"
                        />
                        <span class="bl-inline-block">{{$cat['name']}}</span>
                    </button>
                @endforeach
            </div>

            <div class="bl-max-w-xl bl-mx-auto bl-mt-10">
                <form action="">
                    <div class="bl-flex bl-space-x-2">
                        <input
                            type="text"
                            class="bl-rounded-3xl bl-flex-grow bl-border-gray-300 bl-border !bl-py-3 !bl-px-5 bl-text-sm"
                            placeholder="Search for more content..."
                        >
                        <button
                            type="submit"
                            class="bl-flex-none bl-font-medium bl-bg-violet-700 hover:bl-bg-violet-600 bl-animate bl-text-white bl-text-sm bl-px-4 sm:bl-px-6 bl-rounded-3xl"
                        >
                            <span class="bl-block sm:bl-hidden"><x-heroicon-o-magnifying-glass class="w-5 h-5"/></span>
                            <span class="bl-hidden sm:bl-block">Search</span>
                        </button>
                    </div>
                    <div class="bl-mt-4">
                        <div class="bl-relative bl-flex bl-items-start">
                            <div class="bl-flex bl-h-6 bl-items-center">
                                <input
                                    id="comments"
                                    aria-describedby="comments-description"
                                    name="comments"
                                    type="checkbox"
                                    wire:model="hasPractice"
                                    class="bl-h-4 bl-w-4 bl-rounded bl-border-gray-300 bl-text-indigo-600 focus:bl-ring-indigo-600"
                                >
                            </div>
                            <div class="bl-ml-3 bl-text-sm bl-leading-6">
                                <label
                                    for="comments"
                                    class="bl-font-medium bl-text-gray-900"
                                >Articles with practice quiz only</label>
                                <span
                                    id="comments-description"
                                    class="bl-text-gray-500"
                                ><span class="bl-sr-only">Articles with practice quiz only </span></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
