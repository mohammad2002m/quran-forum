@extends('layouts.app')

@section('head')
    <title> إعلان </title>
    <style>

    </style>
@endsection

@section('content')
    <!-- End -->

    <div class="container main-container mt-4">
        <div class="row">
            <div class="col-lg-8 col-md-8 mb-4">
                <div class="d-flex justify-contenct-center align-items-center mb-3 rounded position-relative overflow-hidden">
                    <img src="{{ $announcement->image->full_path }}" class="w-100">
                    @if (Auth::check() && isUserAllowedToDoActivity(Auth::user()->id, $QFConstants::ACTIVITY_MANAGE_ANNOUNCEMENT))
                        <button class="position-absolute btn btn-close fs-4" style="top: 15px; left: 15px;" data-bs-toggle="modal" data-bs-target="#confirm-delete"></button>
                    @endif

                </div>
                <h3 class="mb-4"> {{ $announcement->title }}</h3>
                <p> {{ $announcement->description }} </p>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5> هل قلت اليوم </h5>
                    </div>
                    <div class="card-body">
                        <ul id="here"> </ul>
                        <script>
                            var element = document.getElementById('here');
                            var sayings = [
                                "اللهم صلي على سيدنا محمد وعلى آله وصحبه ",
                                "سبحان الله وبحمده عدد خلقه ورضا نفسه وزنة عرشه ومداد كلماته",
                                "الله أكبر والحمد ولا إله إلا الله والله أكبر",
                                "لا حول ولا قوة إلا بالله العلي العظيم",
                                "أستغفر الله العظيم وأتوب إليه إني كنت من الظالمين",
                            ]

                            // choose one saying randomly

                            randomIndex = Math.floor(Math.random() * sayings.length);
                            var li = document.createElement('li');
                            li.innerHTML = sayings[randomIndex];
                            element.appendChild(li);
                        </script>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h5> تابعونا على </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn"><i class="bi bi-facebook fs-3"></i></a>
                            <a href="#" class="btn"><i class="bi bi-telegram fs-3"></i></a>
                            <a href="#" class="btn"><i class="bi bi-instagram fs-3"></i></a>
                            <a href="#" class="btn"><i class="bi bi-youtube fs-3"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header">
                        <h5> آخر الإعلانات </h5>
                    </div>
                    <div class="card-body">
                        <ul id="last-announcements">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::check() && isUserAllowedToDoActivity(Auth::user()->id, $QFConstants::ACTIVITY_MANAGE_ANNOUNCEMENT))
        <div id="confirm-delete" class="modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> تأكيد حذف الإعلان </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p> هل أنت متأكد من أنك تريد حذف الإعلان </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> إلغاء </button>
                        <form action="/announcement/delete" method="POST">
                            @csrf
                            <input name="announcement_id" type="text" value={{ $announcement->id }} hidden>
                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal"> حذف </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection


@section('scripts')
    <script>
        async function fetchAnnouncements() {
            var url = '/api/announcements/0'; // fetch the first batch
            var response = await fetch(url);
            var data = await response.json();
            return data;
        }

        function formatDate(inputDate) {
            // Create a new Date object from the input string
            const date = new Date(inputDate);

            // Format the date using toLocaleDateString with options
            const formattedDate = date.toLocaleDateString('ar-eg', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            return formattedDate;
        }
        async function renderLastAnnouncements(announcements) {
            var ul = document.getElementById('last-announcements');
            var announcements = await fetchAnnouncements();
            // take only 5 elements
            announcements = announcements.slice(0, 5);
            announcements.forEach(announcement => {
                var li = document.createElement('li');
                li.innerHTML = `
                <a href='/announcement/show/${announcement.id}' class="btn text-decoration-none fw-semibold"> <span> ${announcement.title} </span>  </a>
                <p class="text-muted"> ${formatDate(announcement.created_at)} </p>
            `;
                ul.appendChild(li);
            });
        }

        (async function() {
            await renderLastAnnouncements();
        })();
    </script>
@endsection
