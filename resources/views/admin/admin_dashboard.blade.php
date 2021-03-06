@extends('template')
@extends('admin.dashboard_template')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
@endsection

@section('content')
@section('content-div')

    <div class="bg-white container-fluid align-items-stretch p-4" id="contents-dashboard">
        <h1 class="display-4">All Available Data</h1>
        <hr>
        <div class="d-flex">
            <div class="mr-5">
                <h1 class="display-4">Students</h1>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">NISN</th>
                        <th scope="col">Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{$student->nisn}}</td>
                            <td>{{$student->nama}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mr-5">
                <h1 class="display-4">Teacher</h1>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">NIGN</th>
                        <th scope="col">Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($teachers as $teacher)
                        <tr>
                            <td>{{$teacher->nign}}</td>
                            <td>{{$teacher->nama}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mr-5">
                <h1 class="display-4">Lessons</h1>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Lesson Code</th>
                        <th scope="col">Lesson Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pelajaran as $pelajaran)
                        <tr>
                            <td>{{$pelajaran->kode_pelajaran}}</td>
                            <td>{{$pelajaran->nama_pelajaran}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div>
                <h1 class="display-4">Class</h1>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Class Code</th>
                        <th scope="col">Class Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($kelas as $kelas)
                        <tr>
                            <td>{{$kelas->kode_kelas}}</td>
                            <td>{{$kelas->nama_kelas}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection
@endsection