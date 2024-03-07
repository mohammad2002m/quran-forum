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
                <select name="" id="" class="form-select">
                    <option value=""> الكل </option>
                    <option value=""> عام </option>
                    <option value=""> مسابقات </option>
                    <option value=""> ندوات </option>
                </select>
                <button class="btn btn-primary" id="search-button">ابحث</button>
            </div>
        </div>
        <div>
            <h4> الأرشيف </h4>
            <p> يحتوي على جميع الإعلانات مرتبة</p>
        </div>
    </div>
    
@endsection
