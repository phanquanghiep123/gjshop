<?php $fProducts = $loggedUser->favoriteProducts()->simplePaginate(9); ?>
<ul class="">
    @if(count($fProducts))
        @foreach($fProducts as $fProduct)
        <li>
            <a href="{{route('shop.products.show',['slug'=>$fProduct->slug])}}">
                {{ neat_trim( $fProduct->name, 30) }}
            </a>
            <a href="javascript:void(0)" data-url="{{route('shop.favorites.delete',[$fProduct->id])}}" onclick="ShopProduct.deleteFavorite(this)">
                <i class="fa fa-times text-danger" data-toggle="tooltip" data-placement="top" title="Remove Favorite"> </i>
            </a>
        </li>
        @endforeach
    @else
        <li><em>You have no favourites saved!</em></li>
    @endif
</ul>
<div class="favoriteLinks">
{!! $fProducts->links() !!}
</div>
