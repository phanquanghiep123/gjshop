<ul id="{{$menu->name}}">
<?php 
    foreach ($menu->items as $item ):
    $link = \App\Engine\Menu::generateLinkFromItem($item);
?>
<li class=""><?php echo $link; ?></li>
<?php endforeach; ?>
</ul>

