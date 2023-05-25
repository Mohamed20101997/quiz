@extends('layouts.dashboard.app')

@section('content')
    <h1>الغرف</h1>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">الصفحه الرئيسيه</a></li>
        <li class="breadcrumb-item"><a href="{{ route('room.index') }}">الغرف</a></li>
        <li class="breadcrumb-item" active>تعديل</li>
    </ul>


    <div class="row">
        <div class="col-md-12">

            <div class="tile mb4">
                <form method="POST" action="{{ route('room.update', $room->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row mt-4 ">
                        <div class="col-md-4">
                            {{-- country --}}
                            <div class="form-group">
                                <label>رقم الغرفة </label>
                                <input type="text" name="password" placeholder="اضافة رقم الغرفة" class="form-control" required value="{{ old('password', $room->password) }}">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{-- exams --}}
                            <div class="form-group">
                                <label>الامتحانات</label>
                                <select name="exam_id" class="form-control" required>
                                    <option value="">اختر امتحان</option>
                                    @foreach($exams as $exam)
                                        <option value="{{$exam->id}}"  {{old('exam_id' , $room->exam->id) == $exam->id ? 'selected' : ''}}>{{$exam->title}}</option>
                                    @endforeach
                                </select>
                                @error('exam_id')
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
