window.$ = window.jQuery = require('jquery');
const commonError = "Something went wrong. Try again later.";

// houses
import * as dragula from "dragula";

const drag = dragula([document.getElementById("left-lovehandles"),
    document.getElementById("right-lovehandles")], {
    moves: function (el, container, handle) {
        $('.app').removeClass('tutorial');
        return handle.classList.contains('handle') && !el.classList.contains('no-dnd');
    },
    accepts: function(el, target) {
        return !el.classList.contains('no-dnd') && $(".houses.drop .house-item").length <= 3;
    }
}).on('drop', function (el) {
    el.className += ' dropped user-house';
    el.classList.remove('dropped');

    calculateHousesWidth();

    // show reg popup
    setTimeout(function() {
        let firstHouse = $(".houses.drop .house-item:first");
        if (firstHouse.length) {
            $('.js-sh').val(firstHouse.data('house-id'));
        } else {
            $('.js-sh').val('');
        }
        $('.js-reg, .popup').addClass('active');
    }, 100);
});


$(window).resize(function() {
    calculateHousesWidth();
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

let isBusy = false;
function busyCheck() {
    if (isBusy) {
        return true;
    } else {
        isBusy = true;
        setTimeout(function() {
            isBusy = false;
        }, 1000);
        return false;
    }
}

$(document).ready(function() {
    calculateHousesWidth();

    let body = $('body');

    // static pages menu
    $('.settings li a[href^="#"]').click(function() {
        if (busyCheck()) {
            return false;
        }

        $('.app').removeClass('active-settings');
        $('.js-settings').removeClass('active');

        const self = $(this);
        const popup = $('.popup');

        $('.popup-page-content, .popup').addClass('active');

        popup.find('.page-content').empty();
        popup.addClass('loading');

        axios.post('/page/' + self.attr('href').substr(1), {
        }).then(function (response) {

            popup.removeClass('loading');
            popup.find('.page-content').html(response.data.html);

        }).catch(function (error) {
            popup.find('.page-content').html(commonError);
        });

        return false;
    });

    // news menu
    $('.js-news').click(function(e) {
        if (busyCheck()) {
            return false;
        }

        $('.app').toggleClass('active-news');
        $(this).toggleClass('active');

        const popup = $(this).siblings('.news-inner');
        popup.empty();
        popup.addClass('loading');

        $(this).find('span').hide();

        axios.post('/news', {
        }).then(function (response) {

            popup.removeClass('loading');
            popup.html(response.data.html);

        }).catch(function (error) {
            popup.html(commonError);
        });

        return false;
    });

    // load more news
    body.on('click', '.js-more', function() {
        if (busyCheck()) {
            return false;
        }

        const self = $(this);
        self.addClass('loading');

        axios.post('/more-news', {
            tweets: self.parent().siblings('li').length
        }).then(function (response) {

            let par = self.parent().parent();
            self.parent().remove();
            par.append(response.data.html);

        }).catch(function (error) {
            popup.find('.page-content').html(commonError);
        });

        return false;
    });
});
