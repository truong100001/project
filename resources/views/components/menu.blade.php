<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="public_admin/images/icon/logo-tovi.png" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="active has-sub">
                    <a class="js-arrow" href="{{asset('/')}}">
                        <i class="fas fa-tachometer-alt"></i>Home</a>
                </li>
                <li>
                    <a href="{{asset('/users')}}">
                        <i class="fa fa-archive"></i>Thành viên</a>
                </li>
                <li>
                    <a href="{{asset('/forum-extract')}}">
                        <i class="fa fa-archive"></i>Phân forum</a>
                </li>
                <li>
                    <a href="{{asset('/forum-account')}}">
                        <i class="fa fa-archive"></i>Forum / Account</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->