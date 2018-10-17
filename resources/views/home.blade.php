@extends('layouts.app')

@section('content')
    <section class="wr-houses">
        <a href="#" class="scroll-button left js-scrollHouses disabled"><img src="{{ asset('img/icons/scroll_arrow.svg') }}"></a>
        <a href="#" class="scroll-button right js-scrollHouses disabled"><img src="{{ asset('img/icons/scroll_arrow.svg') }}"></a>
        <div class="scrollbar">
            <div class="parallax-mountain">
                <img src="{{ asset('img/backgrounds/mountain.svg') }}">
            </div>
            <div class="parallax-lake">
                <img src="{{ asset('img/backgrounds/lake.svg') }}">
            </div>
            <div class="houses drop" id="left-lovehandles">

                @foreach ($userHouses as $userHouse)
                <div class="house-item{{ $userHouse->fav ? ' house-featured' : '' }} user-house" data-house-id="{{ $userHouse->house->id }}">
                    <header>
                        <div class="houses-count{{ $userHouse->canGatherMoney() ? '' : ' hidden' }}">
                            <span></span>
                            <a href="#"><em></em></a>
                        </div>
                        <div class="footer-buttons js-footerButtons">
                            <a href="#" class="info"><img src="{{ asset('img/icons/info_btn.svg') }}"></a>
                            <a href="#" class="featured{{ $userHouse->fav ? ' active' : '' }}"><img src="{{ asset('img/icons/featured_btn_disabled.svg') }}"></a>
                        </div>
                    </header>
                    <section>
                        <figure class="footer-image">
                            <img class="handle" src="{{ asset($userHouse->house->image_small) }}">
                        </figure>
                        <figure class="houses-images">
                            <img src="{{ asset($userHouse->house->image_small) }}">
                        </figure>
                        <figure class="draggable">
                            <img src="{{ asset($userHouse->house->image_small) }}">
                        </figure>
                    </section>
                    <footer>
                        <div class="footer-price">
                            <img src="{{ asset('img/icons/cointime_icon.png') }}">
                            <span>{{ $userHouse->money_per_hour_text }}</span>
                        </div>
                        <div class="houses-price">
                            <a href="#" class="info"></a>
                            <a href="#" class="coins"><img src="{{ asset('img/header/h_i_button_upg_timecoins_icon.svg') }}"><span>{{ $userHouse->money_per_hour_text }}</span></a>
                            <a href="#" class="replace"><img class="handle" src="{{ asset('img/house-info/remove_btn.png') }}"></a>
                        </div>
                    </footer>
                </div>
                @endforeach

            </div>
        </div>
        <div class="scrollbar_x">
            <div class="scroll-element_outer">
                <div class="scroll-element_size"></div>
                <div class="scroll-element_track"></div>
                <div class="scroll-bar"></div>
            </div>
        </div>
    </section>

    <footer class="wr-footer active">
        <a href="#" class="footerShowHide js-footerShowHide"></a>
        <div class="container">
            <div class="footer">
                <div class="first-tutorial">
                    <img class="tutorial-arrow" src="{{ asset('img/tutorial/arrow.svg') }}">
                    <img class="tutorial-hand" src="{{ asset('img/tutorial/hand.svg') }}">
                    <div class="shadow-overlay"></div>
                    <div class="text-overlay">
                        <p>Tap and drag the house</p>
                        <a href="#" class="js-closeTutorial">OK</a>
                    </div>
                </div>
                <section class="js-footerHouseItems new-active built-active featured-active show" id="right-lovehandles">
                    @foreach ($houses as $house)
                    @php
                        $showCoin = false;
                        if (!empty($allUserHouses)) {
                            $userHouse = $allUserHouses->where('house_id', $house->id)->first();
                            if (!empty($userHouse)) {
                                $showCoin = $userHouse->canGatherMoney();
                            }
                        }
                        $isUserHouse = !empty($userHouse);
                        $fav = $isUserHouse && $userHouse->fav ? true : false;
                    @endphp
                    <div class="house-item{{ $fav ? ' house-featured' : '' }}{{ $isUserHouse ? ' user-house' : '' }}{{ !$isUserHouse && $buildBlocked ? ' no-dnd' : '' }}" data-house-id="{{ $house->id }}">
                        <header>
                            <div class="houses-count{{ $showCoin ? '' : ' hidden' }}">
                                <span></span>
                                <a href="#"><em></em></a>
                            </div>
                            <div class="footer-buttons js-footerButtons">
                                <a href="#" class="info"><img src="{{ asset('img/icons/info_btn.svg') }}"></a>
                                <a href="#" class="featured{{ $fav ? ' active' : '' }}"><img src="{{ asset('img/icons/featured_btn_disabled.svg') }}"></a>
                            </div>
                        </header>
                        <section class="adv">
                            <a class="js-adv" href="#"><p class="js-adv-cd" data-countdown="{{ $timeLeft }}"></p><img src="{{ asset('img/footer/video-icon.svg') }}"></a>
                        </section>
                        <section>
                            <figure class="footer-image">
                                <img class="handle" src="{{ asset($house->image_small) }}">
                            </figure>
                            <figure class="houses-images">
                                <img src="{{ asset($house->image_small) }}">
                            </figure>
                            <figure class="draggable">
                                <img src="{{ asset($house->image_small) }}">
                            </figure>
                        </section>
                        <footer>
                            <div class="footer-price">
                                <img src="{{ asset('img/icons/cointime_icon.png') }}">
                                <span>{{ $house->money_per_hour_text }}</span>
                            </div>
                            <div class="houses-price">
                                <a href="#" class="info"></a>
                                <a href="#" class="coins"><img src="{{ asset('img/header/h_i_button_upg_timecoins_icon.svg') }}"><span>{{ $house->money_per_hour_text }}</span></a>
                                <a href="#" class="replace"><img class="handle" src="{{ asset('img/house-info/remove_btn.png') }}"></a>
                            </div>
                        </footer>
                    </div>
                    @endforeach

                </section>

                <section class="buld-active-block">

                </section>

                <section class="featured-active-block">

                </section>

                <footer>
                    <ul class="js-listSort">
                        <li>
                            <a href="#" class="new active">
                                <em>
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         width="31px" height="31px" viewBox="0 0 31 31" enable-background="new 0 0 31 31" xml:space="preserve">
        								<path fill="#FFFFFF" d="M30.999,18.67c0,0.912-0.74,1.652-1.654,1.652h-9.023v9.025c0,0.912-0.74,1.652-1.654,1.652H12.33
        								c-0.912,0-1.652-0.74-1.652-1.652v-9.025H1.652C0.74,20.323,0,19.583,0,18.67v-6.338c0-0.914,0.74-1.654,1.652-1.654h9.025V1.655
        								C10.678,0.741,11.418,0,12.33,0h6.337c0.914,0,1.654,0.74,1.654,1.654v9.023h9.023c0.914,0,1.654,0.74,1.654,1.654V18.67z"/>
        							</svg>
                                </em>
                                <span>New</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="built">
                                <em>
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         width="33.828px" height="31.923px" viewBox="0 0 33.828 31.923" enable-background="new 0 0 33.828 31.923" xml:space="preserve">
        							<g>
                                        <path fill="#FFFFFF" d="M10.133,16.731c-0.631,0.633-0.729,1.594-0.293,2.33l-1.824,1.822c-0.641,0.641-1.678,0.641-2.318,0
        								L0.48,15.668c-0.641-0.641-0.641-1.678,0-2.318l1.803-1.803c0.746,0.514,1.777,0.439,2.441-0.225
        								c0.662-0.664,0.736-1.693,0.223-2.439l4.928-4.928c0.166-0.164,0.357-0.287,0.561-0.365c2.391-1.539,8.125-4.855,12.498-3.082
        								l0.807,2.902c0,0-8.545,0.322-7.578,4.514l1.248,1.248c0.639,0.639,0.639,1.678,0,2.318l-4.949,4.947
        								C11.727,16.004,10.764,16.1,10.133,16.731z"/>
                                        <path fill="#FFFFFF" d="M32.807,30.155l-0.746,0.746c-1.236,1.238-3.109,1.369-4.184,0.297L14.141,17.459l5.223-5.225
        								l13.738,13.736C34.176,27.045,34.043,28.918,32.807,30.155z"/>
                                    </g>
        						</svg>
                                </em>
                                <span>Built</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="featured">
                                <em>
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         width="31.517px" height="30.326px" viewBox="0 0 31.517 30.326" enable-background="new 0 0 31.517 30.326" xml:space="preserve">
        						<path fill="#FFFFFF" d="M30.426,15.02l-4.717,4.596l1.113,6.49c0.232,1.355-0.322,2.723-1.436,3.529
        						c-0.629,0.459-1.373,0.691-2.121,0.691c-0.574,0-1.15-0.137-1.68-0.416l-5.828-3.064l-5.83,3.064
        						C9.4,30.189,8.824,30.326,8.25,30.326c-0.75,0-1.494-0.232-2.123-0.691c-1.111-0.807-1.668-2.174-1.436-3.529l1.113-6.49L1.09,15.02
        						c-0.984-0.959-1.338-2.393-0.914-3.699s1.553-2.26,2.914-2.457l6.518-0.947l2.914-5.906C13.129,0.779,14.383,0,15.758,0
        						c1.373,0,2.629,0.779,3.234,2.01l2.916,5.906l6.518,0.947c1.357,0.197,2.49,1.15,2.914,2.457S31.408,14.061,30.426,15.02z"/>
        					</svg>
                                </em>
                                <span>Featured</span>
                            </a>
                        </li>
                    </ul>
                </footer>
            </div>
        </div>
    </footer>
