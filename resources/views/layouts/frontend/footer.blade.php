{{-- <footer class="footer-area">
    <!-- Top Footer Area -->
    <div class="top-footer-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Footer Logo -->
                    <div class="footer-logo">
                        <a href="/"><h3 class="text-light">{nama sekolah}</h3></a>
                    </div>
                    <!-- Copywrite -->
                   
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Footer Area -->
    <div class="bottom-footer-area d-flex justify-content-between align-items-center">
        <!-- Contact Info -->
        <div class="contact-info">
            <a href="#"><span>Phone:</span> Number Phone school</a>
            <a href="#"><span>Email:</span> nameschool@example.com</a>
        </div>
        <!-- Follow Us -->
        <div class="follow-us">
            <a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        </div>
    </div>
</footer> --}}

<div class="full-section">
<footer class="footer-area">
    <div class="top-footer-area">
        <div class="container">
            <div class="row">
                <nav>
                    <div class="col-12">
                        <div class="footer-logo">
                            <img src="{{ asset('img/bg/pgri.png') }}" alt="">
                        </div>
                        <div class="navbar-collapse">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item"><a href="/" class="{{ Request::is('/') || Request::is('home') ? 'text-primary' : '' }}">Home</a></li>
                                <li class="nav-item"><a href="{{ route('about') }}" class="{{ Request::is('about') ? 'text-primary' : '' }}">Tentang</a></li>
                                <li class="nav-item"><a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'text-primary' : '' }}">Kontak</a></li>
                                <li class="nav-item"><a href="{{ route('artikel') }}" class="{{ Request::segment(1) == 'artikel' ? 'text-primary' : '' }}">Artikel</a></li>
                                <li class="nav-item"><a href="{{ route('pengumuman') }}" class="{{ Request::segment(1) == 'pengumuman' ? 'text-primary' : '' }}">Pengumuman</a></li>
                                <li class="nav-item"><a href="" class="{{ Request::is('agenda') ? 'text-primary' : '' }}">Agenda</a></li>
                            </ul>

                        </div>
            
                    </div>
                </nav>
            </div>
        </div>
    </div>
</footer>
</div>
