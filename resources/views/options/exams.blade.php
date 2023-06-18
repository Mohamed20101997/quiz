

@if(count($exams) > 0)
    <option value="0">اختر امتحان</option>
    @foreach($exams as $exam)
        <option value="{{$exam->id}}" >{{$exam->title}}</option>
    @endforeach
@endif