@endsection

@section('news')
    <div class="news">
        <a href="#" class="js-news">
            @if (!empty($newTweetCount))
            <span>{{ $newTweetCount }}</span>
            @endif
        </a>
        <div class="news-inner">
        </div>
    </div>
@endsection

@push('popups')
    <!-- <div class="popup{{ $errors->any() ? ' active' : '' }}"> -->
    <div class="popup active">
        <div class="popup-house-info">
            <a href="#" class="close js-closePopup"></a>
            <div class="house-info">
            </div>
        </div>

        <div class="popup-house-info-small">
            <div class="house-info-small">
            </div>
            <a href="#" class="close js-closePopup"></a>
        </div>

        <div class="popup-page-content">
            <div class="page-content">
            </div>
            <a href="#" class="close js-closePopup"></a>
        </div>

        <div class="js-log popup-log-reg{{ $errors->any() ? ' active' : '' }}">
            <a href="#" class="close js-closePopup"></a>
            <div class="log-reg">
                <h3></h3>
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <section>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus required>

                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif

                            @if ( session('not_confirmed')  )
                                <a class="btn btn-link" href="{{ '/register/resend-verification?email=' . old('email') }}">Отправить подтверждение повторно!</a>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                    </section>

                    <footer>
                        <button type="submit" class="btn green">
                            Login
                        </button>

                        <a class="#" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </footer>
                </form>
            </div>
        </div>

        <div class="js-reg popup-log-reg">
            <div class="log-reg">
                <a href="#" class="close js-closePopup"></a>
                <h3>Create your account to save the progress</h3>
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
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

        <div class="popup-house-info-full">
            <div class="house-info-full">
                <a href="#" class="close js-closePopup"></a>
                <header>
                    <div class="banner"></div>
                </header>
                <section>
                    <div class="info-full">
                        <header>
                            <figure>
                                <img src="{{ asset('img/full-info/logo.png') }}">
                                <figcaption>
                                    <h2>Verifier (VRF)</h2>
                                    <h4>Verifier is a blockchain based solution that verifies data quickly, accurately, reliably, and securely.incididunt ut labore et dolore magna aliqua. </h4>
                                    <ul>
                                        <li>Xiaomi is an electronics and software company that </li>
                                        <li>Xiaomi is an electronics and software company that </li>
                                        <li>Xiaomi is an electronics</li>
                                        <li>Xiaomi is an electronics and software company that focuses on mobile devices and technology.</li>
                                        <li>Xiaomi is an electronics</li>
                                    </ul>
                                    <p>Xiaomi is an electronics and software company that focuses on mobile devices and technology. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
                                </figcaption>
                            </figure>
                        </header>
                        <section>
                            <h3>Articles</h3>
                            <div class="articles">
                                <ul>
                                    <li><a href="#">Australian Financial Regulator Develops New Rules Crypto</a></li>
                                    <li><a href="#">Australian Financial Regulator Develops New Rules Crypto</a></li>
                                    <li><a href="#">Australian Financial Regulator Develops New Rules Crypto</a></li>
                                </ul>
                                <a href="#">All articles</a>
                            </div>
                            <h3>Details</h3>
                            <div class="details">
                                <ul>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/graphic.png') }}#">
                                            <figcaption>
                                                <span>Market cup</span>
                                                <p>$576,933,163 EOS</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/twenty-four-hours.png') }}">
                                            <figcaption>
                                                <span>Volume 24H</span>
                                                <p>576,933,163 EOS</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/blockchain.png') }}">
                                            <figcaption>
                                                <span>Blockchain</span>
                                                <p>Own Blockchain</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/path.png') }}">
                                            <figcaption>
                                                <span>Circulationg suplly</span>
                                                <p>576,933,163 EOS</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/total-suplly.png') }}">
                                            <figcaption>
                                                <span>Total suplly</span>
                                                <p>576,933,163 EOS</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/shield.png') }}">
                                            <figcaption>
                                                <span>Proof type</span>
                                                <p>Proof of Stake (POS)</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/algorithm.png') }}">
                                            <figcaption>
                                                <span>Algorithm</span>
                                                <p>DPoS</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/marker.png') }}">
                                            <figcaption>
                                                <span>Team location</span>
                                                <p>Internation</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/megaphone.png') }}">
                                            <figcaption>
                                                <span>First announced</span>
                                                <p>May 6, 2017</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                </ul>
                            </div>
                            <h3>Exchanges Trading</h3>
                            <div class="trades">
                                <ul>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/trades-1.png') }}">
                                        </figure>
                                        <a href="#"><img src="{{ asset('img/full-info/link.png') }}"></a>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/trades-2.png') }}">
                                        </figure>
                                        <a href="#"><img src="{{ asset('img/full-info/link.png') }}"></a>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/trades-3.png') }}">
                                        </figure>
                                        <a href="#"><img src="{{ asset('img/full-info/link.png') }}"></a>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/trades-4.png') }}">
                                        </figure>
                                        <a href="#"><img src="{{ asset('img/full-info/link.png') }}"></a>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/trades-1.png') }}">
                                        </figure>
                                        <a href="#"><img src="{{ asset('img/full-info/link.png') }}"></a>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/trades-2.png') }}">
                                        </figure>
                                        <a href="#"><img src="{{ asset('img/full-info/link.png') }}"></a>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/trades-3.png') }}">
                                        </figure>
                                        <a href="#"><img src="{{ asset('img/full-info/link.png') }}"></a>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/trades-4.png') }}">
                                        </figure>
                                        <a href="#"><img src="{{ asset('img/full-info/link.png') }}"></a>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/trades-1.png') }}">
                                        </figure>
                                        <a href="#"><img src="{{ asset('img/full-info/link.png') }}"></a>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/trades-2.png') }}">
                                        </figure>
                                        <a href="#"><img src="{{ asset('img/full-info/link.png') }}"></a>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/trades-3.png') }}">
                                        </figure>
                                        <a href="#"><img src="{{ asset('img/full-info/link.png') }}"></a>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/trades-4.png') }}">
                                        </figure>
                                        <a href="#"><img src="{{ asset('img/full-info/link.png') }}"></a>
                                    </li>
                                </ul>
                            </div>
                            <h3>ICO Details</h3>
                            <div class="details">
                                <ul>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/start-date.png') }}">
                                            <figcaption>
                                                <span>ICO start date</span>
                                                <p>Jun 1 2017, <br>11:59 pm UTS</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/end-date.png') }}">
                                            <figcaption>
                                                <span>ICO end date</span>
                                                <p>Jun 1, 11:59 pm UTS</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/path.png') }}">
                                            <figcaption>
                                                <span>ICO conversion</span>
                                                <p>Own Blockchain</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/circle.png') }}">
                                            <figcaption>
                                                <span>Total suplly</span>
                                                <p>1,576,933,163 EOS</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/circle.png') }}">
                                            <figcaption>
                                                <span>Investor suplly</span>
                                                <p>Set by market demond</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                    <li>
                                        <figure>
                                            <img src="{{ asset('img/full-info/coins.png') }}">
                                            <figcaption>
                                                <span>Total raised</span>
                                                <p>$ 4 billion USD</p>
                                            </figcaption>
                                        </figure>
                                    </li>
                                </ul>
                            </div>
                            <h3>Team</h3>
                            <div class="team">
                                <ul>
                                    <li>
                                        <div class="user">
                                            <figure>
                                                <img src="{{ asset('img/full-info/team-member.png') }}">
                                            </figure>
                                            <div>
                                                <span>CEO</span>
                                                <p>Konstantin Ivanov</p>
                                            </div>
                                        </div>
                                        <ul class="socials">
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="user">
                                            <figure>
                                                <img src="{{ asset('img/full-info/team-member.png') }}">
                                            </figure>
                                            <div>
                                                <span>CEO</span>
                                                <p>Konstantin Ivanov</p>
                                            </div>
                                        </div>
                                        <ul class="socials">
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="user">
                                            <figure>
                                                <img src="{{ asset('img/full-info/team-member.png') }}">
                                            </figure>
                                            <div>
                                                <span>CEO</span>
                                                <p>Konstantin Ivanov</p>
                                            </div>
                                        </div>
                                        <ul class="socials">
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <h3>Advisers</h3>
                            <div class="team">
                                <ul>
                                    <li>
                                        <div class="user">
                                            <figure>
                                                <img src="{{ asset('img/full-info/team-member.png') }}">
                                            </figure>
                                            <div>
                                                <span>CEO</span>
                                                <p>Konstantin Ivanov</p>
                                            </div>
                                        </div>
                                        <ul class="socials">
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="user">
                                            <figure>
                                                <img src="{{ asset('img/full-info/team-member.png') }}">
                                            </figure>
                                            <div>
                                                <span>CEO</span>
                                                <p>Konstantin Ivanov</p>
                                            </div>
                                        </div>
                                        <ul class="socials">
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="user">
                                            <figure>
                                                <img src="{{ asset('img/full-info/team-member.png') }}">
                                            </figure>
                                            <div>
                                                <span>CEO</span>
                                                <p>Konstantin Ivanov</p>
                                            </div>
                                        </div>
                                        <ul class="socials">
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="user">
                                            <figure>
                                                <img src="{{ asset('img/full-info/team-member.png') }}">
                                            </figure>
                                            <div>
                                                <span>CEO</span>
                                                <p>Konstantin Ivanov</p>
                                            </div>
                                        </div>
                                        <ul class="socials">
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </section>
                    </div>
                    <div class="info-sidebar">
                        <div class="links">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fas fa-globe"></i>
                                        www.sitecrypto.com
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="far fa-file"></i>
                                        Whitepaper
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-facebook"></i>
                                        Facebook
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-twitter"></i>
                                        Twitter
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-medium-m"></i>
                                        Medium
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-reddit-alien"></i>
                                        Reddit
                                    </a>
                                </li>
                                <li class="disabled">
                                    <a href="#">
                                        <i class="fab fa-btc"></i>
                                        Not available
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fab fa-telegram-plane"></i>
                                        Telegram
                                    </a>
                                </li>
                                <li class="disabled">
                                    <a href="#">
                                        <i class="fab fa-github-alt"></i>
                                        Not available
                                    </a>
                                </li>
                                <li class="disabled">
                                    <a href="#">
                                        <i class="fab fa-discord"></i>
                                        Not available
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="house-image">
                            <figure>
                                <img src="{{ asset('img/houses/house-9.svg') }}">
                            </figure>
                        </div>
                        <div class="subscribe">
                            <h4>Newsletter</h4>
                            <p>Join our list to receive latest <br>Blockchain, Crypto & Fintech news:</p>
                            <form action="#">
                                <input type="text" placeholder="Your e-mail">
                                <button>Subscribe</button>
                            </form>
                        </div>
                        <div class="banner"></div>
                        <div class="posts">
                            <h2>Posts</h2>
                            <ul>
                                <li>
                                    <figure>
                                        <img src="{{ asset('img/article/userphoto.png') }}">
                                    </figure>
                                    <div>
                                        <ul>
                                            <li>
                                                <a href="#">Username</a>
                                            </li>
                                            <li>
                                                <span><img src="{{ asset('img/icons/posts_time.png') }}"> 1 week ago</span>
                                            </li>
                                        </ul>
                                        <a>Bitfinex Reveals Details on EOSfinex, Beta Launch in September</a>
                                    </div>
                                </li>
                                <li>
                                    <figure>
                                        <img src="{{ asset('img/article/userphoto.png') }}">
                                    </figure>
                                    <div>
                                        <ul>
                                            <li>
                                                <a href="#">Username</a>
                                            </li>
                                            <li>
                                                <span><img src="{{ asset('img/icons/posts_time.png') }}"> 1 week ago</span>
                                            </li>
                                        </ul>
                                        <a>Bitfinex Reveals Details on EOSfinex, Beta Launch in September</a>
                                    </div>
                                </li>
                                <li>
                                    <figure>
                                        <img src="{{ asset('img/article/userphoto.png') }}">
                                    </figure>
                                    <div>
                                        <ul>
                                            <li>
                                                <a href="#">Username</a>
                                            </li>
                                            <li>
                                                <span><img src="{{ asset('img/icons/posts_time.png') }}"> 1 week ago</span>
                                            </li>
                                        </ul>
                                        <a>Bitfinex Reveals Details on EOSfinex, Beta Launch in September</a>
                                    </div>
                                </li>
                            </ul>
                            <a href="#">See more</a>
                        </div>
                        <div class="currency">
                            <ul>
                                <li>
                                    <div class="name"><figure><img src="{{ asset('img/currency/bitcoin.png') }}"></figure>Bitcoin</div>
                                    <div class="current">$6,405.56</div>
                                    <div class="percentage positive">+3%</div>
                                </li>
                                <li>
                                    <div class="name"><figure><img src="{{ asset('img/currency/ethereum.png') }}"></figure>Ethereum</div>
                                    <div class="current">$506.56</div>
                                    <div class="percentage positive">+22%</div>
                                </li>
                                <li>
                                    <div class="name"><figure><img src="{{ asset('img/currency/xrp.png') }}"></figure>XRP</div>
                                    <div class="current">$0.56</div>
                                    <div class="percentage negative">-82%</div>
                                </li>
                                <li>
                                    <div class="name"><figure><img src="{{ asset('img/currency/bitcoin_cash.png') }}"></figure>Bitcoin Cash</div>
                                    <div class="current">$6,405.56</div>
                                    <div class="percentage positive">+45%</div>
                                </li>
                                <li>
                                    <div class="name"><figure><img src="{{ asset('img/currency/litecoin.png') }}"></figure>Litecoin</div>
                                    <div class="current">$6,405.56</div>
                                    <div class="percentage positive">+3%</div>
                                </li>
                            </ul>
                            <a href="#">All currency</a>
                        </div>
                    </div>
                </section>
                <footer>
                    <div class="banner"></div>
                </footer>
            </div>
        </div>

        <div class="popup-statistics active">
            <div class="statistics">
                <a href="#" class="close js-closePopup"></a>
                <header></header>
                <section>
                    <h3>Statistics</h3>
                    <div class="table">
                        <table>
                            <tr>
                                <th>Title</th>
                                <th>Speed</th>
                                <th>Earned coins</th>
                                <th>Speed</th>
                                <th>Earned coins</th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="title">
                                        <figure>
                                            <img src="{{ asset('img/icons/statistics-image.png') }}">
                                        </figure>
                                        <p>Title of game</p>
                                    </div>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/timer_clock.png') }}"> <span>4:05:23</span></p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/coin.png') }}"> 22 000</p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/timer_clock.png') }}"> <span>4:05:23</span></p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/coin.png') }}"> 22 000</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="title">
                                        <figure>
                                            <img src="{{ asset('img/icons/statistics-image.png') }}">
                                        </figure>
                                        <p>Title of game</p>
                                    </div>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/timer_clock.png') }}"> <span>4:05:23</span></p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/coin.png') }}"> 22 000</p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/timer_clock.png') }}"> <span>4:05:23</span></p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/coin.png') }}"> 22 000</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="title">
                                        <figure>
                                            <img src="{{ asset('img/icons/statistics-image.png') }}">
                                        </figure>
                                        <p>Title of game</p>
                                    </div>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/timer_clock.png') }}"> <span>4:05:23</span></p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/coin.png') }}"> 22 000</p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/timer_clock.png') }}"> <span>4:05:23</span></p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/coin.png') }}"> 22 000</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="title">
                                        <figure>
                                            <img src="{{ asset('img/icons/statistics-image.png') }}">
                                        </figure>
                                        <p>Title of game</p>
                                    </div>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/timer_clock.png') }}"> <span>4:05:23</span></p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/coin.png') }}"> 22 000</p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/timer_clock.png') }}"> <span>4:05:23</span></p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/coin.png') }}"> 22 000</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="title">
                                        <figure>
                                            <img src="{{ asset('img/icons/statistics-image.png') }}">
                                        </figure>
                                        <p>Title of game</p>
                                    </div>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/timer_clock.png') }}"> <span>4:05:23</span></p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/coin.png') }}"> 22 000</p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/timer_clock.png') }}"> <span>4:05:23</span></p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/coin.png') }}"> 22 000</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="title">
                                        <figure>
                                            <img src="{{ asset('img/icons/statistics-image.png') }}">
                                        </figure>
                                        <p>Title of game</p>
                                    </div>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/timer_clock.png') }}"> <span>4:05:23</span></p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/coin.png') }}"> 22 000</p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/timer_clock.png') }}"> <span>4:05:23</span></p>
                                </td>
                                <td>
                                    <p><img src="{{ asset('img/icons/coin.png') }}"> 22 000</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </section>
                <footer></footer>
            </div>
        </div>
    </div>
@endpush