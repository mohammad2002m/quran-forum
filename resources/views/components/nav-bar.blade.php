<div>

    @auth
        <nav class="navbar navbar-expand-lg shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
                    aria-controls="menu" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a class="navbar-brand py-0 m-0" href="/">
                    <img class="d-none d-lg-inline-block" src="{{ asset('assets/images/logo.png') }}" alt="Logo"
                        width="26" height="30">
                        ملتقى القرآن الكريم
                </a>

                <div class="nav dropdown text-end order-lg-last">
                    <a href="#"
                        class="d-block link-body-emphasis text-decoration-none dropdown-toggle dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user()->profile_image->full_path }}" width="32" height="32"
                            class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end">
                        <li><a class="dropdown-item" href="/profile"> الصفحة الشخصية </a></li>
                        @if (isUserAllowedToDoActivity(Auth::user()->id, $QFConstants::ACTIVITY_MANAGE_ANNOUNCEMENT))
                            <li> <a class="dropdown-item" href="/announcement/create"> إنشاء إعلان جديد </a> </li>
                        @endif
                        @if (isUserAllowedToDoActivity(Auth::user()->id, $QFConstants::ACTIVITY_UPLOAD_IMAGE))
                            <li> <a class="dropdown-item" href="/image/upload/index"> رفع صورة جديدة </a> </li>
                        @endif
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="/logout"> تسجيل خروج </a>
                        </li>
                    </ul>
                </div>

                <div class="collapse navbar-collapse ms-3" id="menu">
                    <!-- FIXME: should show choices based on the role -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="/"> الصفحة الرئيسية </a>
                        </li>

                        @if (isUserAllowedToDoActivity(Auth::user()->id, $QFConstants::ACTIVITY_MANAGE_FORUM))
                            <li class="nav-item"> <a class="nav-link" href="/management/index"> الإدارة </a> </li>
                        @endif

                        @if (isUserAllowedToDoActivity(Auth::user()->id, $QFConstants::ACTIVITY_MANAGE_WEEKS))
                            <li class="nav-item"> <a class="nav-link" href="/week/edit"> الأسابيع </a> </li>
                        @endif

                        @if (isUserAllowedToDoActivity(Auth::user()->id, $QFConstants::ACTIVITY_MANAGE_GROUPS))
                            <li class="nav-item"> <a class="nav-link" href="/group/index"> الحلقات </a> </li>
                        @endif

                        @if (isUserAllowedToDoActivity(Auth::user()->id, $QFConstants::ACTIVITY_RECITATION))
                            <li class="nav-item"> <a class="nav-link" href="/recitation/index"> الإشراف </a> </li>
                        @endif

                        @if (isUserAllowedToDoActivity(Auth::user()->id, $QFConstants::ACTIVITY_MONITORING))
                            <li class="nav-item"> <a class="nav-link" href="/monitoring/index"> المتابعة </a> </li>
                        @endif


                        @if (isUserAllowedToDoActivity(Auth::user()->id, $QFConstants::ACTIVITY_REPORTS))
                            <li class="nav-item">
                                <a class="nav-link" href="/reports/index"> التقارير </a>
                            </li>
                        @endif

                        @if (isUserAllowedToDoActivity(Auth::user()->id, $QFConstants::ACTIVITY_APPLICATIONS))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    طلبات التطوع
                                </a>

                                <ul class="dropdown-menu">
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="/applications/index/supervising"> الإشراف</a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="/applications/index/monitoring"> المتابعة </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (isUserAllowedToDoActivity(Auth::user()->id, $QFConstants::ACTIVITY_USERS))
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    المستخدمين
                                </a>

                                <ul class="dropdown-menu">
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="/members/index"> الأعضاء </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="/formers/index"> المنسحبين </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (isUserAllowedToDoActivity(Auth::user()->id, $QFConstants::ACTIVITY_SUPERVISING_EXAMS))
                            <li class="nav-item">
                                <a class="nav-link" href="/exam/supervising/index"> اختبار المشرفين </a>
                            </li>
                        @endif

                        <li class="nav-item d-md-none"> <a class="nav-link" href="/contact-us"> اتصل بنا </a> </li>

                        <li class="nav-item d-sm-none"> <a class="nav-link" href="/about-us"> من نحن </a> </li>
                        <li class="nav-item d-md-none"> <a class="nav-link" href="/forum-rules"> قوانين الملتقى </a> </li>

                    </ul>

                </div>
            </div>
        </nav>
    @else
        <nav class="navbar navbar-expand-lg shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#menu-authed" aria-controls="menu" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand py-0 " href="/">
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

                        <li class="nav-item d-md-none"> <a class="nav-link" href="/contact-us"> اتصل بنا </a> </li>

                        <li class="nav-item d-sm-none"> <a class="nav-link" href="/about-us"> من نحن </a> </li>
                        <li class="nav-item d-md-none"> <a class="nav-link" href="/forum-rules"> قوانين الملتقى </a> </li>
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
