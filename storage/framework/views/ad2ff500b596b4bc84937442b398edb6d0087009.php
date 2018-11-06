<style>

    #sidebar {
        width: 30vw;
    }
</style>

<nav class="navbar navbar-light bg-dark d-flex justify-content-between">
    <div>
        <a class="navbar-brand text-light"><?php echo e(config('app.name')); ?></a>
    </div>
    <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-light rounded border border-white p-2" href="#" id="navbarDropdown"
           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo e(Auth::guard('admin')->user()->nama); ?>

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
        <ul class="list-group">
            <a href="/admin/admin_dashboard">
                <li class="list-group-item <?php echo e(Request::is('admin/admin_dashboard')? 'active' : ''); ?>">Dashboard</li>
            </a>

            <a href="/admin/admin_dashboard/create_user">
                <li class="list-group-item <?php echo e(Request::is('admin/admin_dashboard/create_user')? 'active' : ''); ?>">Create
                    User
                </li>
            </a>

            <a href="#">
                <li class="list-group-item ">Update User</li>
            </a>
            <a href="#">
                <li class="list-group-item bg-danger text-light">Remove User</li>
            </a>

        </ul>
    </div>

    <?php echo $__env->yieldContent('content-div'); ?>

</div>