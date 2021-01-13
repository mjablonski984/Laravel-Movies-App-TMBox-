@if($icon == 'next')
<div class="absolute inset-y-0 right-0 z-10 flex items-center">
    <button @click="swiper.slideNext()" style="background-color:rgba(26,32,44, 0.3);"
            class="border rounded-full text-white -mr-2 lg:-mr-4 flex justify-center items-center rounded-full shadow focus:outline-none hover:text-gray-300 transition ease-in-out duration-150">
        <svg id="icon-circle-right" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
            <path fill-rule="evenodd" d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zM12 21.75c-5.385 0-9.75-4.365-9.75-9.75s4.365-9.75 9.75-9.75 9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75z" clip-rule="evenodd"></path>
            <path fill-rule="evenodd" d="M8.314 16.564l2.121 2.121 6.686-6.686-6.686-6.686-2.121 2.121 4.564 4.564z" clip-rule="evenodd"></path>
        </svg>
    </button>
</div>
@elseif($icon == 'prev')
<div class="absolute inset-y-0 left-0 z-10 flex items-center">
    <button @click="swiper.slidePrev()" style="background-color:rgba(26,32,44, 0.3);"
            class="border rounded-full text-white -ml-2 lg:-ml-4 flex justify-center items-center rounded-full shadow focus:outline-none hover:text-gray-300 transition ease-in-out duration-150">
        <svg id="icon-circle-right" viewBox="0 0 24 24" fill="currentColor" class="w-10 h-10">
            <path fill-rule="evenodd" d="M12 24c6.627 0 12-5.373 12-12s-5.373-12-12-12-12 5.373-12 12 5.373 12 12 12zM12 2.25c5.385 0 9.75 4.365 9.75 9.75s-4.365 9.75-9.75 9.75-9.75-4.365-9.75-9.75 4.365-9.75 9.75-9.75z" clip-rule="evenodd"></path>
            <path fill-rule="evenodd" d="M15.686 7.436l-2.121-2.121-6.686 6.686 6.686 6.686 2.121-2.121-4.564-4.564z" clip-rule="evenodd"></path>
        </svg>
    </button>
</div>    
@endif