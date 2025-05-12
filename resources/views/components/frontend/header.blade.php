<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{route('index')}}" class="logo">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li>
                            <a href="{{ route('index') }}"
                                class="{{ request()->routeIs('index') ? 'active' : '' }}">Beranda</a>
                        </li>
                        <li>
                            <a href="{{ route('products') }}"
                                class="{{ request()->routeIs('products') ? 'active' : '' }}">Produk / Dokumen
                                Hukum</a>
                        </li>
                        <li><a href="category.html">Profil</a></li>
                        <li><a href="contact.html">Unduhan</a></li>
                        <li><a href="contact.html">FAQ</a></li>
                        <li>
                            <div class="main-white-button">
                                @if(Auth::check())
                                @if(Auth::user()->roles == 'ADMIN')
                                <a href="{{ route('dashboard.index') }}">
                                    <i class="fa fa-dashboard"></i> Dashboard
                                </a>
                                @else
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                @endif
                                @else
                                <a href="{{ route('login') }}">
                                    <i class="fa fa-sign-in"></i> Login
                                </a>
                                @endif
                            </div>
                        </li>

                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>