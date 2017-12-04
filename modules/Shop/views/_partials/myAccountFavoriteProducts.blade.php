<?php $fProducts = $loggedUser->favoriteProducts()->simplePaginate(9); ?>
<ul class="large-margin-top">
    @if(count($fProducts))
        @foreach($fProducts as $fProduct)
        <li class="col-md-6">
            <a href="{{route('shop.products.show',['slug'=>$fProduct->slug])}}">
                {{ neat_trim( $fProduct->name, 40) }}
            </a>
            <a href="javascript:void(0)" data-confirm='Are you want to remove product "{{$fProduct->name}}" from favorite your list ? ' data-url="{{route('shop.favorites.delete',[$fProduct->id])}}" onclick="ShopProduct.deleteFavorite(this)">
                <i class="fa fa-times text-danger" data-toggle="tooltip" data-placement="top" title="Remove Favorite"> </i>
            </a>
        </li>
        @endforeach
    @else
        <li><em>You have no products in your favourites list!</em></li>
    @endif
    <div class="clear-fix"></div>
</ul>
<div class="favoriteLinks">
{!! $fProducts->links() !!}
</div>
