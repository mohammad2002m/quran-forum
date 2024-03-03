<div>
    @auth
        <nav class="navbar navbar-expand-lg border-bottom">
            <div class="container">
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
                    aria-controls="menu" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" height="22" width="22" viewBox="0 0 448 512">
                        <path
                            d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                    </svg>
                </button>
                <a class="navbar-brand py-0 " href="#">
                    <img class="d-none d-lg-inline-block" src="{{ asset('assets/images/logo.png') }}" alt="Logo"
                        width="26" height="30">
                    ملتقى القرآن الكريم
                </a>

                <div class="nav dropdown text-end order-lg-last">
                    <a href="#"
                        class="d-block link-body-emphasis text-decoration-none dropdown-toggle dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user() -> profile_image -> full_path}}" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end">
                        <li><a class="dropdown-item" href="/profile"> الصفحة الشخصية </a></li>
                        <li>
                            <a class="dropdown-item"  href="/announcement/create"> إنشاء إعلان جديد </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="/logout"> تسجيل خروج </a>
                        </li>
                    </ul>
                </div>

                <div class="collapse navbar-collapse" id="menu">
                    <!-- FIXME: should show choices based on the role -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/"> الصفحة الرئيسية </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/messages/index"> الرسائل </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/management/index"> الإدارة </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/week/edit"> الأسابيع </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/group/index"> الحلقات </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/recitation/index"> الإشراف </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/report/index"> التقارير  </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"> الأرشيف </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    @else
        <nav class="navbar navbar-expand-lg  shadow-sm">
            <div class="container">
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#menu-authed" aria-controls="menu" aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" height="22" width="22" viewBox="0 0 448 512">
                        <path
                            d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                    </svg>
                </button>
                <a class="navbar-brand py-0 " href="#">
                    <img class="d-none d-lg-inline-block" src="{{ asset('assets/images/logo.png') }}" alt="Logo"
                        width="26" height="30">
                    ملتقى القرآن الكريم
                </a>
                <img class="d-lg-none" src="{{ asset('assets/images/logo.png') }}" alt="Logo" width="26"
                    height="30">

                <div class="collapse navbar-collapse" id="menu-authed">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/"> الصفحة الرئيسية </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"> الأرشيف </a>
                        </li>
                        
                    </ul>

                    <div class="d-flex gap-2">
                        <a href="/registration/guide" class="btn btn-outline-primary"> إنشاء حساب </a>
                        <a href="/login" class="btn btn-primary"> تسجيل دخول </a>
                    </div>
                </div>
            </div>
        </nav>

    @endauth
</div>
