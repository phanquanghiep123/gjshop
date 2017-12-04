
<div class="medium-margin-bottom follow-socicals" @if(isset($article)) style="padding: 5px 0 15px 0;" @endif>
    @if(isset($article))

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
    <div class="clear-fix"></div>
</div>