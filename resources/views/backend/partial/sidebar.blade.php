
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Gravatar::src(Auth::user()->email) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{!! Auth::user()->name !!}</p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Roles</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('dashboard/admin/role') !!}"><i class="fa fa-circle-o"></i> Roles</a></li>
                    <li class="active"><a href="{!! url('dashboard/admin/role/create') !!}"><i class="fa fa-circle-o"></i> Create Role</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Permissions</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('dashboard/admin/permission') !!}"><i class="fa fa-circle-o"></i> Permissions</a></li>
                    <li class="active"><a href="{!! url('dashboard/admin/permission/create') !!}"><i class="fa fa-circle-o"></i> Create Permission</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('dashboard/admin/user') !!}"><i class="fa fa-circle-o"></i> All User</a></li>
                    <li class="active"><a href="{!! url('dashboard/admin/user/create') !!}"><i class="fa fa-circle-o"></i> Create User</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Posts</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('dashboard/admin/post') !!}"><i class="fa fa-circle-o"></i> All Posts</a></li>
                    <li class="active"><a href="{!! url('dashboard/admin/post/trash') !!}"><i class="fa fa-circle-o"></i>Trashed Posts</a></li>
                    <li class="active"><a href="{!! url('dashboard/admin/categories') !!}"><i class="fa fa-circle-o"></i>Categories</a></li>
                    <li class="active"><a href="{!! url('dashboard/admin/post/create') !!}"><i class="fa fa-circle-o"></i> Create Post</a></li>           
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Pages</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('dashboard/admin/page') !!}"><i class="fa fa-circle-o"></i> All Pages</a></li>
                    <li class="active"><a href="{!! url('dashboard/admin/page/trash') !!}"><i class="fa fa-circle-o"></i>Trashed Pages</a></li>
                    <li class="active"><a href="{!! url('dashboard/admin/page/create') !!}"><i class="fa fa-circle-o"></i> Create Page</a></li>           
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('dashboard/admin/product') !!}"><i class="fa fa-circle-o"></i> All Products</a></li>
                    <li class="active"><a href="{!! url('dashboard/admin/product/trash') !!}"><i class="fa fa-circle-o"></i>Trashed Products</a></li>
                    <li class="active"><a href="{!! url('dashboard/admin/product-categories') !!}"><i class="fa fa-circle-o"></i>Categories</a></li>
                    <li class="active"><a href="{!! url('dashboard/admin/product/create') !!}"><i class="fa fa-circle-o"></i> Create Product</a></li>           
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>eShop</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('dashboard/admin/order') !!}"><i class="fa fa-circle-o"></i> Orders</a></li>
                    <li><a href="{!! url('dashboard/admin/eshop') !!}"><i class="fa fa-circle-o"></i> Settings</a></li>
                    <li><a href="{!! url('dashboard/admin/order/trash') !!}"><i class="fa fa-circle-o"></i> Trashed order</a></li>
                    <li><a href="{!! url('dashboard/admin/order/refund') !!}"><i class="fa fa-circle-o"></i> Refunds order</a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
