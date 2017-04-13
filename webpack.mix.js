const { mix } = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

/*mix.js(",resources/assets/js/app.js", ",public/js/app",)
   .sass(",resources/assets/sass/app.scss", ",public/css",);*/


mix.styles([
    "public/css/bootstrap.css",
    "public/css/icons.css",
    "public/css/typography.css",
    "public/css/scrollbar.css",
    "public/css/animate.css",
    "public/cloudslider/css/cloudslider.css",
    "public/css/cubeportfolio.css",
    "public/nivo-lightbox/nivo-lightbox.css",
    "public/nivo-lightbox/themes/default/default.css",
    "public/css/click-hover-effects.css",
    "public/owl-carousel/assets/owl.carousel.css",
    "public/owl-carousel/assets/owl.theme.default.min.css",
    "public/css/theme.css",
    "public/css/color.css"
],"public/customcss/all.css");


mix.scripts([
   "public/js/vendor/jquery.js",
    "public/js/vendor/bootstrap.js",
    "public/js/easing.js",
    "public/js/scrollbar.js",
    "public/js/retina.js",
    "public/js/raphael.js",
    "public/js/tabs.js",
    "public/js/livicons.js",
    "public/js/icheck.js",
    "public/js/mousewheel.js",
    "public/js/selectik.js",
    "public/js/spinedit.js",
    "public/js/wow.js",
    "public/js/hover-dropdown.js",
    "public/js/classie.js",
    "public/cloudslider/js/cloudslider.jquery.min.js",
    "public/cubeportfolio/js/jquery.cubeportfolio.js",
    "public/nivo-lightbox/nivo-lightbox.min.js",
    "public/js/appear.js",
    "public/js/pie-chart.js",
    "public/js/vide.js",
    "public/js/fitvids.js",
    "public/owl-carousel/owl.carousel.min.js",
    "public/js/jflickrfeed.js",
    "public/js/tweecool.js",
    "public/js/chart.js",
    "public/js/totop.js",
    "public/js/sm-scroll.js",
    "public/js/smooth-scroll.js",
    "public/js/ajaxchimp.js",
    "public/js/contact.js",
    "public/js/form.js",
    "public/js/validate.js",
    "public/js/tempo.js",
    "public/js/main.js"	
],"public/jss/bundled/vendorapplayout.js");

