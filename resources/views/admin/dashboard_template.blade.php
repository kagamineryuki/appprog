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
        <label class="navbar-brand text-light m-0"><strong>Administrator</strong></label>
    </div>

    <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-light rounded border border-white p-2" href="#" id="navbarDropdown"
           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::guard('admin')->user()->nama }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/admin/admin_dashboard/logout">Logout</a>
        </div>
    </div>

</nav>

<div class="d-flex">
    <div class="bg-light align-items-stretch" id="sidebar">
        <div class="list-group list-group-flush">
            <a href="/admin/admin_dashboard"
                class="list-group-item list-group-item-action {{Request::is('admin/admin_dashboard')? 'active' : '' }}">Dashboard
            </a>

            <a href="/admin/admin_dashboard/create_user"
                class="list-group-item list-group-item-action {{Request::is('admin/admin_dashboard/create_user')? 'active' : '' }}">Create Items

            </a>

            <a href="/admin/admin_dashboard/change_user"
                class="list-group-item list-group-item-action {{Request::is('admin/admin_dashboard/change_user')? 'active' : '' }}">Update Items
            </a>
            <a href="/admin/admin_dashboard/delete_user"
                class="list-group-item list-group-item-action bg-danger text-light">Delete Items
            </a>

        </div>
    </div>

    @yield('content-div')

</div>