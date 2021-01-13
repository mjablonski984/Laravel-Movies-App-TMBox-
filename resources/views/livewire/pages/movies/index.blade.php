<div class="container mx-auto px-4 py-16">
  <nav class="container mx-auto items-center">
    <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold pb-6">Categories</h2>
      <ul class="scroll-container w-full flex overflow-x-scroll">
        @foreach ($genresList as $genre)
        <li class="flex-shrink-0 pb-2">
            <a href="{{ route('movies.discover.index', ['keywordId'=>$genre['id'],'keywordName'=>$genre['name']])}}"
            class="inline-block border border-gray-300 text-sm text-gray-400 rounded-md px-3 py-1 mr-2 transition duration-500 ease select-none hover:bg-gray-300 hover:text-gray-900 focus:outline-none focus:shadow-outline"
            >{{$genre['name']}}</a>
        </li>
        @endforeach
      </ul>
  </nav>
  <!-- swiper.js setup (swiperSetup) is included in the head scripts -->
  <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mt-16">Popular Movies</h2>
  <div x-data="{swiper: null}"
    x-init="swiper = new Swiper($refs.container, swiperSetup({{count($popularMovies)}}))"
    class="relative mx-auto flex flex-row">

    <!-- button - prev -->
    <livewire:components.swiper-buttons :icon="'prev'" >

    <div class="swiper-container" x-ref="container">
      <div class="swiper-wrapper">
        <!-- Slides -->
        @if($popularMovies)
          @foreach ($popularMovies as $movie)
          <div class="swiper-slide">
            <livewire:components.movie-card :movie="$movie" :movieId="$movie['id']" >
          </div>
          @endforeach
        @endif
      </div>
    </div>
    <!-- button - next -->
    <livewire:components.swiper-buttons :icon="'next'">

  </div> <!-- end pouplar-movies -->

  <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold mt-16">Now Playing</h2>
  <div x-data="{swiper: null}"
    x-init="swiper = new Swiper($refs.container, swiperSetup({{count($nowPlayingMovies)}}))"
    class="relative mx-auto flex flex-row">

    <livewire:components.swiper-buttons :icon="'prev'" >

    <div class="swiper-container" x-ref="container">
      <div class="swiper-wrapper">
        
        @if($nowPlayingMovies)
          @foreach ($nowPlayingMovies as $movie)
          <div class="swiper-slide">
            <livewire:components.movie-card :movie="$movie" :movieId="$movie['id']" >
          </div>
          @endforeach
        @endif
      </div>
    </div>

    <livewire:components.swiper-buttons :icon="'next'" >

  </div> <!-- end now-playing-movies --> 
  
  <!-- Added to prevent infScroll in the background -->
  <script>if(infScroll) infScroll.destroy();</script> 
</div>