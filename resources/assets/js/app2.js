window.$ = window.jQuery = require('jquery');

const commonError = "Something went wrong. Try again later.";

$(document).ready(function() {
    let body = $('body');

    // switch sound
	$('.js-sound').click(function() {
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

    // static pages menu
    $('.settings li a[href^="#"]').click(function() {
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
        $('.app').toggleClass('active-news');
        $(this).toggleClass('active');

        const popup = $(this).siblings('.news-inner');
        popup.empty();
        popup.addClass('loading');

        // todo tmp
        $(this).find('span').remove();

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
        const self = $(this).parents('.house-item');
        const popup = $('.popup');

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
            }

        }).catch(function (error) {
            popup.find('.house-info').html(commonError);
        });

        return false;
    });

    // house i popup
    body.on('click', '.house-item .info', function() {
        const self = $(this).parents('.house-item');
        const popup = $('.popup');

        $('.popup-house-info-small, .popup').addClass('active');

        popup.find('.house-info-small').empty();
        popup.addClass('loading');

        axios.post('/user/get-user-house-info-small', {
            houseId: self.data('house-id')
        }).then(function (response) {

            popup.removeClass('loading');
            if (response.data === 1) {
                popup.find('.house-info-small').html(commonError);
            } else {
                popup.find('.house-info-small').html(response.data.html);
            }

        }).catch(function (error) {
            popup.find('.house-info-small').html(commonError);
        });

        return false;
    });

    // house update
    body.on('click', '.js-update', function() {
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
    // house popup
    $('.house-item .houses-count a').click(function() {
        const self = $(this).parents('.house-item');
        $(this).hide();

        axios.post('/user/gather-money', {
            houseId: self.data('house-id')
        }).then(function (response) {

            if (response.data === 1) {
                // ...
            } else {
                $('.js-total-money').text(response.data.totalMoney);
            }

        }).catch(function (error) {
            // ...
        });

        return false;
    });

    // house feature
    body.on('click', '.js-footerButtons .featured', function() {
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
});
