<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="{{ asset('backend/assets/images/user.png') }}" class="rounded-circle user-photo"
                alt="User Profile Picture">
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>Pro.
                        William</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    <li><a href="professors-profile.html"><i class="icon-user"></i>My Profile</a></li>
                    <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>
                    <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="page-login.html"><i class="icon-power"></i>Logout</a></li>
                </ul>
            </div>
            <hr>

        </div>
        <!-- Nav tabs -->


        <nav class="sidebar-nav">
            <ul class="main-menu metismenu">
                <li class="active"><a href="#"><i class="fa fa-grid"></i><span>Dashboard</span></a>
                </li>


                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-image"></i><span>category
                            Managment</span> </a>
                    <ul>

                        {{-- <li><a href="#">All Banners</a></li> --}}
                        {{-- <li><a href="#">Add Banner</a></li> --}}

                        <li><a href="{{ route('category.index') }}">All category</a></li>
                        <li><a href="{{ route('category.create') }}">Add category</a></li>
                    </ul>
                </li>



                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-image"></i><span>brand
                            Managment</span> </a>
                    <ul>

                        <li><a href="{{ route('brand.index') }}">All brand</a></li>
                        <li><a href="{{ route('brand.create') }}">Add brand</a></li>
                    </ul>
                </li>


                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-image"></i><span>banner
                            Managment</span> </a>
                    <ul>

                        <li><a href="{{ route('banner.index') }}">All banner</a></li>
                        <li><a href="{{ route('banner.create') }}">Add banner</a></li>
                    </ul>
                </li>




                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-image"></i><span>product
                            Managment</span> </a>
                    <ul>

                        <li><a href="{{ route('product.index') }}">All product</a></li>
                        <li><a href="{{ route('product.create') }}">Add product</a></li>
                    </ul>
                </li>




                   <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-image"></i><span>coupon
                            Managment</span> </a>
                    <ul>

                        <li><a href="{{ route('coupon.index') }}">All coupon</a></li>
                        <li><a href="{{ route('coupon.create') }}">Add coupon</a></li>
                    </ul>
                </li>


                

                   <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-image"></i><span>shipping
                            Managment</span> </a>
                    <ul>

                        <li><a href="{{ route('shipping.index') }}">All shipping</a></li>
                        <li><a href="{{ route('shipping.create') }}">Add shipping</a></li>
                    </ul>
                </li>


     <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-image"></i><span>currencie
                            Managment</span> </a>
                    <ul>

                        <li><a href="{{ route('currencie.index') }}">All currencie</a></li>
                        <li><a href="{{ route('currencie.create') }}">Add currencie</a></li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</div>
