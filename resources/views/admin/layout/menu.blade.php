<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('root.admin.index') }}" class="app-brand-link">
            <h3 class="app-brand-text menu-text fw-bolder ms-2">E-Pawarta</h3>
        </a>

        <a href="" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    @if (Auth::user()->role == 'root')
        <ul class="menu-inner py-1">
            <li class="menu-item {{ Request::is('root') ? 'active' : '' }}">
                <a href="{{ route('root.admin.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('newsRoot') ? 'active' : '' }}">
                <a href="{{ route('root.newsRoot.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-news"></i>
                    <div data-i18n="Analytics">Semua Berita</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('userRoot') ? 'active' : '' }}">
                <a href="{{ route('root.userRoot.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-user"></i>
                    <div data-i18n="Analytics">Semua Pengguna</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('commentRoot') ? 'active' : '' }}">
                <a href="{{ route('root.commentRoot.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-comment"></i>
                    <div data-i18n="Analytics">Semua Komentar</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('reportRoot') ? 'active' : '' }}">
                <a href="{{ route('root.reportRoot.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-report"></i>
                    <div data-i18n="Analytics">Semua Laporan</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('submissionRoot') ? 'active' : '' }}">
                <a href="{{ route('root.submissionRoot.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-report"></i>
                    <div data-i18n="Analytics">Semua Permintaan</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('categoryRoot') ? 'active' : '' }}">
                <a href="{{ route('root.categoryRoot.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-category    "></i>
                    <div data-i18n="Analytics">Semua Kategori</div>
                </a>
            </li>
        </ul>
    @else
        <ul class="menu-inner py-1">
            <li class="menu-item {{ Request::is('admin') ? 'active' : '' }}">
                <a href="{{ route('normal.admin.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('news') ? 'active' : '' }}">
                <a href="{{ route('normal.news.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-news"></i>
                    <div data-i18n="Analytics">Berita Anda</div>
                </a>
            </li>
            <li class="menu-item {{ Request::is('report') ? 'active' : '' }}">
                <a href="{{ route('normal.news.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-news"></i>
                    <div data-i18n="Analytics">Laporan</div>
                </a>
            </li>
        </ul>
    @endif
</aside>
