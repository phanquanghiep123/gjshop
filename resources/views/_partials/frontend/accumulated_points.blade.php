<div id="accumulated-points">
	<?php $user = App\User::find($loggedUser->id); ?>
    <h3 class="no-margin-bottom">YOU HAVE ACCUMULATED {{$user->points}} POINTS </h3>
    <p>
        <span class="due-commission-dash">VALUE {{pointsValueFormatted($user)}}</span><br/>
        <small> Redeem at the checkout or convert into vouchers.</small>
    </p>
</div>