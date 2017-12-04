<div id="points-total">
    <?php $user2 = App\User::find($loggedUser->id); ?>
    <h3>YOUR HAVE</h3>
    <p>
        <span class="point-count">{{$user2->points}} </span><br/>
        <small> LOYALTY POINTS</small>
    </p>
</div>