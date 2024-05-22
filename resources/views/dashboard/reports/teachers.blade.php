@extends('layouts.dashboard.app')

@section('style')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #print-section, #print-section * {
            visibility: visible;
        }
        #print-section {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .table {
            width: 100%;
        }
        .breadcrumb, .btn {
            display: none;
        }
    }
</style>
@endsection
@section('content')

    <h1>تقارير الدكاتره</h1>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">الصفحه الرئيسيه </a></li>
        <li class="breadcrumb-item" active>تقارير الدكاتره</li>
    </ul>


    <div class="row">
        <div class="col-md-12">

            <div class="tile mb-4">
                <div class="row mb-2">
                    <div class="col-md-12 text-right">
                        <button class="btn btn-primary" onclick="printTable()">طباعه</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if ($teachers->count() > 0)
                            <div class="table-responsive"  id="print-section">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الدكتور</th>
                                        <th>البريد الالكتروني</th>
                                        <th>المواد</th>
                                        <th>الامتحانات</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($teachers as $index=>$teacher)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{$teacher->name}}</td>
                                            <td>{{$teacher->email}}</td>
                                            <td>
                                                @if (count($teacher->subjects) > 0)
                                                    @foreach ($teacher->subjects as $subject)
                                                         - {{ $subject->name }}   <br>
                                                    @endforeach
                                                @endif
                                            </td>

                                            <td>
                                                @if (count($teacher->exams) > 0)
                                                    @foreach ($teacher->exams as $exam)
                                                         - {{ $exam->title }}   <br>
                                                    @endforeach
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $teachers->appends(request()->query())->links() }}

                        @else
                            <h3 class="alert alert-info text-center d-flex justify-content-center" style="margin: 0 auto; font-weight: 400"><i class="fa fa-exclamation-triangle"></i> لا يوجد اي بيانات للعرض</h3>
                        @endif
                    </div> <!-- end of col-md-12 -->
                </div> <!-- end of row -->

            </div> <!-- end of tile -->

        </div> {{-- end of col  --}}
    </div> {{-- end of row  --}}
@endsection
@section('script')
<script type="text/javascript">
    function printTable() {
        window.print();
    }
</script>
@endsection
