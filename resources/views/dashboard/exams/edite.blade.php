@extends('layouts.dashboard.app')

@section('content')
    <h1>الامتحانات</h1>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">الصفحه الرئيسيه</a></li>
        <li class="breadcrumb-item"><a href="{{ route('exam.index') }}">الامتحانات</a></li>
        <li class="breadcrumb-item" active>تعديل</li>
    </ul>


    <div class="row">
        <div class="col-md-12">

            <div class="tile mb4">
                <form method="POST" action="{{ route('exam.update', $exam->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row mt-4 ">
                        <div class="col-md-4">
                            {{-- country --}}
                            <div class="form-group">
                                <label>عنوان الامتحان</label>
                                <input type="text" name="title" placeholder="اضافة الاسم" class="form-control" required value="{{ old('title', $exam->title) }}">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{-- country --}}
                            <div class="form-group">
                                <label>المدة الزمنية / دقيقة</label>
                                <input type="number" min="1" name="duration" placeholder="اضافة الاسم" class="form-control" required value="{{ old('duration', $exam->duration) }}">
                                @error('duration')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{-- country --}}
                            <div class="form-group">
                                <label>المواد</label>
                                <select name="subject_id" class="form-control" required>
                                    <option value="">اختر مادة</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{$subject->id}}" {{old('subject_id' , $exam->subject->id) == $subject->id ? 'selected' : ''}}>{{$subject->name}}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div> {{-- end of row --}}


                    <hr class="mt-4 mb-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>تحديث</button>
                    </div>
                </form>

            </div> {{-- end of tile  --}}

        </div> {{-- end of col  --}}
    </div> {{-- end of row  --}}


@endsection
