<html dir="rtl" lang="ar" direction="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap/icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2-bootstrap5-light-theme.css') }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    @yield('head')
</head>

<body>
    <script defer>
        function getTheme() {
            const defaultTheme = "light"
            return localStorage.getItem('theme') || defaultTheme
        }

        function setTheme(theme) {
            localStorage.setItem('theme', theme)
            document.documentElement.setAttribute('data-bs-theme', theme)
            document.documentElement.classList = theme
            additionalThemeChanges(theme); // won't work before the document is loaded
        }

        function additionalThemeChanges(theme){
            if (theme === 'light') {
                additionalLightThemeChanges()
            } else {
                additionalDarkThemeChanges()
            }
        }

        function additionalLightThemeChanges() {
            const tableHeads = document.querySelectorAll('thead')
            tableHeads.forEach((head) => {
                head.classList.remove('table-dark')
                head.classList.add('table-light')
            })

        }

        function additionalDarkThemeChanges() {
            const tableHeads = document.querySelectorAll('thead')
            tableHeads.forEach((head) => {
                head.classList.remove('table-light')
                head.classList.add('table-dark')
            })
        }

        function toggleTheme() {
            const oldTheme = getTheme()
            const newTheme = oldTheme === 'light' ? 'dark' : 'light'
            setTheme(newTheme)
        }

        (function initiateTheme(){
            const theme = getTheme();
            setTheme(theme);
            document.addEventListener("DOMContentLoaded", function() { additionalThemeChanges(theme) });
        })()
    </script>

    <x-top-bar />
    <x-nav-bar />

    <!-- main container is not used in anything yet -->
    <div class="wrapper">
        @yield('content')
    </div>


</body>

<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@yield('scripts')

</html>
