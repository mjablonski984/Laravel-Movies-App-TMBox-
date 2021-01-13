<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <!-- Set aplinejs component scope x-data: set isOpen to true/  when clicking away/outside container set isOpen to false
    -x-ref adds name search for use in keydown.window event listener (listening for press on '/')
    -wire:model has the same role as v-model in vue (debunce is used to delay search -reduces number of api call) 
    - on pressing escape btn or shift+tab close dropdown - on focus reopen dropdown
    -->
    <input
        wire:model.debounce.500ms="search"
        type="text"
        class="bg-gray-800 text-sm rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline" placeholder="Search (Press '/' to focus)"
        x-ref="search"
        @keydown.window="
            if (event.keyCode === 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
    >
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
    </div>

    <!-- Spinner from spinner css pluggin / Use wire:loading atribute to show only when loading resourece -->
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>

    <!-- Alpine.js x-show works like v-if , "isOpen" is true show dropdown else hide -->
    <!-- @keydown.tab="isOpen = false"  - close list when tab from last list item -->
    
    @if (strlen($search) >= 2)
        <div class="absolute z-50 bg-gray-800 text-sm rounded w-64 mt-4"
        x-show.transition.opacity="isOpen"
        >
            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                    
                        <li class="border-b border-gray-700">
                            @if($result['media_type'] == 'movie')
                            <a href="{{ route('movies.show', $result['id']) }}" class="block hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out duration-150"
                                @if ($loop->last) @keydown.tab="isOpen = false" @endif
                            >
                            @elseif($result['media_type'] == 'tv')
                            <a href="{{ route('tv.show', $result['id']) }}" class="block hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out duration-150"
                                @if ($loop->last) @keydown.tab="isOpen = false" @endif
                            >
                            @elseif($result['media_type'] == 'person')
                            <a href="{{ route('actors.show', $result['id']) }}" class="block hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out duration-150"
                                @if ($loop->last) @keydown.tab="isOpen = false" @endif
                            >
                            @endif

                            @if (isset($result['poster_path']))
                                <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster" class="w-8">
                            @elseif (isset($result['profile_path']))
                                <img src="https://image.tmdb.org/t/p/w92/{{ $result['profile_path'] }}" alt="poster" class="w-8">
                            @else
                                <img src="/images/placeholder185x278-dark.png" alt="poster" class="w-8">
                            @endif
                            
                            @if (isset($result['title']))
                                <span class="ml-4">{{ $result['title'] }}</span>
                            @elseif (isset($result['name']))
                                <span class="ml-4">{{ $result['name'] }}</span>
                            @endif
                        </a>
                        </li>
                    @endforeach

                </ul>
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
        </div>
    @endif
</div>