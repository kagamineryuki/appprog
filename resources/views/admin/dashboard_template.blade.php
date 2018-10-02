<style>
#contents-dashboard{
    height: 100vh;
}

#sidebar{
    height: 100vh;
    width: 30vw;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">I'm Here!</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>

<div class="d-flex">
    <div class="bg-light align-items-stretch" id="sidebar">
        <ul class="list-group">
            <a href="/admin/admin_dashboard"><li class="list-group-item {{Request::is('admin/admin_dashboard')? 'active' : '' }}">Dashboard</li></a>

            <a href="/admin/admin_dashboard/create_user"><li class="list-group-item {{Request::is('admin/admin_dashboard/create_user')? 'active' : '' }}">Create User</li></a>

            <a href="#"><li class="list-group-item ">Update User</li></a>
            <a href="#"><li class="list-group-item bg-danger text-light">Remove User</li></a>

        </ul>
    </div>

    @yield('content-div')

</div>