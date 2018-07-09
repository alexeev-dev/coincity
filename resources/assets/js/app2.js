window.$ = window.jQuery = require('jquery');

$(document).ready(function() {

    // switch sound
	$('.js-sound').click(function() {
        $(this).addClass('loading');
        const self = $(this);

        axios.post('/user/switch-sound', {
        }).then(function (response) {

            self.text(response.data);
            self.removeClass('loading');

        }).catch(function (error) {
            globalHandlerError(error.response);
        });
    });

	// change user name
    let nameEl = $('.js-name');
    nameEl.data('currentName', nameEl.val());
    nameEl.on('blur', function() {
        if ($(this).val() === $(this).data('currentName')) {
            return;
        }

        $(this).addClass('loading');
        const self = $(this);

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

    // build house


});
