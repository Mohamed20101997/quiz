

@if(count($subjects) > 0)
    <option value="0">اختر مادة</option>
    @foreach($subjects as $subject)
        <option value="{{$subject->id}}" >{{$subject->name}}</option>
    @endforeach
@endif
