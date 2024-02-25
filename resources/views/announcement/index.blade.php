@extends('layouts.app')

@section('head')
    <title> الرئيسية </title>

@endsection


@section('content')
    <div class="container pt-4" style="padding-bottom: 100px;">
        <section class="mb-3">
            <div class="d-flex border-bottom">
                <div class="bg-primary py-1 px-4 text-center">
                    <span class="text-light"> تجويد </span>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center h-100">
                        <div class="ms-2">
                            <div>
                                من قرأ القرآن؛ فله بكل حرف حسنة، والحسنة بعشر أمثالها
                            </div>
                        </div>
                        <div>
                            <button class="btn p-1"> <i class="bi bi-chevron-right text-secondary"></i> </button>
                            <button class="btn p-1"> <i class="bi bi-chevron-left text-secondary"></i> </button>
                        </div>
                    </div>

                </div>
            </div>
        </section>



    </div>
@endsection