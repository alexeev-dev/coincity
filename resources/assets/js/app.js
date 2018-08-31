require('./bootstrap');
window.Vue = require('vue');

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

require('jquery.scrollbar');
$('.scrollbar').scrollbar({
	"scrollx": $('.scrollbar_x'),
    onScroll: function() {
        parallaxBackground();
        showHideScrollButtons();
    }
});

import * as dragula from "dragula";
const drag = dragula([document.getElementById("left-lovehandles"), document.getElementById("right-lovehandles")], {
    moves: function (el, container, handle) {
        return handle.classList.contains('handle') && !el.classList.contains('no-dnd');
    },
    accepts: function(el, target) {
        return !el.classList.contains('no-dnd')
    }
}).on('drop', function (el) {
    el.className += ' dropped user-house';
    el.classList.remove('dropped');

    calculateHousesWidth();
    sendHousesState();
});

window.odometerOptions = {
    format: '(.ddd)'
};

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
            $('.js-tmph').text(response.data.totalMoneyPerHour + ' per hour');

            if (response.data.timeLeft === 0) {
                $(".js-footerHouseItems .house-item:not('.user-house')").removeClass('no-dnd');
            } else {
                var countDate = new Date(new Date().getTime() + response.data.timeLeft * 1000);
                $('.js-adv-cd').countdown(countDate, function (event) {
                    $(this).html(event.strftime('%H:%M<span>:%S</span>'));
                });
                $(".js-footerHouseItems .house-item:not('.user-house')").addClass('no-dnd');
            }
        }

    }).catch(function (error) {
        globalHandlerError(error.response);
    });
}

$(document).ready(function() {
    calculateHousesWidth();
    parallaxBackground();

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

    // login popup
    $('.log-reg .login').click(function(e) {
        e.preventDefault();

        $('.popup-log-reg, .popup').addClass('active');
    });

    // footer list sorting
    footerListSort();

    // footer buttons actions (info popup and featured)
    footerButtonsActions();
    scrollToBuilt();
    scrollToFeatured();

    // scroll right/left buttons in houses section
    showHideScrollButtons();
    scrollHouses();

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
        $('.js-listSort a').removeClass("active");
        $(this).addClass('active');

        if ($(this).hasClass('new')) {
            $(".footer section").removeClass("show");
            $(".footer .new-active").addClass("show");
        }

        if ($(this).hasClass('built')) {
            $(".footer section").removeClass("show");
            $(".footer .buld-active-block").addClass("show");

            $(".buld-active-block .house-item").remove();
            $(".houses.drop .house-item").clone().appendTo(".buld-active-block.show");

            scrollToBuilt();
        }

        if ($(this).hasClass('featured')) {
            $(".footer section").removeClass("show");
            $(".footer .featured-active-block").addClass("show");

            $(".featured-active-block").find(".house-item").remove();
            $(".houses.drop").find(".house-item.house-featured").clone().appendTo(".featured-active-block");
            $(".new-active").find(".house-item.house-featured").clone().appendTo(".featured-active-block");

            scrollToFeatured();
        }
    })
}

function footerButtonsActions() {
    $("body").on("click", ".js-footerButtons .featured", function(e) {
        e.preventDefault();

        var houseID = $(this).parent(".footer-buttons").parent("header").parent(".house-item").attr('data-house-id');
        $('*[data-house-id="' + houseID + '"]').toggleClass('house-featured');
        $('*[data-house-id="' + houseID + '"]').find('.js-footerButtons').find('.featured').toggleClass('active');
    });

    $('.js-footerButtons .info').click(function(e) {
        e.preventDefault();
    });

    $('.js-footerShowHide').click(function(e) {
        e.preventDefault();

        $('.wr-houses').toggleClass('margin');
        $('.wr-footer').toggleClass('active');
    });
}

function newsResize() {
    var windowWidth = $(window).width();

    if(windowWidth < 768) {
        $('.js-news').next().css('width', (windowWidth - 30));
    } else {
        $('.js-news').next().attr('style', '');
    }
}

function isEmpty( el ){
  return !$.trim(el.html())
}

