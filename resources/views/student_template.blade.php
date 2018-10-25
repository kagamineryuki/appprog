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
        <label class="navbar-brand text-light m-0"><strong>Student</strong></label>
    </div>

    <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-light rounded border border-white p-2" href="#" id="navbarDropdown"
           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::guard('student')->user()->nama }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/student/student_dashboard/student_profile">Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/student/student_dashboard/logout">Logout</a>
        </div>
    </div>

</nav>

    @yield('content-div')

</div>