<div class="temp" style="display:none"></div>
@foreach($products as $product)
    <?php 

    $productCount = count($products); 
    $display = '';
    if($productCount >= 4){
        $display = 'col-xs-12 col-sm-6 col-md-6 col-lg-4';
    } elseif ($productCount == 1) {
        $display = 'col-xs-12 col-sm-6 col-md-6 col-lg-6 col-sm-offset-3 col-lg-offset-3 col-md-offset-3';
    } else {
        $display = 'col-xs-12 col-sm-6 col-md-6 col-lg-6';
    }


    ?>
    <div class="{{$display}} product-container">
        <div class="product">
            
            @include('_partials.frontend.admin_product_edit_link')

            <a href="{{route('shop.products.show',['slug'=>$product->slug])}}">
                <img class="img-responsive product-image" src="{{asset($product->list_image)}}" alt="{{$product->name}}" /> 
                
                @if($product->points)
                    <div class="purchase_loyalty_points">
                        Earn
                        <div class="points_earned">
                        {{ $product->points }}
                        </div>
                        Points
                    </div> 
                @endif    
            </a>
            <p class="listProductName">
                <a href="{{route('shop.products.show',['slug'=>$product->slug])}}">
                    {{$product->name}}
                </a>
            </p>
            <p class="listProductPrice align-center">
                @if( $product->isSale())
                <span class="price text-danger"><strike>{{$product->getRegularPriceFormated()}}</strike></span>
                <span class="price">{{$product->getSalePriceFormated()}}</span>
                <span class="text-success">Save: ({!!  discountPercent( $product->getRegularPrice() ,$product->getSalePrice() ) !!})</span>
                @else
                <b class="price">{{$product->getRegularPriceFormated()}}</b>
                @endif
            </p>

            <div class="row">
                <div class="col-xs-offset-4 col-xs-5 col-sm-offset-4 col-sm-6">
                    <div class="align-center">
                        @if($product->inventory > 0)
                            {!! Former::open()->route('shop.cart.quickBuy')->method("POST")->onsubmit('ShopCart.addItem(this);return false;') !!}
                            <input type="hidden" value="{{$product->id}}" name='id' />
                            <input type="hidden" value="{{$product->name}}" name='product_name' />
                            <button type="submit" class="btn productListCart btn-sm pull-left small-margin-right" data-toggle="tooltip" data-placement="top" title="Add item to bag"><i class="icon-handbag"></i></button>
                            {!! Former::close() !!}
                        @endif
                        
                        @if($product->inventory < 1)
                            @if(!$loggedUser)
                                <div class="pull-left" data-toggle="tooltip" data-placement="top" title="Click to get notified when this item is back in stock!">
                                    <button class="btn productListInstockEmail btn-sm small-margin-right" data-toggle="modal" data-target="#stockNotification-modal">
                                        <i class="fa fa-envelope"></i>
                                    </button>
                                </div>
                            @else
                                {!! Former::open()->route('shop.subscriptions.subscribeStockDelivered')
                                ->onsubmit('ShopSubscription.subscribeStockDelivered(this);return false;') !!}
                                {!! Former::token() !!}
                                {!! Former::hidden('product_id',$product->id) !!}
                                {!! Former::hidden('email',$loggedUser->email) !!}
                                <button class="btn productListInstockEmail btn-sm pull-left small-margin-right" data-toggle="tooltip"  data-placement="top" title="Click to get notified when this item is back in stock!">
                                    <i class="fa fa-envelope"></i>
                                </button>
                                {!! Former::close() !!}
                            @endif
                        @endif

                        @if($loggedUser)
                            <a data-url="{{route('shop.favorites.store')}}" data-id='{{$product->id}}'
                               onclick="ShopProduct.addFavorites(this)" class="btn btn-danger btn-sm pull-left">
                                <i class="fa fa-heart"></i>
                            </a>
                        @else
                            <div class="pull-left" data-toggle="tooltip" data-placement="top" title="Login to manage favorites!">
                                <button class="btn btn-danger btn-sm producFavoriteLogin" data-toggle="modal" data-target="#login-modal" data-backdrop="static">
                                    <i class="fa fa-heart"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach