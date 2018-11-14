<header>
    <div class="banner"></div>
</header>
<section>
    <div class="info-full">
        <header>
            <figure>
                <img src="{{ asset($userHouse->house->image) }}">
                <figcaption>
                    <h2>{{ $userHouse->house->name }}</h2>
                    {!! $userHouse->house->content !!}
                </figcaption>
            </figure>
        </header>
        <!--
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
        -->
    </div>

    <!--
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
    -->
</section>
<!--
<footer>
    <div class="banner"></div>
</footer>
-->

