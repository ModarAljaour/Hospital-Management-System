<div class="header-upper">
    <div class="inner-container clearfix">

        <!--Info-->
        <div class="logo-outer">
            <div class="logo"><a href="index.html"><img src="images/logo-3.png" alt="" title=""></a></div>
        </div>

        <!--Nav Box-->
        <div class="nav-outer clearfix">
            <!--Mobile Navigation Toggler For Mobile-->
            <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
            <nav class="main-menu navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <!-- Togg le Button -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon flaticon-menu"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                    <ul class="navigation clearfix">
                        <li class="current dropdown"><a href="#">Home</a>
                            <ul>
                                <li><a href="index.html">Home page 01</a></li>
                                <li><a href="index-2.html">Home page 02</a></li>
                                <li><a href="index-3.html">Home page 03</a></li>
                                <li><a href="index-4.html">Home page 04</a></li>
                                <li class="dropdown"><a href="#">Header Styles</a>
                                    <ul>
                                        <li><a href="index.html">Header Style One</a></li>
                                        <li><a href="index-2.html">Header Style Two</a></li>
                                        <li><a href="index-3.html">Header Style Three</a></li>
                                        <li><a href="index-4.html">Header Style Four</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#">About us</a>
                            <ul>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="team.html">Our Team</a></li>
                                <li><a href="faq.html">Faq</a></li>
                                <li><a href="services.html">Services</a></li>
                                <li><a href="gallery.html">Gallery</a></li>
                                <li><a href="comming-soon.html">Comming Soon</a></li>
                            </ul>
                        </li>

                        <li class="dropdown"><a href="#">Doctors</a>
                            <ul>
                                <li><a href="doctors.html">Doctors</a></li>
                                <li><a href="doctors-detail.html">Doctors Detail</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#">Department</a>
                            <ul>
                                <li><a href="{{ route('department') }}">Department</a></li>
                                <li><a href="department-detail.html">Department Detail</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a href="#">Blog</a>
                            <ul>
                                <li><a href="{{ route('blogs') }}">Our Blog</a></li>
                                <li><a href="{{ route('index-blogs') }}">Blog Classic</a></li>
                                <li><a href="blog-detail.html">Blog Detail</a></li>
                            </ul>
                        </li>

                        <li><a href="contact.html">Contact</a></li>


                        {{-- Get supported languages  --}}
                        <li class="dropdown"><a href="#">{{ LaravelLocalization::getCurrentLocaleNative() }}</a>
                            <ul>
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a rel="alternate" hreflang="{{ $localeCode }}"
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $properties['native'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Main Menu End-->

            <!-- Main Menu End-->
            <div class="outer-box clearfix">
                <!-- Main Menu End-->
                <div class="nav-box">
                    <div class="nav-btn nav-toggler navSidebar-button"><span class="icon flaticon-menu-1"></span></div>
                </div>

                <!-- Social Box -->
                <ul class="social-box clearfix">
                    <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                    <li><a title="تسجيل الدخول" href="{{ route('login') }}"><span class="fas fa-user"></span></a></li>
                </ul>

                <!-- Search Btn -->
                <div class="search-box-btn"><span class="icon flaticon-search"></span></div>

            </div>
        </div>

    </div>
</div>
