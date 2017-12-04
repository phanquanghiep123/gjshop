<ul class="myAccount quickLinks">
    <h3 class="no-margin-top">User Menu</h3>
    <li><i class="icon-user"></i> <a href="{!! route('my_account') !!}">Account Overview</a></li>
    <li><i class="fa fa-pencil-square-o"></i> <a href="{!! route('edit_account') !!}">Edit Account</a></li>
    <li><i class="fa fa-gift"></i> <a href="{!! route('viewHistory') !!}">Order History</a></li>
    <li><i class="fa fa-heart text-danger"></i> <a href="{!! route('my_favorites') !!}">My Favorites</a></li>
    <li><i class="fa fa-clock-o"></i> <a href="{{ route('my_subscriptions') }}" data-toggle="tooltip" data-placement="right" title="Manage your subscriptions and notifications">Subscriptions</a></li>
    <li><i class="fa fa-ticket"></i> <a href="{!! route('my_points') !!}">Points & Vouchers</a></li>
    @if($loggedUser->advocate)
    <li><i class="fa fa-cubes"></i> <a href="{{ route('my_referrals') }}">Referrals</a> <span class="badge badge-success">{{count($loggedUser->referrals)}}</span></li>
    <li><i class="fa fa-user"></i> <a href="{{ route('add_referral') }}">Add Referral</a></li>
    @endif
    <li><i class="fa fa-money"></i> <a href="{{ route('my_commissions') }}" data-toggle="tooltip" data-placement="right" title="Paid and Pending Commission">Commissions</a></li>
    
</ul>