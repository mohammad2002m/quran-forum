@extends('layouts.app')

@section('head')
    <title> من نحن </title>
@endsection


@section('content')
    <div class="container pt-4">
        <h3> من نحن </h3>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="1" class="head-cell"> الرقم </th>
                    <th colspan="2" class="head-cell"> الاسم </th>
                    <th colspan="2" class="head-cell"> البريد الإلكتروني </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users->take(8) as $user)
                    <tr>
                        <td colspan="1"> {{ $user->id }} </td>
                        <td colspan="2"> {{ $user->name }} </td>
                        <td colspan="2"> {{ $user->email }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <br>
        <p> password for all accounts is: mozart </p>
    </div>
    
@endsection
