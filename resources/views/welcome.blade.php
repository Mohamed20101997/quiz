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

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="color: #FFF">المدرسين</label>
                                    <select class="form-control" id="teachers">
                                        <option value="0">اختر مدرس</option>
                                        @if(count($teachers) > 0)
                                            @foreach($teachers as $teacher)
                                                <option name="teachers"
                                                        value="{{$teacher->id}}">{{$teacher->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="color: #FFF">المواد</label>
                                    <select class="form-control" id="subjects">

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="color: #FFF">الأمتحانات</label>
                                    <select class="form-control" id="exams">

                                    </select>
                                </div>
                            </div>
                        </div>


                       <section class="room-section p-5">

                       </section>
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
    <script>
        $(document).on('change', '#teachers', function () {
            var teacherId = $(this).val();
            if(teacherId == 0)
            {
                $('#subjects option').remove();
                $('#exams option').remove();
                $('.room-section').remove();
            }else{
                $.ajax({
                    url: `get-subjects/${teacherId}`,
                    method: 'get'
                    , success: function (result) {
                        $("#subjects").html(result);
                    }
                });
            }

        });

        $(document).on('change', '#subjects', function () {
            var subjectId = $(this).val();
            $.ajax({
                url: `get-exams/${subjectId}`,
                method: 'get'
                , success: function (result) {
                    $("#exams").html(result);
                }
            });
        });

        $(document).on('change', '#exams', function () {
            var examId = $(this).val();
            $.ajax({
                url: `get-rooms/${examId}`,
                method: 'get'
                , success: function (result) {
                    $(".room-section").html(result);
                }
            });
        });


        $(document).on('click', '#btnRoom', function (e) {
            e.preventDefault()
            var url = $(this).data('url');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                method: 'post',
                data:{
                    'room_id':$('#room_id').val(),
                    'user_id' : $('#teachers').val(),
                    'exam_id' : $('#exams').val()
                    }
                , success: function (response) {

                    if(response.status == 'error')
                    {
                        $('#validation-errors').append('<li>' + response.message + '</li>');
                    }else{
                        $("#main-banner").html(response);

                         // Get the duration from the exam table (assuming you have fetched it from the database)
                                var duration = $('#exam_duration').val() * 60; // Convert duration to seconds
                            // Calculate the end time
                            var endTime = new Date().getTime() + duration * 1000;

                            // Update the countdown every second
                            var countdownInterval = setInterval(function() {
                                var currentTime = new Date().getTime();
                                var remainingTime = Math.floor((endTime - currentTime) / 1000);

                                // Check if the countdown has reached zero
                                if (remainingTime <= 0) {
                                    clearInterval(countdownInterval);
                                    // Perform the action when the duration ends
                                    examDurationEnded();
                                } else {
                                    var minutes = Math.floor(remainingTime / 60);
                                    var seconds = remainingTime % 60;
                                    $('#countdown').text('الوقت المتبقي: ' + minutes + 'm ' + seconds + 's');
                                }
                            }, 1000);

                            // Perform the action when the duration ends
                            function examDurationEnded() {
                                $("#examForm").submit(); // Submit the form
                            }
                    }


                },error:function(response){
                    var errors = response.responseJSON.errors;
                    $('#validation-errors').html('');

                    $.each(errors, function(key, value) {
                        $('#validation-errors').append('<li>' + value[0] + '</li>');
                    });
                }
            });
        });


        $('#endExam').click(function(e) {
            e.preventDefault(); // Prevents the default form submission

            // Display a confirmation dialog
            var confirmation = confirm("هل انت متأكد من انهاء الأمتحان ؟");

            // If the user confirms, submit the form
            if (confirmation) {
            $('#examForm').submit();
            }
        });


    </script>
@endsection
