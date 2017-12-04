<?php
    $latestArticle = \App\Article::latest()->published()->first();
    $latestProduct = \Modules\Shop\Models\Product::latest()->published()->first();
    $currentRoute = Route::current()->getName();
    $check_arts = ( $currentRoute == 'detailtArticle' && isset($article) && count($article->products) < 2 && count($article->products) > 0 ? '1' : NULL )
?>

<div class="row" id="three-sections-sidebar" @if( $check_arts) style="margin-top:0 !important" @endif>
    <div class="col-sm-12">
        <div class="">
            <div class="row">
                

                <div class="col-md-12 signup-holder">
                    <div class="sign-up">
                        {!! Former::open()
                        ->route('newsletter')
                        ->onsubmit('Newsletter.Signup(this);return false;')->id('newsletterSignup')
                        !!}
                        {!! Former::token() !!}
                        <div class="info">
                            <h4>Keep updated</h4>
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

                <div class="col-sm-12 col-xs-6 product-holder">
                    <div class="latest-product">
                        <a href="{{route('shop.products.show',['slug'=> $latestProduct->slug])}}">
                            <img src="{!! asset( $latestProduct->latest_image ) !!}" class="img-responsive">
                        </a>
                    </div>
                </div>
                
                @include('_partials.frontend.latest_article')



            </div>
        </div>
    </div>
</div>