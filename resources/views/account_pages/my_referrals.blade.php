@extends('layouts.no_right_side')

@section('title') My Referrals @stop


@section('breadcrumb')

<ul class="breadcrumb">
    <li><a href="{!! url('/') !!}"><img src="{{asset('assets/frontend/images/home_icon.png') }}" alt="back home" /></a></li>
    <li><a href="{{ route('my_account')}}">Account</a></li>
    <li><a href="#">My Referrals</a></li>
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
            <h4 class="account-page-title no-margin-top large-margin-bottom"> <i class="fa fa-cubes"></i> My Referrals</h4>
            <p><strong>Congratulations!!!</strong> you have {{count($loggedUser->referrals)}} referrals. You will now qualify to receive commissions from
                ever purchase they make. You can keep track of your commissions <a href="{{ route('my_commissions') }}">here</a> and view pending payments on your user dashboard.</p>
        </div>
        <div class="table-responsive">
            <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th sortable>Name</th>
                    <th sortable>Email</th>
                    <th sortable>Date Referred</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $count = 1; ?>
                    @foreach($loggedUser->referrals as $referral)
                    <tr>
                        <td>
                            {{$count++}}
                        </td>
                        <td>
                            {{$referral->fullname()}}
                        </td>
                        <td>
                            {{$referral->email}}
                        </td>
                        <td>
                            {{ date("d M Y - H:i",strtotime($referral->created_at))}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       
    </div>

</div>
@endsection

@section('scripts')


@endsection