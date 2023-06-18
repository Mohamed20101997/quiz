@extends('layouts.front.app')

@section('content')


    <!-- Start Main Banner Area -->
    <div class="main-banner">
        <div class="main-banner-item banner-item-three">
            <div class="d-table">
                <div class="d-table-cell">
                    @if(count($subjects) > 0)
                            <div class="main-banner-content">
                                <div class="container" style="margin-top: -130px">
                                    @foreach($subjects as $subject)
                                    <a class="btn btn-primary my-2" href="{{route('exam' , $subject->id)}}">{{$subject->name}}</a>
                                    @endforeach
                                </div>
                            </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="main-banner-shape">
            <div class="banner-bg-shape">
                <img src="{{asset('')}}/assets/img/main-banner/banner-bg-shape-1.png" class="white-image" alt="image">
                <img src="{{asset('')}}/assets/img/main-banner/banner-bg-shape-1-dark.png" class="black-image" alt="image">
            </div>

            <div class="banner-bg-shape-2">
                <img src="{{asset('')}}/assets/img/main-banner/banner-bg-shape-2.png" class="white-image" alt="image">
                <img src="{{asset('')}}/assets/img/main-banner/banner-bg-shape-2-dark.png" class="black-image" alt="image">
            </div>

        </div>
    </div>
    <!-- End Main Banner Area -->


@endsection

