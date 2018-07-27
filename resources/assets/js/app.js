require('./bootstrap');
window.Vue = require('vue');

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

require('jquery.scrollbar');
$('.scrollbar').scrollbar({
	"scrollx": $('.scrollbar_x')
});

import * as dragula from "dragula";
dragula([document.getElementById("left-lovehandles"), document.getElementById("right-lovehandles")], {
    moves: function (el, container, handle) {
        return handle.classList.contains('handle');
    }
}).on('drop', function (el) {
    el.className += ' dropped';
    el.classList.remove('dropped');

    calculateHousesWidth();
    sendHousesState();
});

function calculateHousesWidth() {
    var housesWidth = $(".houses.drop").outerWidth();
    var housesWidth_ = 0;
    for(var i = 0; i < $(".houses.drop .house-item").length; i++) {
        housesWidth_ += $(".houses.drop .house-item").eq(i).outerWidth();
    }

    if (housesWidth_ > $(window).width()){
        $(".houses.drop").attr("style", "width: "+ housesWidth_ +"px;");
    } else {
        $(".houses.drop").attr("style", "width: 100%;");
    }
}

function sendHousesState() {
    var houses = [];
    $(".houses.drop .house-item").each(function(i) {
        houses.push({id: $(this).data('house-id'), position: i});
    });

    axios.post('/user/change-houses-state', {
        houses: houses
    }).then(function (response) {

        if (response.data === 1) {
            self.addClass('error');
        } else {
            console.log(response.data);

            $('.js-tmph').text(response.data.total_money_per_hour + ' per hour');
        }

    }).catch(function (error) {
        globalHandlerError(error.response);
    });
}

$(document).ready(function() {
    calculateHousesWidth();

    // settings menu
    $('.js-settings').click(function(e) {
        e.preventDefault();

        $('.app').toggleClass('active-settings');
        $(this).toggleClass('active');
    });

    // close popup
    $('.js-closePopup').click(function(e) {
        e.preventDefault();

        $(this).parent().removeClass('active');
        $('.popup').removeClass('active');
    });

    // footer list sorting
    footerListSort();

    // footer buttons actions (info popup and featured)
    footerButtonsActions();

    newsResize();
});

$(window).resize(function() {
	calculateHousesWidth();
    newsResize();
});

$(document).mouseup(function (e) {

	// close popup on click free space
	var popup = $('.popup > div');
	if(popup.has(e.target).length === 0 && !popup.is(e.target)) {
		popup.removeClass('active').parent().removeClass('active');
	}

	// close settings/news popup
	var settNewsPopup = $('.settings > div, .news > div'),
		settNewsButtons = $('.js-settings, .js-news');
	if(settNewsPopup.has(e.target).length === 0 && !settNewsPopup.is(e.target) && settNewsButtons.has(e.target).length === 0 && !settNewsButtons.is(e.target)) {
		$('.app').removeClass('active-news active-settings');
		settNewsButtons.removeClass('active');
	}
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
            $(".buld-active-block .house-item").remove();
            $(".houses.drop .house-item").clone().appendTo(".buld-active-block.show")
        }

        if($(this).hasClass('featured')) {
            $(".footer section").removeClass("show");
            $(".footer .featured-active-block").addClass("show");
            $(".featured-active-block").find(".house-item").remove();
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

