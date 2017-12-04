@extends('layouts.no_right_side')

@section('title') Points & Vouchers @stop


@section('breadcrumb')

<ul class="breadcrumb">
    <li><a href="{!! url('/') !!}"><img src="{{asset('assets/frontend/images/home_icon.png') }}" alt="back home" /></a></li>
    <li><a href="{{ route('my_account')}}">Account</a></li>
    <li><a href="#">Points & Vouchers</a></li>
</ul>
@stop

@section('content')
<?php
$min_conversion_amount = \Modules\Shop\Models\Setting::where('key','minimum_point_conversion')->pluck('value')->first();
?>
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
            <h4 class="account-page-title no-margin-top large-margin-bottom"> <i class="fa fa-ticket"></i> Points & Vouchers</h4>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="points-dash-total large-margin-bottom">
                    @include('_partials.frontend.points_total')
                </div>
            </div>
            <div class="col-md-8">
                <div class="points-dash medium-margin-bottom">
                    @include('_partials.frontend.accumulated_points')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php $usersPoints = pointsValue($loggedUser); ?>
                @if( $usersPoints >= (int)$min_conversion_amount)

                    {!! Former::open()
                    ->route('convert_points')
                    ->onsubmit('Points.convertPoints(this);return false;')
                    ->enctype("multipart/form-data")
                    ->id('convertPointsForm')
                    ->nude()
                    !!}

                    {!! Former::token() !!}
                    <div class="col-md-8">
                        <select class="form-control" id="voucher_amount" name="voucher_amount" required>
                            <option value="" disabled="disabled" selected="selected">Convert Points - Select Voucher Amount</option>
                            
                            <option value="5">£5</option>
                            @if($usersPoints >= '10.00')
                            <option value="10">£10</option>
                            @endif
                            @if($usersPoints >= '15.00')
                            <option value="15">£15</option>
                            @endif
                            @if($usersPoints >= '25.00')
                            <option value="25">£25</option>
                            @endif
                            @if($usersPoints >= '50.00')
                            <option value="50">£50</option>
                            @endif
                            @if($usersPoints >= '100.00')
                            <option value="100">£100</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4">
                        {!! Former::submit('Convert')->class('btn btn-success') !!}
                    </div>
                    {!! Former::close() !!}
                @else
                    <h4>Points need to exceed £5 in value to be converted in to vouchers.</h4>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <hr class="dashed"/>
            </div>

            <div class="col-md-12">
                <div class="table-responsive">
                    @include('_partials.frontend.vouchers')
                </div>   
            </div>
        
        </div>

    </div>

</div>
@endsection

@section('scripts')

@endsection