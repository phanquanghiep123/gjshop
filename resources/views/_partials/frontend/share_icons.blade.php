
<div class="follow-socicals" @if(isset($article)) style="padding: 5px 0 9px 0;" @endif>
    @if(isset($article))

            @if($loggedUser)
                <div class="pull-right">
                	<a data-url="{{route('store_favorite_article')}}" data-id='{{$article->id}}'
                       onclick="Favorite.addFavorites(this)" class="btn btn-danger articleFavoriteButton" 
                       data-toggle="tooltip" data-placement="top" title="Add to favorites">
                        <i class="fa fa-heart"></i>
                    </a>
                </div>
             @else
                <div class="pull-right" data-toggle="tooltip" data-placement="top" title="Login to manage favorites!">
                    <a class="btn btn-danger articleFavoriteButton" data-toggle="modal" href="#login-modal" data-backdrop="static">
                        <i class="fa fa-heart"></i>
                    </a>
                </div>
            @endif

 
        <?php  
            $link = urlencode(route('detailtArticle',['categorySlug'=>$category->slug,'slug'=>$article->slug]));
            $image = urlencode(asset($article->list_image));
            $title = urlencode($article->title);
            $summary = urlencode(strip_tags($article->description));
        ?>

        <a class="facebook" onClick="PopupCenter('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $link; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', '550','325');"  href="javascript: void(0)">
            <i class="fa fa-facebook"></i>
        </a>

        <a class="pinterest" onClick="PopupCenter('https://pinterest.com/pin/create/button/?url=<?php echo $link ?>&media=<?php echo $image ?>&description=<?php echo $summary ?>','sharer', '750','600')" href="javascript: void(0)">
            <i class="fa fa-pinterest"></i>
        </a>

    @endif
   
    @if(isset($product))
        <?php  
        $link = route('shop.products.show',['slug'=>$product->slug]);
        $shareImage = asset($product->share_image);
        ?>
 

        <?php  
            $link = urlencode(route('shop.products.show',['slug'=>$product->slug]));
            $image = urlencode(asset($product->share_image));
            $title = urlencode($product->name);
            $summary = urlencode(strip_tags($product->description));
        ?>

        <a class="facebook" onClick="PopupCenter('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $link; ?>&amp;&p[images][0]=<?php echo $image;?>', 'sharer', '550','325');"  href="javascript: void(0)">
            <i class="fa fa-facebook"></i>
        </a>

        <a class="pinterest" onClick="PopupCenter('https://pinterest.com/pin/create/button/?url=<?php echo $link ?>&media=<?php echo $image ?>&description=<?php echo $summary ?>','sharer', '750','600')" href="javascript: void(0)">
            <i class="fa fa-pinterest"></i>
        </a>


    @endif

    @if(isset($page))
        <?php  $link = url('articles') ?>
        {!! share( $link, 'Gabriel Job - Articles' ) !!}
    @endif


    <div class="clear-fix"></div>
</div>