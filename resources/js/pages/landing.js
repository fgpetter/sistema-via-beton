/*
Template Name: Tailwick - Admin & Dashboard Template
Author: Themesdesign
Version: 2.0.0
Website: https://themesdesign.in/
Contact: themesdesign.in@gmail.com
File: apps ecommerce order Js File
*/


import "swiper/css/bundle";
import Swiper from "swiper/bundle";

var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    loop: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    breakpoints: {
        1440: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 40,
        },
        375: {
            slidesPerView: 1,
            spaceBetween: 50,
        },
    },
});