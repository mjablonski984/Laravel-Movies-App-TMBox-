<div class="container mx-auto px-4 py-16 min-h-screen">
    <nav class="container mx-auto items-center ">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold pb-6">Categories</h2>
        <ul class="scroll-container w-full flex overflow-x-scroll">
            @foreach ($genresList as $genre)
            <li class="flex-shrink-0 pb-2">
                <a href="{{ route('tv.discover.index', ['keywordId'=>$genre['id'],'keywordName'=>$genre['name']])}}"
                class="inline-block border border-gray-300 text-sm text-gray-400 rounded-md px-3 py-1 mr-2 transition duration-500 ease select-none hover:bg-gray-300 hover:text-gray-900 focus:outline-none focus:shadow-outline
                {{ $genre['id'] == $keywordId ? 'border-orange-500 text-orange-500 hover:text-orange-400 hover:bg-gray-800' : 'hover:text-gray-300' }}"
                >{{$genre['name']}}</a>
            </li>
            @endforeach
        </ul>
    </nav>

    <div class="discover-tvshows mt-16">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Discover Shows : {{str_replace('keyword ','', $keywordName)}}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
        @foreach ($tvshows as $tvshow)
            <livewire:components.tv-card :tvshow="$tvshow" :tvId="$tvshow['id']">
        @endforeach
        </div>
    </div><!-- end discover-tvshows -->

    <!-- status indicator for infinite-scroll -->
    <div class="page-load-status py-8">
        <div class="flex justify-center">
            <!--use tailwind scroller - add &nbsp to display spinner-->
            <div class="infinite-scroll-request spinner py-8 text-4xl hidden"></div>
        </div>
        <p class="infinite-scroll-last py-4"></p>
    </div>

    <script>
        if(infScroll) infScroll.destroy();
        var tvElem = document.querySelector('.grid'); //where to append
        var infScroll = new InfiniteScroll( tvElem, {
            path: '/tv/discover/{{$keywordId}}/{{$keywordName}}/@{{#}}', // {js param - escape with @
            append: '.tvshow', //what to append (class in tv-card component)
            status: '.page-load-status',
            scrollThreshold: 100,
            history: 'push',
            //   history: false, // shows current page in url if true (default)
        });
        infScroll.pageIndex = parseInt('{{$page}}'); // update page number
        infScroll.on( 'request', () => document.querySelector('.infinite-scroll-request').innerHTML = '&nbsp;');
        infScroll.on( 'last', () => document.querySelector('.infinite-scroll-last').innerHTML = 'End of content');
    </script>
</div>