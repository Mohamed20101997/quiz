@extends('layouts.dashboard.app')


@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{route('welcome')}}">Dashboard</a></li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-book fa-3x"></i>
                <div class="info">
                    <h4>المواد</h4>
                    <p>{{$subjects}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-info fa-3x"></i>
                <div class="info">
                    <h4>الامتحانات </h4>
                    <p>{{$exams}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-question-circle fa-3x"></i>
                <div class="info">
                    <h4>الأسئلة</h4>
                    <p>{{$questions}}</p>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-lg-4">
            <div class="widget-small warning  coloured-icon"><i class="icon fa  fa-lock fa-3x"></i>
                <div class="info">
                    <h4> الغرف </h4>
                    <p>{{$rooms}}</p>
                </div>
            </div>
        </div>



    </div>



@endsection
