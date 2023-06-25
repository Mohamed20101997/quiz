@extends('layouts.front.app')

@section('content')

    <!-- Start Main Banner Area -->
    <div class="main-banner" id="main-banner">
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


                    <div class="card mb-5" style="width: 18rem;" >
                        <img class="card-img-top" src="{{asset('assets/img/user.png')}}" alt="student photo" style="width: 100px;margin: 0 auto;">
                        <div class="card-body">     
                          <h5 class="card-title">{{auth()->guard('student')->user()->name}}</h5>
                          <h6 class="card-subtitle mb-2 text-muted">{{auth()->guard('student')->user()->email}}</h6>
                        </div>
                      </div>

                    <table class="table table-striped" style="background: #FFF;">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">الامتحان</th>
                            <th scope="col">المادة</th>
                            <th scope="col">الدرجة</th>
                            <th scope="col">الدرجة النهائية</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if (count($StudentProfile) > 0)
                                @foreach ($StudentProfile as $key=>$profile)
                                    <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td>{{$profile->exam->title}}</td>
                                    <td>{{$profile->exam->subject->name}}</td>
                                    <td>{{$profile->degree}}</td>
                                    <td>{{$profile->exam->degree }}</td>
                                  </tr>
                                @endforeach
                            @endif

                        </tbody>
                      </table>

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
