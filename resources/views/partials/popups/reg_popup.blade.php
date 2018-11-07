<div class="js-reg popup-log-reg">
    <div class="log-reg">
        <a href="#" class="close js-closePopup"></a>
        <h3>Create your account to save the progress</h3>
        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <input class="js-sh" type="hidden" name="sh" value="">
            <section>
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </section>

            <footer>
                <button type="submit" class="btn purple">
                    Register
                </button>
            </footer>
        </form>
    </div>
</div>
