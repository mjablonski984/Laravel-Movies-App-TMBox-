<div>
   <div class="tv-info border-b border-gray-800 background-image" 
      style="background: linear-gradient(rgba(26, 32, 44,.9), rgba(26, 32, 44,.9)), url( {{{ $tvshow['backdrop_path'] }}})  no-repeat center/cover"
   >
      <div class="container mx-auto px-4 py-16 flex flex-col md:flex-row ">
         <div class="flex-none">
            <img src="{{ $tvshow['poster_path'] }}" alt="poster" class="w-64 lg:w-96">
         <ul class="flex items-center mt-4">
            @if ($tvshow['homepage'])
               <li>
                  <a href="{{ $tvshow['homepage'] }}" title="Website">
                     <svg class="fill-current text-gray-400 hover:text-white w-6" viewBox="0 0 496 512"><path d="M248 8C111.03 8 0 119.03 0 256s111.03 248 248 248 248-111.03 248-248S384.97 8 248 8zm82.29 357.6c-3.9 3.88-7.99 7.95-11.31 11.28-2.99 3-5.1 6.7-6.17 10.71-1.51 5.66-2.73 11.38-4.77 16.87l-17.39 46.85c-13.76 3-28 4.69-42.65 4.69v-27.38c1.69-12.62-7.64-36.26-22.63-51.25-6-6-9.37-14.14-9.37-22.63v-32.01c0-11.64-6.27-22.34-16.46-27.97-14.37-7.95-34.81-19.06-48.81-26.11-11.48-5.78-22.1-13.14-31.65-21.75l-.8-.72a114.792 114.792 0 01-18.06-20.74c-9.38-13.77-24.66-36.42-34.59-51.14 20.47-45.5 57.36-82.04 103.2-101.89l24.01 12.01C203.48 89.74 216 82.01 216 70.11v-11.3c7.99-1.29 16.12-2.11 24.39-2.42l28.3 28.3c6.25 6.25 6.25 16.38 0 22.63L264 112l-10.34 10.34c-3.12 3.12-3.12 8.19 0 11.31l4.69 4.69c3.12 3.12 3.12 8.19 0 11.31l-8 8a8.008 8.008 0 01-5.66 2.34h-8.99c-2.08 0-4.08.81-5.58 2.27l-9.92 9.65a8.008 8.008 0 00-1.58 9.31l15.59 31.19c2.66 5.32-1.21 11.58-7.15 11.58h-5.64c-1.93 0-3.79-.7-5.24-1.96l-9.28-8.06a16.017 16.017 0 00-15.55-3.1l-31.17 10.39a11.95 11.95 0 00-8.17 11.34c0 4.53 2.56 8.66 6.61 10.69l11.08 5.54c9.41 4.71 19.79 7.16 30.31 7.16s22.59 27.29 32 32h66.75c8.49 0 16.62 3.37 22.63 9.37l13.69 13.69a30.503 30.503 0 018.93 21.57 46.536 46.536 0 01-13.72 32.98zM417 274.25c-5.79-1.45-10.84-5-14.15-9.97l-17.98-26.97a23.97 23.97 0 010-26.62l19.59-29.38c2.32-3.47 5.5-6.29 9.24-8.15l12.98-6.49C440.2 193.59 448 223.87 448 256c0 8.67-.74 17.16-1.82 25.54L417 274.25z"/></svg>
                  </a>
               </li>
            @endif
            @if ($tvshow['social']['facebook'])
               <li class="ml-6">
                  <a href="{{ $tvshow['social']['facebook'] }}" title="Facebook">
                     <svg class="fill-current text-gray-400 hover:text-white w-6" viewBox="0 0 448 512"><path d="M448 56.7v398.5c0 13.7-11.1 24.7-24.7 24.7H309.1V306.5h58.2l8.7-67.6h-67v-43.2c0-19.6 5.4-32.9 33.5-32.9h35.8v-60.5c-6.2-.8-27.4-2.7-52.2-2.7-51.6 0-87 31.5-87 89.4v49.9h-58.4v67.6h58.4V480H24.7C11.1 480 0 468.9 0 455.3V56.7C0 43.1 11.1 32 24.7 32h398.5c13.7 0 24.8 11.1 24.8 24.7z"/></svg>
                  </a>
               </li>
            @endif
            @if ($tvshow['social']['instagram'])
               <li class="ml-6">
                  <a href="{{ $tvshow['social']['instagram'] }}" title="Instagram">
                     <svg class="fill-current text-gray-400 hover:text-white w-6" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg>
                  </a>
               </li>
            @endif
            @if ($tvshow['social']['twitter'])
               <li class="ml-6">
                  <a href="{{ $tvshow['social']['twitter'] }}" title="Twitter">
                     <svg class="fill-current text-gray-400 hover:text-white w-6" viewBox="0 0 512 512"><path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/></svg>
                  </a>
               </li>
            @endif
         </ul>
         </div>
         <div class="md:ml-24">
            <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ $tvshow['name'] }}</h2>
            <div class="flex flex-wrap items-center text-gray-400 text-sm">
               <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
               <span class="ml-1">{{ $tvshow['vote_average'] }}</span>
               @if($tvshow['first_air_date'])
               <span class="mx-2">|</span>
               <span>{{ $tvshow['first_air_date'] }}</span>
               @endif
               @if($tvshow['in_production'])
               <span class="mx-2">|</span>
               <span>In Production</span>
               @endif
               @if($tvshow['genres'] != '')
                <span class="mx-2">|</span>
                <span>{{ $tvshow['genres'] }}</span>
               @endif
            </div>

            <p class="text-gray-300 mt-8">
               {{ $tvshow['overview'] }}
            </p>

            <div class="mt-12">
               <div class="flex mt-4">
                  @foreach ($tvshow['created_by'] as $crew)
                     <div class="mr-8">
                        <div>{{ $crew['name'] }}</div>
                        <div class="text-sm text-gray-400">Creator</div>
                     </div>
                  @endforeach
               </div>
            </div>

            <div class="mt-12">
               <h4 class="text-white font-semibold">Seasons & Episodes</h4>
               <div class="flex flex-wrap text-gray-400">
                  @if($tvshow['status'])
                  <div class="mr-8 mt-4">
                     <h4 class="text-white ">Status</h4>
                     <div class="text-sm text-gray-400">{{ $tvshow['status'] }}</div>
                  </div>
                  @endif
                  @if($tvshow['number_of_seasons'])
                  <div class="mr-8 mt-4">
                     <h4 class="text-white ">Seasons</h4>
                     <div class="text-sm text-gray-400">{{ $tvshow['number_of_seasons'] }}</div>
                  </div>
                  @endif
                  @if($tvshow['number_of_episodes'])
                  <div class="mr-8 mt-4">
                     <h4 class="text-white ">Episodes</h4>
                     <div class="text-sm text-gray-400">{{ $tvshow['number_of_episodes'] }}</div>
                  </div>
                  @endif
               </div>
            </div>
            <div class="mt-12">
               <h4 class="text-white font-semibold">Production & Languages</h4>
               <div class="flex flex-wrap text-gray-400">
                  @if($tvshow['original_name'])
                  <div class="mr-8 mt-4">
                     <h4 class="text-white ">Original title</h4>
                     <div class="text-sm text-gray-400">{{ $tvshow['original_name'] }}</div>
                  </div>
                  @endif
                  @if($tvshow['production_countries'])
                  <div class="mr-8 mt-4">
                     <h4 class="text-white ">Production countries</h4>
                     <div class="text-sm text-gray-400">{{ $tvshow['production_countries'] }}</div>
                  </div>
                  @endif
                  @if($tvshow['spoken_languages'])
                  <div class="mr-8 mt-4">
                     <h4 class="text-white ">Languages</h4>
                     <div class="text-sm text-gray-400">{{ $tvshow['spoken_languages'] }}</div>
                  </div>
                  @endif
               </div>
            </div>
            <!-- Keywords -->
            @if(count($tvshow['keywords']) > 0)
            <div class="mt-12">
                <h4 class="text-white font-semibold">Keywords</h4>
                <ul>
                    <div class="flex flex-wrap mt-4">
                        @foreach ($tvshow['keywords'] as $keyword)
                        <li><a class="inline-block border border-gray-300 text-gray-400 rounded-md px-4 py-2 mr-2 mt-2 transition duration-500 ease select-none hover:bg-gray-300 hover:text-gray-900 focus:outline-none focus:shadow-outline"
                             href="{{ route('tv.discover.index', ['keywordId'=>$keyword['id'],'keywordName'=>'keyword '.$keyword['name']])}}">{{$keyword['name']}}</a>
                        </li>
                        @endforeach 
                    </div>
                </ul>
            </div>
            @endif
            <!-- Trailer -->
            <div x-data="{ isOpen: false }">
               @if (count($tvshow['videos']['results']) > 0)
                  <div class="mt-12">
                     <button
                        @click="isOpen = true"
                        class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150"
                     >
                        <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                        <span class="ml-2">Play Trailer</span>
                     </button>
                  </div>

                  <template x-if="isOpen">
                     <div style="background-color: rgba(0, 0, 0, .5);" class="z-10 fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                           <div class="bg-gray-900 rounded">
                              <div class="flex justify-end pr-4 pt-2">
                                 <button
                                    @click="isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300">&times;
                                 </button>
                              </div>
                              <div class="modal-body px-8 py-8">
                                 <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                    <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $tvshow['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </template>
               @endif
            </div>
         </div>
      </div>
   </div> <!-- end tv-info -->
   
   <!-- tv-cast -->
   @if(count($tvshow['cast']) > 1)
   <div class="tv-cast border-b border-gray-800">
      <div class="container mx-auto px-4 py-16">
      <h2 class="text-3xl font-semibold mb-8">Cast</h2>
      <div x-data="{swiper: null}"
         x-init="swiper = new Swiper($refs.container, swiperSetup({{count($tvshow['cast'])}}) )"
         class="relative mx-auto flex flex-row">
      
         <livewire:components.swiper-buttons :icon="'prev'" >

         <div class="swiper-container" x-ref="container">
            <div class="swiper-wrapper">
               @foreach ($tvshow['cast'] as $cast)
               <div class="swiper-slide">
                  <a href="{{ route('actors.show', $cast['id']) }}" class="block w-full max-w-full sm:max-w-64 mx-auto  text-center">
                     <img src="{{ $cast['profile_path'] }}" alt="actor" class="block w-full hover:opacity-75 transition ease-in-out duration-150">
                  </a>
                  <div class="mt-2 w-full max-w-full sm:max-w-64 mx-auto">
                     <a href="{{ route('actors.show', $cast['id']) }}" class="text-lg mt-2 hover:text-gray:300">{{ $cast['name'] }}</a>
                     <div class="text-sm text-gray-400">
                        {{ $cast['character'] }}
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
         <livewire:components.swiper-buttons :icon="'next'" >
               
         </div>
      </div>
   </div>
   @endif <!-- end tv-cast -->
   
   <!-- tv-images -->
   @if(count($tvshow['images']) > 1)
   <div class="tv-images border-b border-gray-800">
      <div class="container mx-auto px-4 py-16" >
         <h2 class="text-3xl font-semibold">Images</h2>
         <div x-data="{swiper: null, isOpen: false, image: '',}" 
               x-init="swiper = new Swiper($refs.container, swiperSetupForImages({{ count($tvshow['images']) }}))"
               class="relative mx-auto flex flex-row mt-8">
         
               <livewire:components.swiper-buttons :icon="'prev'" >

               <div class="swiper-container" x-ref="container">
                  <div class="swiper-wrapper">
                  <!-- Slides -->
                     @foreach ($tvshow['images'] as $image)
                     <div class="swiper-slide">
                        <div class="w-full mx-auto text-center">
                           <a href="" class="inline-block w-full sm:w-auto max-w-full sm:max-w-md"
                              @click.prevent="
                                 isOpen = true
                                 image='{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
                              "
                           >
                              <img src="{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}" alt="image" class="inline-block w-full hover:opacity-75 transition ease-in-out duration-150">
                           </a>
                        </div>
                     </div>                           
                     @endforeach
                  </div>
               </div>              
               <livewire:components.swiper-buttons :icon="'next'" >
               <!-- modal - images -->
               <div x-show="isOpen" style="background-color: rgba(0, 0, 0, .5);" class="z-10 fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto">
                  <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                     <div class="bg-gray-900 rounded">
                           <div class="flex justify-end pr-4 pt-2">
                              <button
                                 @click="isOpen = false"
                                 @keydown.escape.window="isOpen = false"
                                 class="text-3xl leading-none hover:text-gray-300">&times;
                              </button>
                           </div>
                           <div class="modal-body px-8 py-8">
                              <img :src="image" alt="poster">
                           </div>
                     </div>
                  </div>
               </div>
         </div>
      </div>
   </div>
   @endif <!-- end tv-images -->

   <!-- similar-shows -->
   @if(count($similarShows) > 1)
   <div class="container mx-auto px-4 py-16">
      <h2 class="text-3xl font-semibold">Similar TV Shows</h2>
      <div x-data="{swiper: null}"
         x-init="swiper = new Swiper($refs.container, swiperSetup({{count($similarShows)}}))"
         class="relative mx-auto flex flex-row">
   
         <livewire:components.swiper-buttons :icon="'prev'" >

         <div class="swiper-container" x-ref="container">
            <div class="swiper-wrapper">
            <!-- Slides -->
               @foreach ($similarShows as $tvshow)
               <div class="swiper-slide">
                  <livewire:components.tv-card :tvshow="$tvshow" :tvId="$tvshow['id']">
               </div>
               @endforeach
            </div>
         </div>
         
         <livewire:components.swiper-buttons :icon="'next'" >
      </div>
   </div>
   @endif<!-- end similar-movies -->
</div>
<!-- Add to prevent infScroll requests in the background -->
<script>if(infScroll) infScroll.destroy();</script> 