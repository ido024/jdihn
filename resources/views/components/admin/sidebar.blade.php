<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Personal</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="mdi mdi-av-timer"></i>
                        <span class="hide-menu">Dashboard </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{route('dashboard.index')}}" class="sidebar-link">
                                <i class="mdi mdi-adjust"></i>
                                <span class="hide-menu"> Dashboard </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                        aria-expanded="false">
                        <i class="mdi mdi-dns"></i>
                        <span class="hide-menu">Data Master </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{route('dashboard.produk.index')}}" class="sidebar-link">
                                <i class="far fa-list-alt"></i>
                                <span class="hide-menu"> Data Master Produk Hukum </span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{route('dashboard.jenisdocument.index')}}" class="sidebar-link">
                                <i class="far fa-list-alt"></i>
                                <span class="hide-menu"> Data Master Jenis Dokuemn </span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Upload Dokumen / Dokumen Hukum</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{route('dashboard.documents.index')}}" aria-expanded="false">
                        <i class="mdi mdi-content-paste"></i>
                        <span class="hide-menu">Dokumen Data</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{route('dashboard.documents.create')}}" aria-expanded="false">
                        <i class="mdi mdi-cloud-upload"></i>
                        <span class="hide-menu">Upload Dokumen</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{route('dashboard.dashboard.chat.index')}}" aria-expanded="false">
                        <i class="ti-comment"></i>
                        <span class="hide-menu"> Chat User </span>
                    </a>
                </li>



                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link"
                        href="{{ route('dashboard.laporan-index') }}" aria-expanded="false">
                        <i class="mdi mdi-content-paste"></i>
                        <span class="hide-menu">Laporan Dokumen </span>
                    </a>
                </li>

                <li class="nav-small-cap">
                    <i class="mdi mdi-dots-horizontal"></i>
                    <span class="hide-menu">Extra</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('index')}}"
                        aria-expanded="false">
                        <i class="mdi mdi-content-paste"></i>
                        <span class="hide-menu">Front-page</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit"
                            class="bg-transparent btn sidebar-link waves-effect waves-dark sidebar-link" href="#"
                            aria-expanded="false">
                            <i class="mdi mdi-directions"></i>
                            <span class="hide-menu">Log Out</span>
                        </button>
                    </form>

                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>