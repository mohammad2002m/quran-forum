@extends('layouts.app')

@section('head')
    <title> الصفحة الشخصية </title>
    <style>
        .cover-image {
            background-image: url({{ Auth::user() -> cover_image -> full_path}});
            background-repeat: no-repeat;
            background-size: cover;
            height: 400px; 
        }

        @media screen and (max-width: 900px){
            .cover-image {
                height: 300px;
            }
        }
    </style>
@endsection


@section('content')

    <div class="container p-0">
        <section>

            <div class="cover-image position-relative p-0">
                <div class="position-absolute top-100 start-50 translate-middle-x">
                </div>
            </div>
            <a href="/profile/change/cover-image" > change cover </a>
            <a href="/profile/change/profile-image" > change profile </a>

        </section>

        
    </div>
@endsection
