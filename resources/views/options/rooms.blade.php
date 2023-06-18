

@if($room)
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <form method="post" id="room-form" class="row"  >
                        @csrf
                        @method('post')
                        <ul id="validation-errors" class="px-5 alert alert-danger"></ul>

                        <input name="room_id" id="room_id" type="text" class="form-control my-2" placeholder="رقم الغرفة">
                        <button type="submit" data-url="{{route('exam.front')}}" id="btnRoom" class="btn btn-primary my-2">ادخال</button>
                    </form>

                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">المدرس :{{$room->exam->subject->user->name}} </li>
                    <li class="list-group-item">الماده :{{$room->exam->subject->name}} </li>
                    <li class="list-group-item">الامتحان : {{$room->exam->title}}</li>
                    <li class="list-group-item">المدة  :{{$room->exam->duration}} </li>
                </ul>
                <div class="card-footer text-bg-warning">لديك مرة واحده لإجراء الامتحان </div>
            </div>
        </div>
    </div>
@else
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">

                <div class="card-footer text-bg-warning">لا يوجد غرف امتحانات</div>
            </div>
        </div>
    </div>
@endif
