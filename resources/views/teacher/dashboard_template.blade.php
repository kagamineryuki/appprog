<style>

    #sidebar {
        width: 30vw;
    }
</style>

<nav class="navbar navbar-light bg-dark d-flex justify-content-between">
    <div>
        <a class="navbar-brand text-light">{{config('app.name')}}</a>
    </div>

    <div>
        <label class="navbar-brand text-light m-0"><strong>Teacher</strong></label>
    </div>

    <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-light rounded border border-white p-2" href="#" id="navbarDropdown"
           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::guard('teacher')->user()->nama }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/teacher/teacher_dashboard/logout">Logout</a>
        </div>
    </div>

</nav>

<div class="d-flex">
    <div class="bg-light align-items-stretch" id="sidebar">
        <ul class="list-group">
            <a href="/teacher/teacher_dashboard">
                <li class="list-group-item {{Request::is('teacher/teacher_dashboard')? 'active' : '' }}">Dashboard</li>
            </a>

            <a href="/teacher/teacher_dashboard/generate_qr_code">
                <li class="list-group-item {{Request::is('teacher/teacher_dashboard/generate_qr_code')? 'active' : '' }}">Generate QR Code</li>
            </a>

            <a href="/teacher/teacher_dashboard/history">
                <li class="list-group-item {{Request::is('teacher/teacher_dashboard/history')? 'active' : '' }}">History</li>
            </a>

        </ul>
    </div>

    @yield('content-div')

</div>