window.$ = window.jQuery = require('jquery');
const commonError = "Something went wrong. Try again later.";

require('jquery-countdown');

var countSeconds = parseInt($('.js-adv-cd').attr('data-countdown'));
if (countSeconds > 0) {
    var countDate = new Date(new Date().getTime() + countSeconds * 1000);
    $('.js-adv-cd').countdown(countDate, function (event) {
        $(this).html(event.strftime('%H:%M<span>:%S</span>'));
    });
}

// server pinger
function pingServer() {
    axios.post('/user/update-all', {
    }).then(function (response) {

        if (response.data.newTweetCount > 0) {
            $('.js-news span').text(response.data.newTweetCount).show();
        } else {
            $('.js-news span').hide();
        }

        for (let i = 0; i < response.data.houseIds.length; i++) {
            $('[data-house-id="' + response.data.houseIds[i] + '"] .houses-count').removeClass('collected hidden');
        }

        if (response.data.next > 0) {
            setTimeout(pingServer, response.data.next * 1000);
        }

    }).catch(function (error) {
        // ...
    });
}
setTimeout(pingServer, 10000);

let isBusy = false;
function busyCheck() {
    if (isBusy) {
        return true;
    } else {
        isBusy = true;
        setTimeout(function() {
            isBusy = false;
        }, 500);
        return false;
    }
}

