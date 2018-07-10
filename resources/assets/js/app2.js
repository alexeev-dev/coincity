window.$ = window.jQuery = require('jquery');

$(document).ready(function() {

    // switch sound
	$('.js-sound').click(function() {
        const self = $(this);
        self.addClass('loading');

        axios.post('/user/switch-sound', {
        }).then(function (response) {

            self.text(response.data);
            self.removeClass('loading');

        }).catch(function (error) {
            globalHandlerError(error.response);
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
            globalHandlerError(error.response);
        });
    });

    // house popup
    $('.house-item .coins').click(function() {
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
                // ...
            } else {
                popup.find('.house-info').html(response.data.html);
                $('.js-total-money').text(response.data.money);
            }

        }).catch(function (error) {
            globalHandlerError(error.response);
        });

        return false;
    });

    // house i popup
    $('.house-item .info').click(function() {
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
                // ...
            } else {
                popup.find('.house-info-small').html(response.data.html);
            }

        }).catch(function (error) {
            globalHandlerError(error.response);
        });

        return false;
    });

    // coin click - gather money
    // house popup
    $('.house-item .houses-count a').click(function() {
        const self = $(this).parents('.house-item');
        $(this).remove();

        axios.post('/user/gather-money', {
            houseId: self.data('house-id')
        }).then(function (response) {

            if (response.data === 1) {
                // ...
            } else {
                $('.js-total-money').text(response.data.money);
            }

        }).catch(function (error) {
            globalHandlerError(error.response);
        });

        return false;
    });
});
