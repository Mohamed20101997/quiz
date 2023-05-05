@extends('layouts.dashboard.app')

@section('content')
    <h1>الأسئلة</h1>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">الصفحه الرئيسيه</a></li>
        <li class="breadcrumb-item"><a href="{{ route('question.index') }}">الأسئلة</a></li>
        <li class="breadcrumb-item" active>إضافه</li>
    </ul>


    <div class="row">
        <div class="col-md-12">

            <div class="tile mb4">
                <form method="POST" action="{{ route('question.update' , $question->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row mt-4 ">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label>السؤال</label>
                                <textarea  name="question" placeholder="اضافة سؤال" class="form-control" required>{{ old('question', $question->question) }}</textarea>
                                @error('question')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>




                    <div class="row mt-4 ">
                        <div class="col-md-4">

                            <div class="form-group">
                                <label>نوع السؤال</label>
                                <select name="type" class="form-control" required id="type">
                                    <option value="">اختر نوع السؤال</option>
                                    <option value="mcq" {{old('type',$question->type) == 'mcq' ? 'selected' : ''}}>اختيارات</option>
                                    <option value="true_false" {{old('type', $question->type) == 'true_false' ? 'selected' : ''}}>صح و خطأ</option>
                                </select>
                                @error('type')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label>درجة السؤال</label>
                                <input type="number" min="1" name="degree" placeholder="اضافة درجة السؤال" class="form-control" required value="{{ old('degree',optional($question->questionSubject)->degree) }}">
                                @error('degree')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group">
                                <label>المواد</label>
                                <select name="subject_id" class="form-control" required>
                                    <option value="">اختر مادة</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}" {{old('subject_id', optional($question->questionSubject)->subject_id) == $subject->id ? 'selected' : ''}}>{{$subject->name}}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div> {{-- end of row --}}


                    <div class="row mt-4 true_false">
                        <div class="col-md-6">
                            <div class="form-group d-flex justify-content-around">
                                <label>الإجابة</label>
                                @error('answer')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-check d-flex align-items-center">
                                    <input class="ml-2" style="width: 20px;height: 20px" type="radio" name="answer" id="answer" value="true" {{old('answer' , optional($question->questionSubject)->answer) == 'true' ? 'checked='.'"'.'checked'.'"' : '' }} >
                                    <label class="form-check-label" for="answer" style="font-size: 20px">
                                        صح
                                    </label>
                                </div>

                                <div class="form-check d-flex align-items-center">
                                    <input class="ml-2" style="width: 20px;height: 20px" type="radio" name="answer" id="answer" value="false" {{old('answer' , optional($question->questionSubject)->answer) == 'false' ? 'checked='.'"'.'checked'.'"' : '' }} >
                                    <label class="form-check-label" for="answer" style="font-size: 20px">
                                        خطأ
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 mcq">
                        <div class="col-md-6">
                            <div class="form-group d-flex justify-content-around">
                                <label>الإجابة</label>
                                @error('answer')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-check d-flex align-items-center">
                                    <input class="ml-2" style="width: 20px;height: 20px" type="radio" name="answer" id="answer" value="a" {{old('answer' , optional($question->questionSubject)->answer) == 'a' ? 'checked='.'"'.'checked'.'"' : '' }} >
                                    <label class="form-check-label" for="answer" style="font-size: 20px">
                                        A
                                    </label>
                                </div>

                                <div class="form-check d-flex align-items-center">
                                    <input class="ml-2" style="width: 20px;height: 20px" type="radio" name="answer" id="answer"  value="b" {{old('answer' , optional($question->questionSubject)->answer) == 'b' ? 'checked='.'"'.'checked'.'"' : '' }} >
                                    <label class="form-check-label" for="answer" style="font-size: 20px">
                                        B
                                    </label>
                                </div>

                                <div class="form-check d-flex align-items-center">
                                    <input class="ml-2" style="width: 20px;height: 20px" type="radio" name="answer" id="answer"  value="c" {{old('answer' , optional($question->questionSubject)->answer) == 'c' ? 'checked='.'"'.'checked'.'"' : '' }} >
                                    <label class="form-check-label" for="answer" style="font-size: 20px">
                                        C
                                    </label>
                                </div>


                                <div class="form-check d-flex align-items-center">
                                    <input class="ml-2" style="width: 20px;height: 20px" type="radio" name="answer" id="answer"  value="d" {{old('answer' , optional($question->questionSubject)->answer) == 'd' ? 'checked='.'"'.'checked'.'"' : '' }} >
                                    <label class="form-check-label" for="answer" style="font-size: 20px">
                                        D
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>



                    <table class="mcq">
                        <tr>
                            <td  style="width:5%"><strong> : الاختيار A</strong></td>
                            <td style="width:90%">
                                <textarea  name="choice_a" class="form-control" >{{ old('choice_a' , optional($question->mcq)->choice_A) }}</textarea>
                                @error('choice_a')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>

                        <tr>
                            <td  style="width:5%"><strong> : الاختيار B</strong></td>
                            <td style="width:90%">
                                <textarea  name="choice_b" class="form-control" >{{ old('choice_b',optional($question->mcq)->choice_B) }}</textarea>
                                @error('choice_b')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>

                        <tr>
                            <td  style="width:5%"><strong> : الاختيار C</strong></td>
                            <td style="width:90%">
                                <textarea  name="choice_c" class="form-control" >{{ old('choice_c',optional($question->mcq)->choice_C) }}</textarea>
                                @error('choice_c')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>

                        <tr>
                            <td  style="width:5%"><strong> : الاختيار D</strong></td>
                            <td style="width:90%">
                                <textarea  name="choice_d" class="form-control" >{{ old('choice_d',optional($question->mcq)->choice_D) }}</textarea>
                                @error('choice_d')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </td>
                        </tr>
                    </table>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>تعديل</button>
                    </div>
                </form>

            </div> {{-- end of tile --}}

        </div> {{-- end of col --}}
    </div> {{-- end of row --}}

@endsection

@section('script')
    <script>


        $(document).ready(function() {

            if($('#type').val() == 'mcq'){
                $('.mcq').show();
                $('.true_false').hide();
            }else if($('#type').val() =='true_false'){
                $('.mcq').hide();
                $('.true_false').show();
            }else{
                $('.mcq').hide();
                $('.true_false').hide();
            }

            $('#type').on('change', function() {
                var value = this.value;
                if(value =='mcq') {
                    $('.mcq').show();
                    $('.true_false').hide();

                }else if(value =='true_false'){
                    $('.mcq').hide();
                    $('.true_false').show();
                }else{
                    $('.mcq').hide();
                    $('.true_false').hide();
                }
            });
        });
    </script>
@endsection
