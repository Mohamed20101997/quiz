@extends('layouts.dashboard.app')

@section('content')
    <h1>المتدربين</h1>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">الصفحه الرئيسيه</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">المتدربين</a></li>
        <li class="breadcrumb-item" active>إضافه</li>
    </ul>


    <div class="row">
        <div class="col-md-12">

            <div class="tile mb4">
                <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <div class="row mt-4 ">
                        <div class="col-md-4">
                            {{-- country --}}
                            <div class="form-group">
                                <label>الاسم</label>
                                <input type="text" name="name" placeholder="اضافة الاسم" class="form-control" required value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            {{-- country --}}
                            <div class="form-group">
                                <label>البريد الالكتروني</label>
                                <input type="email" name="email" placeholder="اضافة الاسم" class="form-control" required value="{{ old('email') }}">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            {{-- country --}}
                            <div class="form-group">
                                <label>الصلاحية</label>
                                <select name="role" class="form-control" required>
                                    <option value="">اختر</option>
                                    <option value="teacher" {{old('role') == 'teacher' ? 'selected' : ''}}>مدرس</option>
                                    <option value="student" {{old('role') == 'student' ? 'selected' : ''}}>متدرب</option>
                                </select>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div> {{-- end of row --}}

                    <div class="row">
                        <div class="col-md-6">
                            {{-- Password --}}
                            <div class="form-group">
                                <label>الرقم السري</label>
                                <input type="password" placeholder="اضافة الرقم السري" required
                                       name="password" class="form-control">
                                @error('password')
                                <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>{{-- end of col Password --}}

                        <div class="col-md-6">
                            {{-- Password confirmation --}}
                            <div class="form-group">
                                <label>تاكيد الرقم السري</label>
                                <input type="password" name="password_confirmation" placeholder="اضافة الرقم السري"
                                       required class="form-control">
                            </div>
                        </div>{{-- end of col Password confirmation --}}

                    </div>{{-- end of row --}}

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>إضافه</button>
                    </div>
                </form>

            </div> {{-- end of tile --}}

        </div> {{-- end of col --}}
    </div> {{-- end of row --}}


@endsection
