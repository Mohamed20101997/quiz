@extends('layouts.front.app')

@section('content')

    <!-- Start Main Banner Area -->
    <div class="main-banner">
        <div class="main-banner-item banner-item-three">
            @if (!auth()->guard('student')->check())
                <div class="container" style="padding-top: 200px">
            @else
                <div class="container" style="padding-top: 80px">
            @endif
                <div class="">

                    @if (!auth()->guard('student')->check())
                        <div class="container" style="margin-top: -123px">
                            <div class="main-banner-content">
                                <div class="my-form" style="background: #222c5ab3;color: #FFF;padding: 40px;">

                                    <h2 style="color: #FFF">تسجيل الدخول</h2>
                                    @if($errors->any())
                                        <p class="alert alert-danger" style="color: #0a0a11">{{$errors->first()}}</p>
                                    @endif
                                    <form action="{{route('userLogin')}}" method="post">
                                        @csrf
                                        @method('POST')
                                        <div class="mb-3 mt-4">
                                            <label for="exampleInputEmail1" class="form-label">البريد الالكتروني</label>
                                            <input type="email" class="form-control" name="email"
                                                   aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3 mt-4">
                                            <label for="exampleInputPassword1" class="form-label">كلمة المرور</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <button type="submit" class="btn btn-light mt-3">دخول</button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    @else
                        <h1>Exam</h1>
                    @endif
                </div>
            </div>
        </div>

        <div class="main-banner-shape">
            <div class="banner-bg-shape">
                <img src="{{asset('')}}/assets/img/main-banner/banner-bg-shape-1.png" class="white-image" alt="image">
                <img src="{{asset('')}}/assets/img/main-banner/banner-bg-shape-1-dark.png" class="black-image"
                     alt="image">
            </div>

            <div class="banner-bg-shape-2">
                <img src="{{asset('')}}/assets/img/main-banner/banner-bg-shape-2.png" class="white-image" alt="image">
                <img src="{{asset('')}}/assets/img/main-banner/banner-bg-shape-2-dark.png" class="black-image"
                     alt="image">
            </div>

        </div>
    </div>
    <!-- End Main Banner Area -->

@endsection


@section('script')

@endsection
