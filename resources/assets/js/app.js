require('./bootstrap');
window.Vue = require('vue');

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

require('../js/jquery.scrollbar.min.js');

$(document).ready(function() {
    // settings menu
    $('.js-settings').click(function(e) {
        e.preventDefault();

        $('.app').toggleClass('active-settings');
        $(this).toggleClass('active');
    });

    // news menu
    $('.js-news').click(function(e) {
        e.preventDefault();

        $('.app').toggleClass('active-news');
        $(this).toggleClass('active');
    });

    // close popup
    $('.js-closePopup').click(function(e) {
        e.preventDefault();

        $(this).parent().removeClass('active');
        $('.popup').removeClass('active');
    });

    //check real length
    //require('../js/dragula.min.js');
    dragula([document.getElementById("left-lovehandles"), document.getElementById("right-lovehandles")], {
        moves: function (el, container, handle) {
            return handle.classList.contains('handle');
        }
    })
    .on('drop', function (el) {
        el.className += ' dropped';
        // if($("#right-lovehandles .house-item").hasClass("dropped")){
        //     $("#right-lovehandles .house-item.dropped").prependTo("#right-lovehandles");
        // };
        el.classList.remove('dropped');

        var housesWidth = $(".houses.drop").outerWidth();
        var housesWidth_ = 0;
        for(i=0; i<$(".houses.drop .house-item").length; i++) {
            housesWidth_ += $(".houses.drop .house-item").eq(i).outerWidth();
        }

        if(housesWidth_ > $(window).width()){
            $(".houses.drop").attr("style", "width: "+ housesWidth_ +"px;");
        } else {
            $(".houses.drop").attr("style", "width: 100%;");
        }
    });

    // footer list sorting
    footerListSort();

    // footer buttons actions (info popup and featured)
    footerButtonsActions();

    newsResize();

    // jquery scrollbar
    $('.scrollbar').scrollbar({
        "scrollx": $('.scrollbar_x')
    });
});

$(window).resize(function() {
    newsResize();
});

function footerListSort() {
    $("body").on("click", ".js-listSort a", function(e) {
        e.preventDefault();
        $('.js-listSort a').addClass("active");
        $(this).toggleClass('active');

        if($(this).hasClass('new')) {
            $(".footer section").removeClass("show");
            $(".footer .new-active").addClass("show");
        }

        if($(this).hasClass('built')) {
            $(".footer section").removeClass("show");
            $(".footer .buld-active-block").addClass("show");
            $(".buld-active-block .house-item").remove()
            $(".houses.drop .house-item").clone().appendTo(".buld-active-block.show")
        }

        if($(this).hasClass('featured')) {
            $(".footer section").removeClass("show");
            $(".footer .featured-active-block").addClass("show");
            $(".featured-active-block").find(".house-item").remove()
//            $(".houses").find(".house-item.active-featured").clone().appendTo(".featured-active-block");
            $(".buld-active-block").find(".house-item.active-featured").clone().appendTo(".featured-active-block");
            $(".new-active").find(".house-item.active-featured").clone().appendTo(".featured-active-block");
        }
    })
}

function footerButtonsActions() {
    $("body").on("click", ".js-footerButtons .featured", function(e) {
        e.preventDefault();

        $(this).toggleClass('active');
        var featuredItem = $(this).parents('house-item');
        featuredItem.addClass('featured');
        $(this).parent(".footer-buttons").parent("header").parent(".house-item").toggleClass("active-featured")
    });

    $('.js-footerButtons .info').click(function(e) {
        e.preventDefault();
    });
}

function newsResize() {
    var windowWidth = $(window).width();

    if(windowWidth < 768) {
        $('.js-news').next().css('width', (windowWidth - 70));
    } else {
        $('.js-news').next().attr('style', '');
    }
}

