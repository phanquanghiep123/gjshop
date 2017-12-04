<div class="container" id="three-sections">
    <div class="row">
        <div class="col-sm-12">
            <div class="middle-row">
                <div class="row">
                    
                    
                    @if($latestArticle)
                        <?php 
                        $category = $latestArticle->categories->first();
                        $link = route('detailtArticle',['categorySlug'=>$category->slug,'slug'=>$latestArticle->slug]); 
                        ?>
                        
                        <div class="col-md-4 col-sm-6 col-xs-12 article-holder">
                            <div class="latest-article">
                                <a href="{!! $link !!}">
                                    <img src="{!! asset( $latestArticle->list_image ) !!}" class="img-responsive" alt="{!! $latestArticle->title !!}">
                                </a>
                                <!-- div class="article-title">
                                     {!! $latestArticle->title !!} 
                                </div-->
                            </div>
                        </div>
                    @endif
                    <div class="col-md-4 col-sm-6 col-xs-12 product-holder">
                        <div class="latest-product">
                            <a href="{{route('shop.products.show',['slug'=> $latestProduct->slug])}}">
                                <img src="{!! asset( $latestProduct->latest_image ) !!}" class="img-responsive">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 signup-holder">
                        <img src="{!! asset('/assets/frontend/images/signup-bg.jpg') !!}" class="img-responsive signup-bg">
                        <div class="sign-up">
                            {!! Former::open()
                            ->route('newsletter')
                            ->onsubmit('Newsletter.Signup(this);return false;')->id('newsletterSignup')
                            !!}
                            {!! Former::token() !!}
                            <div class="info">
                                <h4>Keep updated</h4>
                                <p>Articles, product releases, special offers &amp; more</p>
                            </div>
                            <input name="signup_name" class="form-control signup-name" placeholder="Enter your name...">
                            <div class="submit-container">
                                <input name="signup_email" class="form-control signup-email" placeholder="Enter your email...">
                                <button class="btn signup-button">Sign Up</button>
                            </div>
                            {!! Former::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>