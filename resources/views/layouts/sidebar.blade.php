<!-- menu profile quick info -->
@if (Auth::check())
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="/website-theme/images/img.jpg" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome</span>
        <h2>{{Auth::user()->username}}</h2>
    </div>
</div>
@endif
<!-- /menu profile quick info -->

<br />

<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('home')}}"><i class="fa fa-home"></i> Home </a></li>
        </ul>
    </div>

    <div class="menu_section">
        <h3>Client Part</h3>

        <ul class="nav side-menu">
            <li><a><i class="fa fa-star"></i> Products <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('shop')}}">All</a>
                    </li>
                    <li><a>Filter Categories<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none;">
                            @foreach ($mainCategories as $mainCategory)
                            <li><a href="one">{{$mainCategory->title}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a>level three</a></li>
                </ul>
            </li>
        </ul>

        <ul class="nav side-menu">
            <li><a><i class="fa fa-user"></i> Profile Pages <span class="fa fa-chevron-down"></span></a>
                @if (Auth::check())
                <ul class="nav child_menu">
                    <li><a href="{{ route('profile.show',auth()->user())}}">Show My Profile</a></li>
                    <li><a href="{{ route('profile.confirmPassword',auth()->user())}}">Active Confirm Password</a></li>
                    <li><a href="{{ route('profile.emailVerify',auth()->user())}}">Active Email Verification</a>
                    <li><a href="{{ route('profile.twoFactorAuth',auth()->user())}}">Active Two Factor
                            Authentication</a>
                    </li>
                </ul>
                @endif
            </li>
        </ul>
    </div>
    <div class="menu_section">
        <h3>Admin Panel</h3>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-user"></i> Products <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('product.index')}}">List</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-comments"></i> Comments <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('comment.index')}}">List</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-tags"></i> Categories <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('category.index')}}">List</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('user.index')}}">List</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-key"></i> Access Permission <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('permission.index')}}">Permissions</a></li>
                    <li><a href="{{ route('role.index')}}">Roles</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="menu_section">
        <h3>Download</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('download')}}"><i class="fa fa-cloud-download"></i> Site Code </a></li>
        </ul>
        <ul class="nav side-menu">
            <li><a><i class="fa fa-download"></i> APIs </a></li>
        </ul>
    </div>
</div>