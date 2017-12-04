<?php $fArticles = $loggedUser->favoriteArticles()->simplePaginate(9); ?>
<ul class="larga-margin-top">
    @if(count($fArticles))
        @foreach($fArticles as $fArticle)
        <?php 
            $category = $fArticle->categories->first();
            $link = route('detailtArticle',['categorySlug'=>$category->slug,'slug'=>$fArticle->slug]); 
        ?>
        <li class="col-md-12">
            <a href="{{$link}}">
                {{ neat_trim( $fArticle->title, 40) }}
            </a>
            <a href="javascript:void(0)" data-confirm='Are you want to remove the artile "{{$fArticle->title}}" from your favorite list ? '  data-url="{{route('remove_favorite_article',[$fArticle->id])}}" onclick="Favorite.deleteFavorite(this)">
                <i class="fa fa-times text-danger" data-toggle="tooltip" data-placement="top" title="Remove Favorite"> </i>
            </a>
        </li>
        @endforeach
    @else
        <li><em>You have no articles in your favourites list!</em></li>
    @endif
    <div class="clear-fix"></div>
</ul>
<div class="favoriteLinks">
{!! $fArticles->links() !!}
</div>
