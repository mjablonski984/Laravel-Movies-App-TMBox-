const swiperSetup = (numberOfSlides) => {
    return {
        slidesPerView: 2,
        loop: true, 
        spaceBetween: 20,
        centerInsufficientSlides: true,
                      
        breakpoints: {
            640: {
                slidesPerView: numberOfSlides < 2 ? numberOfSlides : 2,
            },
            768: {
                slidesPerView: numberOfSlides < 3 ? numberOfSlides : 3,
            },
            1024: {
                slidesPerView: numberOfSlides < 4 ? numberOfSlides : 4,
            },
            1280: {
                slidesPerView: numberOfSlides < 5 ? numberOfSlides : 5,
            },
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },      
    }
};

const swiperSetupForImages = (numberOfSlides) => {
    return {
        slidesPerView: 1,
        loop: true,
        spaceBetween: 20,
        centerInsufficientSlides: true,
                       
        breakpoints: {
            640: {
                slidesPerView: numberOfSlides < 2 ? numberOfSlides : 2,
            },
            768: {
                slidesPerView: numberOfSlides < 3 ? numberOfSlides : 3,
            },
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false
        },   
    }
};