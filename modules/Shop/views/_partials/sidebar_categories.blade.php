<?php
    $cats =Modules\Shop\Models\ProductCategory::root()->actived()->get();
    if(!isset($loggedUser)){
        $loggedUser = \Auth::user();
    }
?>
<ul class="large-margin-bottom">
    @include("shop::products._search")

    <li><h3 class="sidebarCatTitle">Product Categories</h3></li>
    @foreach($cats as $cat )
        @if($cat->show_in_menu == 1)
        <li> <h3 class="sidebarRootCatTitle">{{$cat->name}}</h3></li>
        @endif
        <ul class="sidebarChildCatTitle">
            @foreach($cat->childs as $child)
            <li><a href="{{route('shop.categories.showChildCategory',['slug'=>$child->slug])}}">{{$child->name}}</a></li>
            @endforeach
        </ul>
    @endforeach
</ul>


@if($loggedUser)
<div class="portlet">
    <div class="portlet-body">
        @include('_partials.frontend.side_quick_links')
    </div>
</div> 
<hr>
@endif

<h3 class="sidebarCatTitle small-margin-bottom">Favorite Products <i class="fa fa-heart text-danger"></i></h3>
@if(!$loggedUser)
    <p><em>You must be logged in to manage favorites</em></p>
@else
    <div id='user-favorite-products'>
        @include('shop::_partials.favoriteProducts')
    </div>
@endif






@if(isset($show_sidebar))
<?php

$latestArticle = \App\Article::latest()->published()->first();
$latestProduct = \Modules\Shop\Models\Product::latest()->published()->first();

?>

<div class="row hidden-sm hidden-xs" id="three-sections-sidebar">
    <div class="col-sm-12">
        <div class="middle-row">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <a href="{{route('shop.products.show',['slug'=> $latestProduct->slug])}}">
                            <img src="{!! asset( $latestProduct->latest_image ) !!}" class="img-responsive">
                        </a>
                    </div>
                </div>
                
                <div class="col-md-12 signup-holder">
                    <div class="sign-up">
                         {!! Former::open()
                            ->route('newsletter')
                            ->onsubmit('Newsletter.Signup(this);return false;')->id('newsletterSignup')
                        !!}
                        {!! Former::token() !!}
                        <div class="info">
                            <h4>Keep Updated</h4>
                            <p>Articles, product releases, offers &amp; more</p>
                        </div>
                        <input name="signup_name" class="form-control signup-name" placeholder="Enter your name...">
                        <div class="submit-container">
                            <input name="signup_email" class="form-control signup-email" placeholder="Enter your email...">
                            <button class="btn signup-button">Sign Up</button>
                        </div>
                        {!! Former::close() !!}
                        <br clear="all"/>
                    </div>
                </div>

                @include('_partials.frontend.latest_article')
               
            </div>
        </div>
    </div>
</div>
@endif

