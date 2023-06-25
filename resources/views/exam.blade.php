<div class="main-banner-item banner-item-three"  style="height: 430vh">
    <div class="container" style="padding-top: 80px">

        <input type="hidden" id="exam_duration" value="{{$exam->duration}}">
        <div class="header">
            <div class="row">
                <div class="col-md-3">
                    <strong>الامتحان</strong> :{{ $exam->title }}
                </div>
                <div class="col-md-3">
                    <strong>الماده</strong> : {{ $exam->subject->name }}
                </div>
                <div class="col-md-3">
                    <strong>المدة</strong> : {{ $exam->duration }} دقيقة
                </div>
                <div class="col-md-3">
                    <strong>المدرس</strong> : {{ $exam->subject->user->name }}
                </div>
                <div id="countdown" style="text-align: center" class="my-3 alert alert-primary"></div>
            </div>
        </div>

        <div class="content">

            <form action="{{ route('results') }}" method="post" id="examForm">

                <input type="hidden" name="exam_id" value="{{$exam->id}}">
                <input type="hidden" name="subject_id" value="{{$exam->subject->id}}">

                @csrf
                @method('post')
                @if (count($exam->subject->questionSubject) > 0)

                    @foreach ($exam->subject->questionSubject as $questionSubject)
                        <div class="question">
                            <div class="row">
                                <p>الدرجة : {{ $questionSubject->degree }}</p>
                                <p>{{ $questionSubject->question->question }}</p>
                            </div>

                            <div class="row">
                                @if ($questionSubject->question->type == 'mcq')
                                    <div class="col-md-6 d-flex align-items-center">
                                        <label>A</label>
                                        <input type="radio" name="{{$questionSubject->question->id}}" value="a">
                                        <p>{{ $questionSubject->question->mcq->choice_A }}</p>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center">
                                        <label>B</label>
                                        <input type="radio" name="{{$questionSubject->question->id}}"  value="b">
                                        <p>{{ $questionSubject->question->mcq->choice_B }}</p>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center">
                                        <label>C</label>
                                        <input type="radio" name="{{$questionSubject->question->id}}" value="c">
                                        <p>{{ $questionSubject->question->mcq->choice_C }}</p>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center">
                                        <label>D</label>
                                        <input type="radio" name="{{$questionSubject->question->id}}" value="d">
                                        <p>{{ $questionSubject->question->mcq->choice_D }}</p>
                                    </div>
                                @else
                                    <div class="col-md-6 d-flex align-items-center">
                                        <label>صح</label>
                                        <input type="radio" name="{{$questionSubject->question->id}}" value="true">
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center">
                                        <label>خطأ</label>
                                        <input type="radio" name="{{$questionSubject->question->id}}" value="false">
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endforeach

                @endif

                <button id="endExam" type="submit" class="btn btn-primary my-5">إنهاء</button>

            </form>


        </div>
    </div>
</div>

