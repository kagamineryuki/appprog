@extends('template')
@extends('teacher.dashboard_template')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
@endsection

@section('content')
@section('content-div')
    <div class="bg-white container-fluid align-items-stretch p-4" id="contents-dashboard">
        <h1 class="display-4">Attendances List</h1>
        <hr>
        <h4>Filter By:</h4>
        <form action="/teacher/teacher_dashboard/history" method="GET">
            {{csrf_field()}}
            {{--nisn--}}
            <div class="form-group">
                <label>NISN</label>
                <input type="text" id="nisn" name="nisn" class="form-control is-invalid" value="{{old('nisn')}}">
                <div class="invalid-feedback">
                    @if($errors->has('nisn'))
                        <p class="text-danger">{{$errors->first('nisn')}}</p>
                    @endif
                </div>
            </div>
            {{--tardiness--}}
            <div class="form-group">
                <label>Tardiness</label>
                <select id="tardiness" name="tardiness" class="form-control">
                    <option value="late">Late</option>
                    <option value="in time">In time</option>
                    <option value="on time">On time</option>
                </select>
            </div>
            {{--Submit--}}
            <input type="submit" class="btn btn-primary" value="Filter Result">
        </form>
        <hr>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <td>NISN</td>
                    <td>Student</td>
                    <td>Class</td>
                    <td>Teacher</td>
                    <td>Lesson</td>
                    <td>Registered At</td>
                    <td>Valid Until</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
            @foreach($query as $result)
                <tr>
                    <td>{{$result->nisn}}</td>
                    <td>{{$result->nama}}</td>
                    <td>{{$result->kelas}}</td>
                    <td>{{$result->pengampu}}</td>
                    <td>{{$result->pelajaran}}</td>
                    <td>{{$result->registered_at}}</td>
                    <td>{{$result->valid_until}}</td>
                    <td>{{strtoupper($result->status_hadir) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$query->links()}}
    </div>
@endsection
@endsection