function scrollToFeatured() {
    if(isEmpty($('.featured-active-block.show'))) {
        return false;
    } else {
        $('.featured-active-block.show .house-item .footer-image').click(function(e) {
            e.preventDefault();

            var houseID = $(this).parent("section").parent(".house-item").attr('data-house-id'),
                houseScrollLeft = $('.wr-houses .houses *[data-house-id="' + houseID + '"]').position().left,
                houseWidth = $('.wr-houses .houses *[data-house-id="' + houseID + '"]').width(),
                housePaddingLeft = parseInt($('.wr-houses .houses *[data-house-id="' + houseID + '"]').css('padding-left')),
                windowWidth = $(window).width();

            $('.scrollbar.scroll-content').animate({scrollLeft: houseScrollLeft+housePaddingLeft+houseWidth/2-windowWidth/2}, 800);
        });
    }
}
function scrollToBuilt() {
    if(isEmpty($('.buld-active-block.show'))) {
        return false;
    } else {
        $('.buld-active-block.show .house-item .footer-image').click(function(e) {
            e.preventDefault();

            console.log('clicked');

            var houseID = $(this).parent("section").parent(".house-item").attr('data-house-id'),
                houseScrollLeft = $('.wr-houses .houses *[data-house-id="' + houseID + '"]').position().left,
                houseWidth = $('.wr-houses .houses *[data-house-id="' + houseID + '"]').width(),
                housePaddingLeft = parseInt($('.wr-houses .houses *[data-house-id="' + houseID + '"]').css('padding-left')),
                windowWidth = $(window).width();

            $('.scrollbar.scroll-content').animate({scrollLeft: houseScrollLeft+housePaddingLeft+houseWidth/2-windowWidth/2}, 800);
        });
    }
}

function showHideScrollButtons() {
    var windowWidth = $(window).width(),
        housesContainerWidth = $('.houses.drop').width(),
        currentScrollPosition = $('.scrollbar.scroll-content').scrollLeft();

    if(currentScrollPosition>0) {
        $('.js-scrollHouses.left').removeClass('disabled');
    } else {
        $('.js-scrollHouses.left').addClass('disabled');
    }
    if((currentScrollPosition + windowWidth) <= (Math.floor(housesContainerWidth) - 1)) {
        $('.js-scrollHouses.right').removeClass('disabled');
    } else {
        $('.js-scrollHouses.right').addClass('disabled');
    }
}
function scrollHouses() {

    $('.js-scrollHouses').click(function(e) {
        e.preventDefault();

        var this_ = $(this),
            housesContainerWidth = $('.houses.drop').width(),
            windowWidth = $(window).width(),
            currentScrollPosition = $('.scrollbar.scroll-content').scrollLeft(),
            widthToEnd = housesContainerWidth-currentScrollPosition-windowWidth,
            scrollAnimationTime = 800;

        if(this_.hasClass('right')) {
            if(widthToEnd<windowWidth) {
                $('.scrollbar.scroll-content').animate({scrollLeft: currentScrollPosition+widthToEnd}, scrollAnimationTime);
            } else {
                $('.scrollbar.scroll-content').animate({scrollLeft: currentScrollPosition+windowWidth}, scrollAnimationTime);
            }
        }

        if(this_.hasClass('left')) {
            if(currentScrollPosition<windowWidth) {
                $('.scrollbar.scroll-content').animate({scrollLeft: 0}, scrollAnimationTime);
            } else {
                $('.scrollbar.scroll-content').animate({scrollLeft: currentScrollPosition-windowWidth}, scrollAnimationTime);
            }
        }

        $(this_).addClass('inactive');

        setTimeout(function(){
            $(this_).removeClass('inactive');
        },scrollAnimationTime);
    });

}

// parallax mountain and lake
function parallaxBackground() {
    var windowWidth = $(window).width(),
        housesContainerWidth = $('.houses.drop').width(),
        parallaxLength = housesContainerWidth - windowWidth,
        currentScrollPosition = $('.scrollbar.scroll-content').scrollLeft();

        if(parallaxLength>100) {
            $('.parallax-mountain').css('transform','translate3d(' + -(50*currentScrollPosition/parallaxLength) + 'px, 0, 0)');
            $('.parallax-lake').css('transform','translate3d(' + -(100*currentScrollPosition/parallaxLength) + 'px, 82.63158%, 0)');
        } else {
            $('.parallax-mountain').css('transform','translate3d(-26px, 0, 0)');
            $('.parallax-lake').css('transform','translate3d(-51px, 82.63158%, 0)');
        }
}

// dragging js
require('dragscroll');