<div class="popup-page-content advertising">
    <div class="page-content">
        <h3>For advertising questions</h3>
        <p>
            <input id="adv-email" type="text" value="contact@cryptodales.com" style="opacity:0">
            <a href="mailto:contact@cryptodales.com">contact@cryptodales.com</a>
        </p>
        <button class="btn green js-copy">Copy</button>
    </div>
    <a href="#" class="close js-closePopup"></a>
</div>

<div class="popup-page-content feedback">
    <div class="page-content">
        <h3>Tell us about bugs and offers</h3>
        <form class="form-horizontal">
            <section>
                <div class="form-group">
                    <textarea id="feedback" name="feedback" required></textarea>
                </div>
            </section>
            <footer>
                <button type="submit" class="btn green js-sendFeedback">Send</button>
            </footer>
        </form>
    </div>
    <div class="answer"></div>
    <a href="#" class="close js-closePopup"></a>
</div>

@if (session('success-message'))
    <div class="popup-page-content logged active">
        <div class="page-content">
            <h3>Welcome!</h3>
            {!! session('success-message') !!}
        </div>
        <a href="#" class="close js-closePopup"></a>
    </div>
@endif