@extends('layouts.app')

@section('head')
    <title> الأرشيف </title>

    <style>
        a {
            text-decoration: none;
            color: black;
        }
    </style>
@endsection


@section('content')

    <div class="container mt-3">
        <div class="mb-3">
            <div class="d-flex gap-2">
                <input type="text" class="form-control" id="search-input">
                <button class="btn btn-primary" id="search-button">ابحث</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-3">
                    <a href="">
                        <img src="https://picsum.photos/500/500.jpg" class="card-img-top" alt="Placeholder Image">
                        <div class="card-body">
                            <p class="card-text">The final card with additional content.</p>
                            <a href="#" class="btn btn-success">Read More</a>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
