@extends(config('shop.product'))


<?php
$price    = $product->regular_price;
$oldPrice = NULL;
if ($product->isSale()) {
    $price    = $product->getSalePrice();
    $oldPrice = $product->getRegularPrice();
} else {
    $price = $product->getRegularPrice();
}

?>


@section('title') Products - {{$product->name}} @endsection

@section('meta_keywords') {{ $product->meta_keywords}} @stop
@section('meta_description') {{ $product->meta_description}} @stop

@section('og_url') {{ route('shop.products.show',['slug'=>$product->slug]) }} @stop
@section('og_title') {{ $product->name }} @stop
@section('og_image') {{ asset($product->share_image) }} @stop
@section('og_ean') {{ $product->ean }} @stop
@section('og_price') £{{ $price }} @stop
@section('og_description') {!! $product->description !!} @stop



@section('content')

@include('_partials.frontend.admin_product_edit_link')

<section>
    <div class="page-title-article">
        <h2 class="page-title no-margin-top product-page"> {{$product->name}} 
            @include('_partials.frontend.share_icons')
        </h2>
    </div>
</section>

<div class="shop-page">
    <div class="row" id='detail-product'>
        <div class="col-md-7 col-sm-7 product-image-holder">

            <?php
            $imageCount           = count($product->images);
            $reviewCount          = count($reviews);
            $productArticles      = $product->articles()->where('status', '1')->get();
            $productArticlesCount = count($productArticles);
            $relatedProducts      = $product->relatedProducts;
            $productCertsCount    = count($product->certificates);
            if ($loggedUser) {
                $checkPurchasedService = new Modules\Shop\Services\CheckUserPurcharsedProductBefore();
                $checkPurchased        = $checkPurchasedService->call($product->id); // need to check orders to see if the logged user have purchased the current product
                //dd($checkPurchased);     for test  
            }

            ?>
            @if($imageCount)
            <div>
                <div id="money-back">
                    <img src="{{asset('/assets/frontend/images/money-back-guarantee.png')}}" alt="{{$product->name}}" />
                </div>
                <div class="images">
                    <div class="main">
                        
                        <img src="{{asset($product->images[0])}}" alt="{{$product->name}}" class="img-responsive productImage"/>
                    </div>
                    @if($imageCount > 1)
                    <ul class="list-inline product-thumbnails">
                        @foreach($product->images as $image)
                        <li style="display: inline-block;width: 70px">
                            <a href="javascript:void(0)">
                                <img onclick="ShopProduct.changeGalleryImage(this)" data-src='{{asset($image)}}' src="{{asset($image)}}" alt="" class="img-responsive"/>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
            @endif


        </div>
        <div class="col-md-5 col-sm-5 product-details-holder">
            <div class="temp" style="display:none"></div>
            <div class="main_product_info large-margin-top">
                {!! $product->description !!}
            </div>



            {!! Former::open()->route('shop.cart.add')->onsubmit('ShopCart.addItem(this);return false;') !!}
            <div class="order-section">

                <?php
                $price    = $product->regular_price;
                $oldPrice = NULL;
                if ($product->isSale()) {
                    $price    = $product->getSalePrice();
                    $oldPrice = $product->getRegularPrice();
                } else {
                    $price = $product->getRegularPrice();
                }

                ?>

                {!! Former::populate($product) !!}
                {!! Former::populateField('image', $product->list_image) !!}
                {!! Former::populateField('price', $price) !!}
                {!! Former::populateField('oldPrice', $oldPrice) !!}
                {!! Former::hidden('id') !!}
                {!! Former::hidden('name') !!}
                {!! Former::hidden('weight') !!}
                {!! Former::hidden('taxt') !!}
                {!! Former::hidden('image') !!}
                {!! Former::hidden('price') !!}
                {!! Former::hidden('size_uk') !!}
                {!! Former::hidden('size_us') !!}
                {!! Former::hidden('product_name',$product->name) !!}
                {!! Former::hidden('points',$product->points) !!}

                @if($oldPrice !== NULL)
                    {!! Former::hidden('oldPrice') !!}
                @endif
                {!! Former::hidden('slug',$product->slug) !!}
                {!! Former::hidden('description',$product->description) !!}

                
                <p>
                    @if( $product->displayed_weight )
                        <strong>Size: {{ $product->displayed_weight }} </strong>
                    @endif
                </p>


                @if( $product->isSale())
                    <p class="priceProductPage">
                        <strike class="text-danger"> Price : {{$product->getRegularPriceFormated()}}</strike> (<span class="text-success">Save: {!!  discountPercent( $product->getRegularPrice() ,$product->getSalePrice() ) !!}</span>)<br/>
                        <span>Sale Price : {{$product->getSalePriceFormated()}} </span><br/>
                        
                    </p>
                @else
                    <p class="priceProductPage">
                        Price : {{$product->getRegularPriceFormated()}}
                    </p>
                @endif

                @if( $product->inventory && $product->inventory <= 10 )
                    <p class="text-danger priceProductPage">ONLY {{$product->inventory}} IN STOCK!</p>
                @endif

                <p>
                    @if( $product->dimentions )   
                        Dimentions: {{$product->dimentions}}<br/>
                    @endif
                    @if( $product->ean )   
                        Product Code: {{$product->ean}}
                    @endif
                </p>

                @if($product->points)
                    <hr class="dashed medium-margin-bottom no-margin-top"/>
                    <a href="{{ url('loyalty-scheme') }}" style="width:100%" class="btn details-page-points-earned">Earn {{$product->points}} Points</a>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if($product->inventory > 0)
                    <input type="number" name="quantity" value="1" class="form-control qty_box"/> 
                    <button class="btn btn-default add-to-cart" type="submit"> Add to cart</button>
                        @if($loggedUser)
                            <div class="pull-left">
                                <a data-url="{{route('shop.favorites.store')}}" data-id='{{$product->id}}'
                                   onclick="ShopProduct.addFavorites(this)" class="btn btn-danger favoriteButton" >
                                    <i class="fa fa-heart"></i>
                                </a>
                            </div>
                        @endif
                        @if(!$loggedUser)
                            <div class="pull-left" data-toggle="tooltip" data-placement="top" title="Login to manage favorites!">
                                <a class="btn btn-danger favoriteButton" data-toggle="modal" href="#login-modal" data-backdrop="static">
                                    <i class="fa fa-heart"></i>
                                </a>
                            </div>
                        @endif
                    @else
                    <p class="outOfStock">Temporarily Out of Stock <br/>
                        @if($product->restock_date)
                            <small>Restock date: {{ date('D, d M F',strtotime( $product->restock_date )) }}</small>
                        @endif
                    </p>
                    @endif
                    {!! Former::close() !!}
                </div>
                <div class="col-md-12">
                    @if(!$product->inventory > 0)
                    
                        @if(!$loggedUser)
                            <div class="pull-left" data-toggle="tooltip" data-placement="top" title="Get notified when this item is back in stock!">
                                <a class="btn instockEmail btn-sm pull-left small-margin-right" 
                                   data-toggle="modal" href="#stockNotification-modal">
                                    <i class="fa fa-envelope"></i>
                                </a>
                            </div>
                        @else
                            {!! Former::open()->route('shop.subscriptions.subscribeStockDelivered')
                            ->onsubmit('ShopSubscription.subscribeStockDelivered(this);return false;') !!}
                            {!! Former::token() !!}
                            {!! Former::hidden('product_id',$product->id) !!}
                            {!! Former::hidden('email',$loggedUser->email) !!}
                            <button class="btn instockEmailLogged btn-sm pull-left small-margin-right" data-toggle="tooltip"  data-placement="top" title="Click to get notified when this item is back in stock!">
                                <i class="fa fa-envelope"></i>
                            </button>
                            {!! Former::close() !!}
                        @endif


                        @if($loggedUser)
                        <div class="pull-left">
                            <a data-url="{{route('shop.favorites.store')}}" data-id='{{$product->id}}'
                               onclick="ShopProduct.addFavorites(this)" class="btn btn-danger favoriteButton" >
                                <i class="fa fa-heart"></i>
                            </a>
                        </div>
                        @endif
                        @if(!$loggedUser)
                        <div class="pull-left" data-toggle="tooltip" data-placement="top" title="Login to manage favorites!">
                            <a class="btn btn-danger favoriteButton" data-toggle="modal" href="#login-modal" data-backdrop="static">
                                <i class="fa fa-heart"></i>
                            </a>
                        </div>
                        @endif
                    
                    @endif

                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="clear-fix"></div>
                    <ul class="product-cats">
                        <li class="cats-title">Categories:</li>
                        @foreach( $product->categories as $cat )
                        <li><a class="green-text" href="{{route('shop.categories.showChildCategory',['slug'=>$cat->slug])}}"> {{ $cat->name }}</a> </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <hr class="small-margin-top dashed">

            <div class="portlet-body extra-product-info">
                <ul class="nav nav-tabs tabs-reversed">
                    <li class="active">
                        <a href="#product-info" data-toggle="tab"> 
                            <span class="hidden-xs">Product Info <i class="fa fa-info-circle"></i> </span>
                            <span class="visible-xs">Info <i class="fa fa-info-circle"></i> </span>
                        </a>
                    </li>
                    @if($product->ingredients)
                    <li>
                        <a href="#ingredients" data-toggle="tab"> Ingredients </a>
                    </li>
                    @endif
                    <li>
                        <a href="#reviews" data-toggle="tab"> {{ $reviewCount == 1 ? $reviewCount . ' review' : $reviewCount . ' reviews' }} <i class="fa fa-comment"></i> </a>
                    </li>
                    @if($productArticlesCount)
                    <li>
                        <a href="#related-articles" data-toggle="tab"> {{ $productArticlesCount == 1 ? $productArticlesCount . ' Related Article' : $productArticlesCount . ' Related Articles' }} <i class="fa fa-link"></i> </a>
                    </li>
                    @endif
                    @if($productCertsCount)
                    <li>
                        <a href="#certificates" data-toggle="tab"> 
                            <span class="hidden-xs">Certificates <i class="fa fa-file"></i> </span>
                            <span class="visible-xs">Certs <i class="fa fa-file"></i> </span>
                        </a>
                    </li>
                    @endif
                </ul>
                <div class="tab-content tab-content-show">

                    <div class="tab-pane fade active in" id="product-info">


                        <div class="row">
                            @if( $product->product_video )
                            <div class="col-sm-5">
                                <div class="clearfix">
                                    <a class="video-link" href="#video-content-{{$product->id}}" title="{{ $product->video_title ? $product->video_title :  $product->name }}">
                                        <img class="img-responsive" src="{{asset('uploads/products/videos/placeholders/'.$product->video_placeholder)}}">
                                    </a>
                                </div>
                                <div style="width: 100%;display: none">
                                    <div id="video-content-{{$product->id}}" class="video-content">
                                        <?php
                                        $videoShowerService = new App\Services\VideoShower\VideoShowerService($product->product_video);
                                        $videoShowerService->show();

                                        ?>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="col-sm-<?php echo ( $product->product_video ? '7' : '12' ) ?>">
                                <div class="main-text">
                                    {!! $product->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ingredients">
                        <p> 
                            Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard
                            locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie
                            etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr. 
                        </p>
                    </div>
                    <div class="tab-pane fade" id="reviews">
                        <div class="row">

                            @if($reviewCount)
                                <div class="col-sm-5 review-form">
                                    @if( $loggedUser )
                                        @if(isset($checkPurchased))
                                            {!! Former::open()->route("shop.review.add")
                                            ->onsubmit("ShopProduct.submitReview(this);return false;")->id('submitReview') !!}

                                            {!! Former::token() !!}
                                            {!! Former::hidden('name', $loggedUser->fullname()) !!}
                                            {!! Former::hidden('email', $loggedUser->email) !!}
                                            {!! Former::hidden('user_id', $loggedUser->id) !!}
                                            {!! Former::hidden('product_id', $product->id) !!}
                                            <div class="productRating">
                                                <span class="pull-left"><strong>Rating:</strong></span>
                                                <input name="rating" id="product-rating" type="text" class="rating" data-size="xs" >
                                            </div>

                                            <textarea class="form-control" placeholder="Enter you comment..." rows="3" id="comment" name="comment" required></textarea>
                                            {!! Former::submit('Submit Review')->class('btn btn-success medium-margin-top') !!}
                                            {!! Former::close() !!}
                                        @else
                                            <p class="text-danger small-margin-top">
                                                <em>
                                                    Product reviews can only be submitted by customer who have purchased this item. This is to ensure quality and accuracy of our review system.
                                                </em>
                                            </p>

                                            @if( ! isset($checkPurchased) )
                                                <p class="text-danger small-margin-top">
                                                    <em>
                                                        You must purchase this item before you can leave a review.
                                                    </em>
                                                </p>
                                            @endif

                                        @endif

                                    @else
                                        <p class="text-danger"><em>Please <a class="signin" data-toggle="modal" href="#login-modal" data-backdrop="static">login</a> if you have puchased this item and would like to leave a review.</em></p>
                                    @endif
                                </div>
                                <div class="col-sm-7 feedback">
                                    @if($reviewCount)
                                        @foreach($reviews as $review)
                                        <div class="row review">
                                            <div class="col-xs-6">
                                                @if($review->reviewer->avatar)
                                                <img src="{!! asset($review->reviewer->avatar) !!}" width="50" class="commentImage">
                                                @endif
                                                <h4 class="reviewer">{!! $review->name !!} <small class="text-success">(VERIFIED PURCHASE)</small><br/><small class="green-text">{!! starRating($review->rating)  !!}</small></h4>
                                            </div>
                                            <div class="col-xs-6">
                                                <p class="commentDate">{!! date("D, d M Y - H:i",strtotime($review->created_at)) !!}</p>
                                            </div>
                                            <div class="col-xs-12">
                                                {!! $review->comment !!}
                                            </div>
                                        </div>
                                        @endforeach
                                    @else
                                    <p>
                                        <em>
                                            There are no reviews for this product, be the first!
                                        </em>
                                    </p>
                                    @endif
                                </div>
                            @else
                                <div class="col-md-10 col-md-offset-1 col-sm-12">
                                    @if( $loggedUser && isset($checkPurchased) && $checkPurchased != '1' )
                                    <h3 class="text-danger small-margin-top">
                                        <em>
                                            Product reviews can only be submitted by customer who have purchased this item. This is to ensure quality and accuracy of our review system.
                                        </em>
                                    </h3>
                                    @endif 
                                    <h3>
                                        <em>
                                            There are no reviews for this product, be the first!
                                        </em>
                                    </h3>

                                    @if( $loggedUser && isset($checkPurchased) && $checkPurchased == '1' )

                                        {!! Former::open()->route("shop.review.add")
                                        ->onsubmit("ShopProduct.submitReview(this);return false;")->id('submitReview') !!}

                                        {!! Former::token() !!}
                                        {!! Former::hidden('name', $loggedUser->fullname()) !!}
                                        {!! Former::hidden('email', $loggedUser->email) !!}
                                        {!! Former::hidden('user_id', $loggedUser->id) !!}
                                        {!! Former::hidden('product_id', $product->id) !!}
                                        <div class="productRating">
                                            <span class="pull-left"><strong>Rating:</strong></span>
                                            <input name="rating" id="product-rating" type="text" class="rating" data-size="xs" >
                                        </div>

                                        <textarea class="form-control" placeholder="Enter you comment..." rows="6" id="comment" name="comment" required></textarea>
                                        {!! Former::submit('Submit Review')->class('btn btn-success medium-margin-top') !!}
                                        {!! Former::close() !!}

                                    @elseif( $loggedUser && isset($checkPurchased) && $checkPurchased != '1' )
                                        <h3 class="text-danger small-margin-top">
                                            <em>
                                                You must purchase this item before you can leave a review.
                                            </em>
                                        </h3>
                                    @else
                                        <h3 class="text-danger small-margin-top">
                                            <em>
                                                Please <a class="signin" data-toggle="modal" href="#login-modal" data-backdrop="static">login</a> if you have puchased this item and would like to leave a review.
                                            </em>
                                        </h3>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    @if($productArticlesCount)
                    <div class="tab-pane fade" id="related-articles">
                        <div class="row">
                            <ul class="latest-articles">
                                @foreach( $productArticles as $relatedArticle)
                                <?php
                                $category = $relatedArticle->categories->first();
                                $link     = route('detailtArticle', ['categorySlug' => $category->slug, 'slug' => $relatedArticle->slug]);

                                ?>

                                <li class="col-sm-4 col-xs-12">
                                    <a href="{{ $link }}">
                                        <h3 class="related-article">
                                            @if(! $relatedArticle->video_link)
                                            <img src="{{asset($relatedArticle->list_image)}}">
                                            @else
                                            <i class="glyphicon glyphicon-facetime-video"></i>
                                            {{ $relatedArticle->title }}
                                            @endif
                                            
                                        </h3>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="tab-pane fade" id="certificates">
                        <div class="row">
                            @foreach( $product->certificates as $certificate)
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <a href='{{ asset( $certificate->file ) }}' title="{{ $certificate->certification_board }}" class='certificate-link' rel='{{ $certificate->certification_board }}'> 
                                    <img src="{{ asset( $certificate->file ) }}" class="certificate img-responsive">
                                </a>
                                <h4 class="">{{ $certificate->certification_board }}</h4>
                            </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <hr class="small-margin-top dashed">

        </div>
    </div>

    @if(count($relatedProducts) > 0 )
    <div class="row">
        <div class="col-md-12">
            <div class="featuredProductSlider">
                <h5 class="featured-product-title">Related Products:</h5>
                <div class="sliders popular-products bxslider">
                    @foreach( $relatedProducts as $p)
                    <div class="slider">
                        <div class="bg">
                            <p class="relatedProductName">
                                {{$p->name}}
                            </p>
                            <a href="{{route('shop.products.show',['slug'=>$p->slug])}}" class="btn btn-success relatedLink"><i class="fa fa-search"></i> View</a>
                        </div>
                        <img src="{{ asset($p->list_image) }}" class="img-responsive" alt="{{$p->name}}" />
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@stop

@section('styles')
@endsection


@section('scripts')
@endsection



@section('js')
<script type="text/javascript">
    
    $('.certificate-link').fancybox({
        helpers: {
            title: {
                type: 'inside',
                position: 'top'
            }
        }
    });
    
    $('#stockNotification-modal').on('show.bs.modal', function (e) {
        $('#stockNotification-modal .product-image').attr('src', $('#detail-product img.productImage').attr('src'));
        $('#stockNotification-modal h3.product-name').text($('h2.product-page').text());
    });
    
    $("#video-link").fancybox({
        'hideOnContentClick': true
    });
    $("#product-rating").rating({
        starCaptions: {
            1: "Very Disappointed",
            2: "Disappointed",
            3: "Average",
            4: "Pretty good",
            5: "Great"
        },
        step: 1,
        showClear: false
    });
    
    
    
    
    
    window.popularProductsSlider = null;
    
    
    var getPopularProductsOptions = function (isMobile, numberOfProductSlides) {
        
        var number;
        if (typeof numberOfProductSlides !== 'undefined' && numberOfProductSlides) {
            number = numberOfProductSlides;
        } else if (typeof isMobile === 'undefined' || !isMobile) {
            number = 4;
        } else {
            number = 2;
        }
        
        return {
            slideWidth: 294,
            minSlides: number,
            maxSlides: number,
            slideMargin: 15,
            pager: isMobile ? false : true
        };
    };
    
    $(document).ready(function () {
        var isMobileProduct = false;
        var numberOfSlider = null;
        var numberOfProductSlides = null;
        
        var width = $(window).width();
        /*
         if (width > 992) {
         isMobileProduct = false;
         } else if (width > 900 && width < 991 ) {
         isMobileProduct = false;
         numberOfProductSlides = 3;
         } else if (width >= 760 && width < 900 ) {
         isMobileProduct = false;
         numberOfProductSlides = 3;
         } else if (width >= 600 && width < 760 ) {
         isMobileProduct = false;
         numberOfProductSlides = 3;
         } else if (width >= 500) {
         isMobileProduct = false;
         } else {
         isMobileProduct = false;
         numberOfProductSlides = 1;
         }
         */
        if (width > 1250) {
            isMobileProduct = false;
        } else if (width > 991 && width < 1249) {
            isMobileProduct = false;
            numberOfProductSlides = 3;
        } else if (width > 900 && width < 991) {
            isMobileProduct = false;
            numberOfProductSlides = 3;
        } else if (width >= 760 && width < 900) {
            isMobileProduct = false;
            numberOfProductSlides = 3;
        } else if (width >= 701 && width < 760) {
            isMobileProduct = false;
            numberOfProductSlides = 3;
        } else if (width >= 500 && width < 700) {
            isMobileProduct = true;
        } else {
            isMobileProduct = false;
            numberOfProductSlides = 1;
        }
        
        
        
        window.popularProductsSlider = $('.featuredProductSlider .bxslider').
                bxSlider(getPopularProductsOptions(isMobileProduct, numberOfProductSlides));
        
        window.onresize = function () {
            
            var numberOfSlider = null;
            var numberOfProductSlides = null;
            
            var width = $(window).width();
            
            
            if (width > 1250) {
                isMobileProduct = false;
            } else if (width > 991 && width < 1249) {
                isMobileProduct = false;
                numberOfProductSlides = 3;
            } else if (width > 900 && width < 991) {
                isMobileProduct = false;
                numberOfProductSlides = 3;
            } else if (width >= 760 && width < 900) {
                isMobileProduct = false;
                numberOfProductSlides = 3;
            } else if (width >= 701 && width < 760) {
                isMobileProduct = false;
                numberOfProductSlides = 3;
            } else if (width >= 500 && width < 700) {
                isMobileProduct = true;
            } else {
                isMobileProduct = false;
                numberOfProductSlides = 1;
            }
            
            if (window.popularProductsSlider) {
                window.popularProductsSlider.
                        reloadSlider(getPopularProductsOptions(isMobileProduct, numberOfProductSlides));
            }
            
        };
        
    });
    
</script>
@stop
