<div class="container mx-auto px-4 py-16">
    <div class="popular-actors">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Actors</h2>
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($popularActors as $actor)
                <div class="actor mt-8">
                    <a href="{{ route('actors.show', $actor['id']) }}">
                        <img src="{{ $actor['profile_path'] }}" alt="profile image" class="hover:opacity-75 transition ease-in-out duration-150">
                    </a>
                    <div class="mt-2">
                        <a href="{{ route('actors.show', $actor['id']) }}" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                        <div class="text-sm truncate text-gray-400">{{ $actor['known_for'] }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div> <!-- end popular-actors -->

    <!-- status indicator for infinite-scroll -->
    <div class="page-load-status py-8">
        <div class="flex justify-center">
            <!--use tailwind scroller - add &nbsp to display spinner-->
            <div class="infinite-scroll-request spinner py-8 text-4xl hidden"></div>
        </div>
        <p class="infinite-scroll-last py-4"></p>
    </div>

    {{-- <!-- Pagination (can be used in place of InfiniteScroll)--> --}}
    {{-- <div class="flex justify-between mt-16">
        @if ($previous)
            <a href="/actors/page/{{ $previous }}">Previous</a>
        @else
            <div></div>
        @endif
        @if ($next)
            <a href="/actors/page/{{ $next }}">Next</a>
        @else
            <div></div>
        @endif
    </div> --}}

    <script>
        if(infScroll) infScroll.destroy(); // destroy previous instance of infScroll
        var elem = document.querySelector('.grid'); // where to append
        var infScroll = new InfiniteScroll( elem, {
        path: '/actors/page/@{{#}}', // {js param - escape with @
        append: '.actor', //what to append (div with class actor)
        status: '.page-load-status',
        //   history: false, // shows current page in url if true (default)
        });
        infScroll.on( 'request', () => document.querySelector('.infinite-scroll-request').innerHTML = '&nbsp;');
        infScroll.on( 'last', () => document.querySelector('.infinite-scroll-last').innerHTML = 'End of content');
    </script>
</div>
