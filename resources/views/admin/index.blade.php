@extends('admin.layouts.master')


@section('content')
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-5 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item active">eCommerce</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3>{{ \App\Models\Category::where('status', 'active')->where('is_parent', 1)->count() }} <i
                                    class="icon-basket-loaded float-right"></i></h3>
                            <span>total category</span>
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-blue m-b-0">
                            <div class="progress-bar" data-transitiongoal="64"></div>
                        </div>
                    </div>
                </div>




                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3>{{ \App\Models\Product::where('status', 'active')->count() }} <i
                                    class=" icon-heart float-right"></i></h3>
                            <span>Total products</span>
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-green m-b-0">
                            <div class="progress-bar" data-transitiongoal="68"></div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3>{{ \App\Models\User::where('status', 'active')->count() }} <i
                                    class="icon-user-follow float-right"></i></h3>
                            <span>New Customers</span>
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-purple m-b-0">
                            <div class="progress-bar" data-transitiongoal="67"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card overflowhidden">
                        <div class="body">
                            <h3>2,318 <i class="fa fa-dollar float-right"></i></h3>
                            <span>Net Profit</span>
                        </div>
                        <div class="progress progress-xs progress-transparent custom-color-yellow m-b-0">
                            <div class="progress-bar" data-transitiongoal="89"></div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row clearfix">
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Rwcent Orders</h2>
                            <ul class="header-dropdown">
                                <a href="" class="btn btn-success btn-sm">view all</a>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <span class="text-muted">Sales Report</span>
                                    <h3 class="text-warning">$4,516</h3>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <span class="text-muted">Annual Revenue </span>
                                    <h3 class="text-info">$6,481</h3>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <span class="text-muted">Total Profit</span>
                                    <h3 class="text-success">$3,915</h3>
                                </div>
                            </div>
                            <div id="area_chart" class="graph"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Income Analysis<small>8% High then last month</small></h2>
                        </div>
                        <div class="body">
                            <div class="sparkline-pie text-center">6,4,8</div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2>Sales Income</h2>
                        </div>
                        <div class="body">
                            <h6>Overall <b class="text-success">7,000</b></h6>
                            <div class="sparkline" data-type="line" data-spot-Radius="2" data-highlight-Spot-Color="#445771"
                                data-highlight-Line-Color="#222" data-min-Spot-Color="#445771" data-max-Spot-Color="#445771"
                                data-spot-Color="#445771" data-offset="90" data-width="100%" data-height="95px"
                                data-line-Width="1" data-line-Color="#ffcd55" data-fill-Color="#ffcd55">
                                2,4,3,1,5,7,3,2</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Recent orders</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                        role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <a href="" class="btn btn-success btn-sm">view all</a>

                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th style="width:60px;">#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Payment Method</th>
                                            <th>Payment Status</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        @forelse($orders as $order)
                                            <?php $i++; ?>

                                            <tr>

                                                <td>{{ $i }}</td>
                                                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                                <td>{{ $order->email }}</td>
                                                <td>{{ $order->payment_method = 'cod' ? 'Cash on Delivery' : $order->payment_method }}
                                                </td>

                                                <td>{{ ucfirst($order->payment_status) }}</td>
                                                <td>{{ number_format($order->total_amount, 2) }}</td>
                                                <td>{{ $order->email }}</td>

                                                <td><span
                                                        class="badge 
                                                @if ($order->condition == 'pending') badge-info
                                                @elseif($order->condition == 'proccessing')
                                                badge-primary
                                                @elseif($order->condition == 'delivered')
                                                badge-success
                                                @else
                                                badge-danger @endif ">{{ $order->condition }}</span>
                                                </td>


                                                <td>
                                                    <a href="{{ route('order.show', $order->id) }}" data-toggle="tooltip"
                                                        title="view" class="float-left btn btn-sm btn-outline-warning"
                                                        data-placement="button"><i class="fas fa-eye"></i></a>

                                                    <form class="float-left ml-2"
                                                        action="{{ route('order.destroy', $order->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="#" data-toggle="tooltip" title="delete"
                                                            data-id="{{ $order->id }}"
                                                            class="dlBtn btn btn-sm btn-outline-danger"
                                                            data-placement="button"><i class="fas fa-trash-alt"></i></a>

                                                    </form>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>No orders</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
