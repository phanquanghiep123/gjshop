@extends('layouts.no_right_side')

@section('title') My Referrals @stop


@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{!! url('/') !!}"><img src="{{asset('assets/frontend/images/home_icon.png') }}" alt="back home" /></a></li>
    <li><a href="{{ route('my_account')}}">Account</a></li>
    <li><a href="#">My Commissions</a></li>
</ul>
@stop

@section('content')

<div class="row large-margin-top">
    <div class="col-md-3">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-dark bold uppercase">Welcome {!! $loggedUser->username ? $loggedUser->username : $loggedUser->f_name !!} </span>
                </div>
            </div>
            <div class="portlet-body">
                @include('_partials.frontend.side_quick_links')
            </div>
        </div> 
    </div>
    <div class="col-md-9">
        @include('_partials.backend.notifications')
        <div>
            <h4 class="account-page-title no-margin-top large-margin-bottom"> <i class="fa fa-money"></i> My Commissions</h4>
        </div>

        @if($loggedUser->advocate)
        <div class="row">
            <div class="col-xs-6">
                <div class="commission-dash">
                    <h4 class="no-margin-bottom">TOTAL COMMISSION PAID</h4>
                    <p>
                        <span class="due-commission-dash">£200</span><br/>
                        <small>For all your referrals</small>
                    </p>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="commission-dash">
                    <h4 class="no-margin-bottom">TOTAL COMMISSIONABLE TEAMS SALES FOR {{ strtoupper(date('F')) }}</h4>
                    <p>
                        <span class="due-commission-dash">£{{$monthly_orders_total}}</span><br/>
                        <small>
                            You currently qualify for 
                            @if($monthly_orders_total >= 100)
                                10%   
                            @elseif($monthly_orders_total >= 70 && $monthly_orders_total < 100)
                                7% 
                            @elseif($monthly_orders_total >= 50 && $monthly_orders_total < 70)
                                5% 
                            @else
                                0%
                            @endif
                            commission
                        </small>
                    </p>
                </div>
            </div>
            <div class="col-xs-6">
                <hr class="dashed"/>
            </div>
        </div>


        <div class="table-responsive">
            <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th sortable>Referral</th>
                    <th sortable>Transaction Date</th>
                    <th sortable>Transaction Amount</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @foreach($orders as $order)
                    <tr>
                        <td>
                            {{$count++}}
                        </td>
                        <td>
                            {{$order->f_name . ' ' .$order->l_name}}
                        </td>
                        <td>
                            {{ date("d M Y - H:i",strtotime($order->order_date))}} 
                        </td>
                        <td>
                            {{$order->amount}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
       
    </div>

</div>
@endsection

@section('scripts')


@endsection