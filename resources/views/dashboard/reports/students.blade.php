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

    <h1>تقارير المتدربين</h1>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">الصفحه الرئيسيه </a></li>
        <li class="breadcrumb-item" active>تقارير المتدربين</li>
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
                        @if ($students->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover"  id="print-section">
                                    <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>اسم المتدرب</th>
                                        <th>البريد الالكتروني</th>
                                        <th>اسم الدكتور</th>
                                        <th>المادة</th>
                                        <th>الامتحان</th>
                                        <th>المدة الزمنيه </th>
                                        <th>درجة الامتحان</th>
                                        <th>درجة المتدرب</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($students as $index=>$student)
                                        <tr class="text-center">
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ optional($student->user)->name  }}</td>
                                            <td>{{ optional($student->user)->email  }}</td>
                                            <td>{{ optional($student->exam)->teacher->name  }}</td>
                                            <td>{{ optional(optional($student->exam)->subject)->name  }}</td>
                                            <td>{{ optional($student->exam)->title  }}</td>
                                            <td>{{ optional($student->exam)->duration  }} دقائق</td>
                                            <td>{{ optional($student->exam)->degree  }}</td>
                                            <td>{{ $student->degree  }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $students->appends(request()->query())->links() }}

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
