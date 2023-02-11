

<ul>
    <li class="{{\Request::is('user\dashboard') ? 'active' : ''}}"> <a href="{{route('user.dashboard')}}">Dashboard</a></li>
    <li class="{{\Request::is('user\order') ? 'active' : ''}}"> <a href="{{route('user.order')}}">order</a></li>
    <li class="{{\Request::is('user\address') ? 'active' : ''}}"> <a href="{{route('user.address')}}">address</a></li>
    <li class="{{\Request::is('user\account') ? 'active' : ''}}"> <a href="{{route('user.account')}}">account Details</a></li>
    {{-- <li ><a href="{{route('user.logout')}}">Logout</a></li> --}}


</ul>