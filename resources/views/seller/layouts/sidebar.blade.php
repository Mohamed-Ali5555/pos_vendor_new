 <div id="left-sidebar" class="sidebar">
     <div class="sidebar-scroll">
         <div class="user-account">
             <img src="{{ asset('backend/assets/images/user.png') }}" class="rounded-circle user-photo"
                 alt="User Profile Picture">
             <div class="dropdown">
                 <span>Welcome,</span>
                 <a href="javascript:void(0);" class=" user-name"
                     data-toggle="dropdown"><strong>{{ ucfirst(auth('seller')->user()->full_name) }}</strong>
                     <span>
                      @if(auth('seller')->user()->is_verified) 
                      <i class="fas fa-check-circle text-success" data-toggle="tooltip" title="verified" data-placement="bottom"></i> 
                      @else 
                      <i class="fas fa-check-circle text-danger" data-toggle="tooltip" 
                      title="unverified" data-placement="bottom"></i> 
                      @endif  </span>
                          </a>

             </div>
             <hr>

         </div>

         <nav class="sidebar-nav">
             <ul class="main-menu metismenu">
                 <li class="active"><a href="{{route('seller')}}"><i class="fa fa-grid"></i><span>Dashboard</span></a></li>


       

                 <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-briefcase"></i><span>products
                             Management</span> </a>
                     <ul>
                         <li><a href="{{ route('seller-product.index') }}">All products</a></li>
                         <li><a href="{{ route('seller-product.create') }}">Add product</a></li>
                     </ul>
                 </li>




              




             </ul>
         </nav>
        
     </div>
 </div>
