<?php
$links = Share::load($link, $description)->services('facebook', 'gplus', 'twitter', 'pinterest');
?>
<ul class="list-inline pull-left">
    @foreach($links as $key => $shareLink)
    <?php 
    switch ($key) {
        case 'gplus':
            $key = 'google-plus';
            break;

        default:
            break;
    }
    ?>
        <li>
            <a  href="{{$shareLink}}" class="share-link btn-{{$key}}">
                <i class="fa fa-{{$key}}"></i> 
            </a>
        </li>
    @endforeach
        
    <div class="fb-like" data-href="{{$shareLink}}" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="false"></div>
        
</ul>