<div class="container mx-auto px-4 py-16">
    <nav class="container mx-auto items-center">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold pb-6">Categories</h2>
        <ul class="scroll-container w-full flex overflow-x-scroll">
            @foreach ($genresList as $genre)
            <li class="flex-shrink-0 pb-2">
                <a href="{{ route('tv.discover.index', ['keywordId'=>$genre['id'],'keywordName'=>$genre['name']])}}"
                class="inline-block border border-gray-300 text-sm text-gray-400 rounded-md px-3 py-1 mr-2 transition duration-500 ease select-none hover:bg-gray-300 hover:text-gray-900 focus:outline-none focus:shadow-outline"
                >{{$genre['name']}}</a>
            </li>
            @endforeach
        </ul>
    </nav>
    <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mt-16">Popular Shows</h2>
    <div x-data="{swiper: null}" 
        x-init="swiper = new Swiper($refs.container, swiperSetup({{count($popularTv)}}))"
        class="relative mx-auto flex flex-row">

        <!-- button - prev -->
        <livewire:components.swiper-buttons :icon="'prev'" >

        <div class="swiper-container" x-ref="container">
            <div class="swiper-wrapper">
                <!-- Slides -->
                @if($popularTv)
                    @foreach ($popularTv as $tvshow)
                    <div class="swiper-slide">
                        <livewire:components.tv-card :tvshow="$tvshow" :tvId="$tvshow['id']">
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
        <!-- button - next -->
        <livewire:components.swiper-buttons :icon="'next'">
            
    </div>  <!-- end popular-tv -->

    <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mt-16">Top Rated Shows</h2>
    <div x-data="{swiper: null}"
        x-init="swiper = new Swiper($refs.container, swiperSetup({{count($topRatedTv)}}))"
        class="relative mx-auto flex flex-row">

        <livewire:components.swiper-buttons :icon="'prev'" >

        <div class="swiper-container" x-ref="container">
        <div class="swiper-wrapper">
            <!-- Slides -->
            @if($topRatedTv)
                @foreach ($topRatedTv as $tvshow)
                <div class="swiper-slide">
                    <livewire:components.tv-card :tvshow="$tvshow" :tvId="$tvshow['id']">
                </div>
                @endforeach
            @endif
        </div>
        </div>
        
        <livewire:components.swiper-buttons :icon="'next'" >
    </div> <!-- end top-rated-shows -->
    
    <!-- Added to prevent infScroll in the background  -->
    <script>if(infScroll) infScroll.destroy();</script> 
</div>