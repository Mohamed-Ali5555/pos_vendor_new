<div id="left-sidebar" class="sidebar">
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="{{ asset('backend/assets/images/user.png') }}" class="rounded-circle user-photo"
                alt="User Profile Picture">
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name"
                    data-toggle="dropdown"><strong>{{ ucfirst(auth('admin')->user()->full_name) }}</strong></a>

            </div>
            <hr>

        </div>

        <nav class="sidebar-nav">
            <ul class="main-menu metismenu">
                <li class="active"><a href="{{route('admin')}}"><i class="fa fa-grid"></i><span>Dashboard</span></a></li>


                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-image"></i><span>Banner
                            Managment</span> </a>
                    <ul>
                        <li><a href="{{ route('banner.index') }}">All Banners</a></li>
                        <li><a href="{{ route('banner.create') }}">Add Banner</a></li>
                    </ul>
                </li>

                
                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-info"></i><span>AboutUs
                            Managment</span> </a>
                    <ul>
                        <li><a href="{{ route('aboutus') }}">All Abouts</a></li>
                        {{-- <li><a href="{{ route('aboutus.create') }}">Add Abouts</a></li> --}}
                    </ul>
                </li>


                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-sitemap"></i><span>Category
                            Management</span> </a>
                    <ul>
                        <li><a href="{{ route('category.index') }}">All category</a></li>
                        <li><a href="{{ route('category.create') }}">Add category</a></li>
                    </ul>
                </li>


                <li><a href="javascript:void(0);" class="has-arrow"><i class="fas fa-handbag"></i><span>Brand
                            Management</span> </a>
                    <ul>
                        <li><a href="{{ route('brand.index') }}">All Brands</a></li>
                        <li><a href="{{ route('brand.create') }}">Add Brands</a></li>
                    </ul>
                </li>


                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-briefcase"></i><span>products
                            Management</span> </a>
                    <ul>
                        <li><a href="{{ route('product.index') }}">All products</a></li>
                        <li><a href="{{ route('product.create') }}">Add product</a></li>
                    </ul>
                </li>




                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-truck"></i><span>Shipping
                            Management</span> </a>
                    <ul>
                        <li><a href="{{ route('shipping.index') }}">All Shippings</a></li>
                        <li><a href="{{ route('shipping.create') }}">Add Shipping</a></li>
                    </ul>
                </li>

                   <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-money"></i><span>Currency
                            Management</span> </a>
                    <ul>
                        <li><a href="{{ route('currencie.index') }}">All currency</a></li>
                        <li><a href="{{ route('currencie.create') }}">Add currency</a></li>
                    </ul>
                </li>

                <li><a href="{{route('order.index')}}"><i class="fa fa-layer"></i> order Managment</a></li>



                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-sitemap"></i><span>Sellers
                            Category</span> </a>
                    <ul>
                        <li><a href="{{route('seller.index')}}">All Departments</a></li>
                        {{-- <li><a href="add-departments.html">Add Departments</a></li> --}}
                    </ul>
                </li>




                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-tag"></i><span>post Tag</span> </a>
                    <ul>
                        <li><a href="departments.html">All Departments</a></li>
                        <li><a href="add-departments.html">Add Departments</a></li>
                    </ul>
                </li>



                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-newspaper"></i><span>post
                            Management</span> </a>
                    <ul>
                        <li><a href="departments.html">All Departments</a></li>
                        <li><a href="add-departments.html">Add Departments</a></li>
                    </ul>
                </li>



                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-star"></i><span>Review
                            Management</span> </a>
                    <ul>
                        <li><a href="departments.html">All Departments</a></li>
                        <li><a href="add-departments.html">Add Departments</a></li>
                    </ul>
                </li>

                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-check"></i><span>coupon
                            Management</span> </a>
                    <ul>
                        <li><a href="{{ route('coupon.index') }}">All Departments</a></li>
                        <li><a href="{{ route('coupon.create') }}">Add Departments</a></li>
                    </ul>
                </li>



                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-user"></i><span>user
                            Management</span> </a>
                    <ul>
                        <li><a href="{{ route('user.index') }}">All Departments</a></li>
                        <li><a href="{{ route('user.create') }}">Add Departments</a></li>
                    </ul>
                </li>



                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-comments"></i><span>comments
                            Management</span> </a>
                    <ul>
                        <li><a href="departments.html">All Departments</a></li>
                        <li><a href="add-departments.html">Add Departments</a></li>
                    </ul>
                </li>


                <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-cogs"></i><span>General Setting
                            </span> </a>
                    <ul>
                        <li><a href="{{route('settings')}}">Settings</a></li>
                        <li><a href="{{route('smtp')}}">smtp setting</a></li>
                    </ul>
                </li>


            </ul>
        </nav>
       
    </div>
</div>
