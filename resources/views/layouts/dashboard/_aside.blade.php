<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user">
    <div>
      <p class="app-sidebar__user-name">{{auth()->user()->name}}</p>
      <p class="app-sidebar__user-designation">{{auth()->user()->email}}</p>
    </div>
  </div>
  <ul class="app-menu">

          <li><a class="app-menu__item  {{\Request::route()->getName() == 'admin' ? 'active' : ''}}" href="{{ route('welcome') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">الرئيسيه</span></a></li>
      @if($user->role == 'ادمن')
          <li><a class="app-menu__item  {{\Request::route()->getName() == 'user.index' ? 'active' : ''}}" href="{{ route('user.index') }}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">المتدربين</span></a></li>
          <li><a class="app-menu__item  {{\Request::route()->getName() == 'subject.index' ? 'active' : ''}}" href="{{ route('subject.index') }}"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">المواد</span></a></li>
          <li><a class="app-menu__item  {{\Request::route()->getName() == 'teacher.report' ? 'active' : ''}}" href="{{ route('teacher.report') }}"><i class="app-menu__icon fa fa-industry"></i><span class="app-menu__label">تقرير الدكاتره </span></a></li>
          <li><a class="app-menu__item  {{\Request::route()->getName() == 'student.report' ? 'active' : ''}}" href="{{ route('student.report') }}"><i class="app-menu__icon fa fa-industry"></i><span class="app-menu__label">تقرير المتدربين </span></a></li>

          @elseif($user->role == 'مدرس')

          <li><a class="app-menu__item  {{\Request::route()->getName() == 'exam.index' ? 'active' : ''}}" href="{{ route('exam.index') }}"><i class="app-menu__icon fa fa-clock-o"></i><span class="app-menu__label">الإمتحانات</span></a></li>
          <li><a class="app-menu__item  {{\Request::route()->getName() == 'question.index' ? 'active' : ''}}" href="{{ route('question.index') }}"><i class="app-menu__icon fa fa-clock-o"></i><span class="app-menu__label">الأسئلة</span></a></li>
          <li><a class="app-menu__item  {{\Request::route()->getName() == 'room.index' ? 'active' : ''}}" href="{{ route('room.index') }}"><i class="app-menu__icon fa fa-clock-o"></i><span class="app-menu__label">الغرف</span></a></li>
          <li><a class="app-menu__item  {{\Request::route()->getName() == 'student.report' ? 'active' : ''}}" href="{{ route('student.report') }}"><i class="app-menu__icon fa fa-industry"></i><span class="app-menu__label">تقرير المتدربين </span></a></li>

      @endif


  </ul>
</aside>
