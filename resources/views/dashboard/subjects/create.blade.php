@extends('layouts.dashboard.app')

@section('content')
    <h1>المواد</h1>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">الصفحه الرئيسيه</a></li>
        <li class="breadcrumb-item"><a href="{{ route('subject.index') }}">المواد</a></li>
        <li class="breadcrumb-item" active>إضافه</li>
    </ul>


    <div class="row">
        <div class="col-md-12">

            <div class="tile mb4">
                <form method="POST" action="{{ route('subject.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <div class="row mt-4 ">
                        <div class="col-md-6">
                            {{-- country --}}
                            <div class="form-group">
                                <label>اسم المادة</label>
                                <input type="text" name="name" placeholder="اضافة الاسم" class="form-control" required value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            {{-- country --}}
                            <div class="form-group">
                                <label>المدرسين</label>
                                <select name="user_id" class="form-control" required>
                                    <option value="">اختر مدرس</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" {{old('user_id') == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div> {{-- end of row --}}


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>إضافه</button>
                    </div>
                </form>

            </div> {{-- end of tile --}}

        </div> {{-- end of col --}}
    </div> {{-- end of row --}}

@endsection