// houses
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

    // sendHousesState
    var houses = [];
    $(".houses.drop .house-item").each(function(i) {
        houses.push({id: $(this).data('house-id'), position: i});
    });

    axios.post('/user/change-houses-state', {
        houses: houses
    }).then(function (response) {

        if (response.data === 1) {
            // ...

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
        // ...
    });
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

$(document).ready(function() {
    calculateHousesWidth();

    let body = $('body');

    // switch sound
	$('.js-sound').click(function() {
	    if (busyCheck()) {
	        return false;
        }

        const self = $(this);
        self.addClass('loading');

        axios.post('/user/switch-sound', {
        }).then(function (response) {

            self.text(response.data);
            self.removeClass('loading');

        }).catch(function (error) {
            // ...
        });

        return false;
    });

	// change user name
    let nameEl = $('.js-name');
    nameEl.data('currentName', nameEl.val());
    nameEl.on('blur', function() {
        if ($(this).val() === $(this).data('currentName')) {
            return;
        }

        const self = $(this);
        self.addClass('loading');

        axios.post('/user/change-name', {
            name: self.val()
        }).then(function (response) {

            self.removeClass('loading');
            if (response.data === 1) {
                self.addClass('error');
            } else {
                self.data('currentName', self.val());
                self.removeClass('error');
            }

        }).catch(function (error) {
            // ...
        });
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

    // house popup
    body.on('click', '.house-item .coins', function() {
        if (busyCheck()) {
            return false;
        }

        const self = $(this).parents('.house-item');
        const popup = $('.popup');

        self.find('.houses-count').removeClass('collected').addClass('hidden');
        $('.popup-house-info, .popup').addClass('active');

        popup.find('.house-info').empty();
        popup.addClass('loading');

        axios.post('/user/get-user-house-info', {
            houseId: self.data('house-id')
        }).then(function (response) {

            popup.removeClass('loading');
            if (response.data === 1) {
                popup.find('.house-info').html(commonError);
            } else {
                popup.find('.house-info').html(response.data.html);
                $('.js-total-money').text(response.data.money);
                if (response.data.newTweetCount > 0) {
                    $('.js-news span').text(response.data.newTweetCount).show();
                } else {
                    $('.js-news span').hide();
                }

            }

        }).catch(function (error) {
            popup.find('.house-info').html(commonError);
        });

        return false;
    });

    // house i popup
    body.on('click', '.house-item .info, .houses .house-item .houses-images', function() {
        if (busyCheck()) {
            return false;
        }

        const self = $(this).parents('.house-item');
        const popup = $('.popup');

        // $('.popup-house-info-small, .popup').addClass('active');
        $('.popup-house-info-full, .popup').addClass('active');

        // popup.find('.house-info-small').empty();
        popup.find('.house-info-full').empty();
        popup.addClass('loading');

        axios.post('/user/get-user-house-info-small', {
            houseId: self.data('house-id')
        }).then(function (response) {

            popup.removeClass('loading');
            if (response.data === 1) {
                // popup.find('.house-info-small').html(commonError);
                popup.find('.house-info-full').html(commonError);
            } else {
                // popup.find('.house-info-small').html(response.data.html);
                popup.find('.house-info-full').html(response.data.html);
            }

        }).catch(function (error) {
            // popup.find('.house-info-small').html(commonError);
            popup.find('.house-info-full').html(commonError);
        });

        return false;
    });

    // house update
    body.on('click', '.js-update', function() {
        if (busyCheck()) {
            return false;
        }

        const self = $(this);
        self.addClass('loading');

        axios.post('/user/update-house', {
            updateId: self.data('update-id')
        }).then(function (response) {

            self.removeClass('loading');
            if (response.data === 1) {
                // ...
            } else {
                self.remove();
                $('.js-tmph').text(response.data.totalMoneyPerHour + ' per hour');

                if (Array.isArray(response.data.houses)) {
                    for (let i = 0; i < response.data.houses.length; i++) {
                        $('[data-house-id="' + response.data.houses[i].houseId + '"] .footer-price span').text(response.data.houses[i].houseMoney);
                        $('[data-house-id="' + response.data.houses[i].houseId + '"] .houses-price .coins span').text(response.data.houses[i].houseMoney);
                        $('.popup-house-info .time p').text(response.data.houses[i].houseMoney);
                        $('.popup-house-info .coins p').text(response.data.houses[i].houseCapacity);
                    }
                }
            }

        }).catch(function (error) {
            // ...
        });

        return false;
    });

    // coin click - gather money
    $('.house-item .houses-count a').click(function() {
        if (busyCheck()) {
            return false;
        }

        const self = $(this).parents('.house-item');
        self.removeClass('collected');

        axios.post('/user/gather-money', {
            houseId: self.data('house-id')
        }).then(function (response) {

            if (response.data === 1) {
                // ...
            } else {
                $('.js-total-money').text(response.data.totalMoney);
                self.find('.houses-count').addClass('collected hidden').find('span').text(response.data.gatheredMoney);
            }

        }).catch(function (error) {
            // ...
        });

        return false;
    });

    // house feature
    body.on('click', '.js-footerButtons .featured', function() {
        if (busyCheck()) {
            return false;
        }

        const houseId = $(this).parents('.house-item').data('house-id');
        const isFav = $(this).hasClass('active');

        axios.post('/user/add-to-fav', {
            houseId: houseId,
            fav: isFav
        }).then(function (response) {

            if (response.data === 1) {
                // ...
            } else {
                // ...
            }

        }).catch(function (error) {
            // ...
        });

        return false;
    });

    // adv
    body.on('click', '.js-adv', function() {
        if (busyCheck()) {
            return false;
        }

        const self = $(this);
        const popup = $('.popup');

        $('.popup-page-content, .popup').addClass('active');

        popup.find('.page-content').empty();
        popup.addClass('loading');

        axios.post('/user/adv', {
        }).then(function (response) {

            popup.removeClass('loading');
            popup.find('.page-content').html(response.data.html);

            if (response.data.timeLeft === 0) {
                $('.js-adv-cd').data('countdowndate', '');
                $('.no-dnd').removeClass('no-dnd');
            } else {
                var countDate = new Date(new Date().getTime() + response.data.timeLeft * 1000);
                $('.js-adv-cd').countdown(countDate, function (event) {
                    $(this).html(event.strftime('%H:%M<span>:%S</span>'));
                });
            }

        }).catch(function (error) {
            popup.find('.page-content').html(commonError);
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

    // load more userhouse tweets
    body.on('click', '.js-more-house', function() {
        if (busyCheck()) {
            return false;
        }

        const self = $(this);
        self.addClass('loading');

        axios.post('/user/get-more-tweets', {
            tweets: self.parent().siblings('li').length,
            houseId: self.data('house-id')
        }).then(function (response) {

            let par = self.parent().parent();
            self.parent().remove();
            par.append(response.data.html);

        }).catch(function (error) {
            popup.find('.page-content').html(commonError);
        });

        return false;
    });

    // statistics
    $('.js-stats').click(function() {
        if (busyCheck()) {
            return false;
        }

        const self = $(this);
        const popup = $('.popup');

        $('.popup-statistics, .popup').addClass('active');

        popup.find('.statistics').empty();
        popup.addClass('loading');

        axios.post('/user/stats', {
        }).then(function (response) {

            popup.removeClass('loading');
            popup.find('.statistics').html(response.data.html);

        }).catch(function (error) {
            popup.find('.statistics').html(commonError);
        });

        return false;
    });
});
