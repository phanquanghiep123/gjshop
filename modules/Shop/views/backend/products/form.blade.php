


<div class="tab-block mb25">
    <ul class="nav nav-tabs tabs-border">
        <li class="active">
            <a href="#page" data-toggle="tab" aria-expanded="true"> <i class="fa fa-file-o"></i> Product Details</a>
        </li>
        <li>
            <a href="#product_images" data-toggle="tab" aria-expanded="true"> <i class="fa fa-image"></i> Product Images</a>
        </li>
        <li>
            <a href="#extra_info" data-toggle="tab" aria-expanded="true"> <i class="fa fa-file-o"></i> Extra Information</a>
        </li>
        @if(isset($model))
        <li>
            <a href="#related_articles" data-toggle="tab" aria-expanded="true"> <i class="fa fa-chain"></i> Related Articles</a>
        </li>
        <li>
            <a href="#reviews" data-toggle="tab" aria-expanded="true"> <i class="fa fa-comments"></i> Reviews </a>
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" href="#" role="menu" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog pl5"></i><i class="fa fa-caret-down pl5"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#tab8_4" tabindex="-1" data-toggle="tab">Delete {{$model->name}}</a>
                </li>
            </ul>
        </li>
        @endif
    </ul>
    <div class="tab-content">

        <div id="page" class="tab-pane active"> <!-- ***********************  User Form *********************** -->
            <div class="col-md-8">
                @if (isset($model))
                {!! Former::secure_open_vertical_for_files()->method('PUT')->route('gjadmin.shop.products.update', $model->id) !!}
                {!! Former::populate($model) !!}
                @else
                {!! Former::secure_open_vertical_for_files()->route('gjadmin.shop.products.store') !!}
                @endif
                {!! Former::token() !!}
                <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                    <div class="panel panel-dark heading-border">
                        <div class="panel-heading">
                            <span class="panel-title">
                                <i class="fa fa-file-o"></i> Product Form
                                @if(isset($model))
                                <img src="{{ url($model->list_image) }}" width="40" class="pull-right">
                                @endif
                            </span>
                        </div>
                        <!-- end .form-header section -->


                        <div class="panel-body p25">
                            <div class="section-divider mt10 mb40">
                                <span>Product Information</span>
                            </div> 

                            <div class="section row">
                                <div class="col-md-6">
                                    {!! Former::text('name')->class('form-control') !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Former::text('slug')->class('form-control') !!}
                                </div>
                            </div>

                            <div class="section row">
                                <div class="col-md-12">
                                    {!! Former::textarea('list_description','List Description:')->class('form-control summernote') !!}
                                </div>
                                <div class="col-md-12">
                                    {!! Former::textarea('description','Product Intro Text:')->class('form-control summernote') !!}
                                </div>
                                <div class="col-md-12">
                                    {!! Former::textarea('content','Product Information:')->class('form-control summernote') !!}
                                </div>
                                <div class="col-md-12">
                                    {!! Former::checkboxes('categories','Categories:')->checkboxes($categories) !!}
                                </div>
                            </div><!-- end .section row section -->
                        </div> <!-- end .form-body section -->


                        <div class="panel-footer">
                            <button type="submit" class="button btn-system dark">Save Product</button>
                        </div>
                        <!-- end .form-footer section -->

                    </div>
                    <!-- end .admin-form section -->
                </div>
                <!-- end: .admin-form -->
            </div>


            <div class="col-md-4">
                <!-- Registration 2 -->
                <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                    <div class="panel panel-dark heading-border">
                        <div class="panel-heading">
                            <span class="panel-title">
                                <i class="fa fa-cogs"></i> Settings
                            </span>
                        </div>
                        <!-- end .form-header section -->

                        <div class="panel-body p25">
                            <div class="section-divider mt10 mb40">
                                <span>Product Settings</span>
                            </div>
                            <!-- .section-divider -->
                            <?php
                            if (isset($model)) {
                                $priceSrvice = new Modules\Shop\Services\PriceWithSaleService($model);
                                $salePrice = $priceSrvice->getSalePriceFromMeta('GBP');
                                $regularPrice = $priceSrvice->getRegularPriceFromMeta('GBP');
                                Former::populateField('gbp_regular_price', $regularPrice);
                                Former::populateField('gbp_sale_price', $salePrice);
                            }
                            ?>
                            <div class="row">

                                <div class="col-md-12">
                                    {!! Former::textarea('meta_keywords','Meta Keywords:')->rows(3)->class('form-control') !!}
                                </div>
                                <div class="col-md-12">
                                    {!! Former::textarea('meta_description','Meta Description:')->rows(3)->class('form-control') !!}
                                </div>
                                <div class="col-sm-12">
                                    {!! Former::text('ean','EAN / SKU#:')->class('form-control') !!}
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    {!! Former::text('gbp_regular_price','£ Price:')->class('form-control') !!}
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    {!! Former::text('gbp_sale_price','£ Sale:')->class('form-control') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    {!! Former::text('regular_price','$ Price:')->class('form-control') !!}
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    {!! Former::text('sale_price','$ Sale:')->class('form-control') !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Former::text('inventory')->class('form-control') !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Former::text('points')->class('form-control') !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Former::text('displayed_weight','Product Size:')->class('form-control') !!}
                                </div>
                                <div class="col-sm-6">
                                    {!! Former::text('weight','Shipping Weight (g):')->class('form-control') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Former::text('dimentions')->class('form-control') !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Former::text('size_uk','UK Post Size')->class('form-control') !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Former::text('size_us','US Post Size')->class('form-control') !!}
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox-custom mb15">
                                        <input type="checkbox" name="is_featured" value="1" <?php if (isset($model) && $model->is_featured == 1) { ?> checked=""  <?php } ?> id="checkboxDefault3">
                                        <label for="checkboxDefault3">Featured</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    {!! Former::select('status','Status:')->class('form-control')->options(array('1' => 'Active','2' => 'Inactive'))->placeholder('Select Status') !!}
                                </div>
                            </div> <!-- end .section row section -->

                        </div><!-- end .form-body section -->
                        <div class="panel-footer">
                            <button type="submit" class="button btn-system dark">Save Settings</button>
                        </div><!-- end .form-footer section -->
                    </div><!-- end .admin-form section -->
                </div><!-- end: .admin-form -->
            </div>
        </div><!-- ***********************  User Form *********************** -->




        <div id="product_images" class="tab-pane">
            <div class="col-md-8">
                <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                    <div class="panel panel-dark heading-border">
                        <div class="panel-heading">
                            <span class="panel-title">
                                <i class="fa fa-file-o"></i> Images Form
                            </span>
                        </div>
                        <!-- end .form-header section -->


                        <div class="panel-body p25">
                            <div class="section-divider mt10 mb40">
                                <span>Product Image Information</span>
                            </div> <!-- .section-divider -->

                            <div class="section row">
                                <div class="col-md-12">

                                    <button type="button" input-name="images[]" multiple des="#product-images-info" class="btn btn-default media-selector">
                                        Edit images
                                    </button>
                                    <div id="product-images-info" class="clearfix">
                                        <div class="row">
                                            @if (isset($model))
                                            <?php
                                                $images = $model->images;
                                                if(is_array($images)) :
                                                foreach ($images as $img):
                                            ?>
                                            <div class="file-selected col-md-4 col-sm-6">
                                                <input name="images[]" value="{{$img}}" type="hidden">
                                                <img src="{{url($img)}}" class="thumbnail img-responsive">
                                                <button onclick="removeFileSelected(this)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
                                            </div>
                                            <?php
                                                endforeach;
                                                endif;
                                            ?>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end .section row section -->
                        </div> <!-- end .form-body section -->

                        <div class="panel-footer">
                            <button type="submit" class="button btn-system dark">Save Product</button>
                        </div><!-- end .form-footer section -->

                    </div><!-- end .admin-form section -->
                </div><!-- end: .admin-form -->
            </div>


            <div class="col-md-4">
                <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                    <div class="panel panel-dark heading-border">
                        <div class="panel-heading">
                            <span class="panel-title">
                                <i class="fa fa-cogs"></i> Images
                            </span>
                        </div><!-- end .form-header section -->

                        <div class="panel-body p25">
                            <div class="section-divider mt10 mb40">
                                <span>Product Images</span>
                            </div>



                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <button type="button" input-name="list_image" multiple des="#product-image-info" class="btn btn-default media-selector">
                                        Select image
                                    </button>
                                    <div id="product-image-info" class="clearfix">
                                        @if (isset($model))
                                            <?php $image = $model->list_image; ?>
                                            @if($image) 
                                                <div class="file-selected col-md-4">
                                                    <input name="list_image" value="{{$image}}" type="hidden">
                                                    <img src="{{url($image)}}" class="thumbnail img-responsive">
                                                    <button onclick="removeFileSelected(this)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>





                        </div><!-- end .form-body section -->
                        <div class="panel-footer">
                            <button type="submit" class="button btn-system dark">Save Images</button>
                        </div><!-- end .form-footer section -->
                    </div><!-- end .admin-form section -->
                </div><!-- end: .admin-form -->
            </div>
        </div><!-- ***********************  product images Form *********************** -->



        <div id="extra_info" class="tab-pane">
            <div class="col-md-8">
                <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                    <div class="panel panel-dark heading-border">
                        <div class="panel-heading">
                            <span class="panel-title">
                                <i class="fa fa-file-o"></i> Extra Content Form
                            </span>
                        </div><!-- end .form-header section -->
                        <div class="panel-body p25">
                            <div class="section-divider mt10 mb40">
                                <span>Extra Content Information</span>
                            </div> <!-- .section-divider -->

                            <div class="section row">
                                <div class="col-md-12 main_content_editor">
                                    {!! Former::textarea('extra_content','Extra Content:')->class('form-control summernote') !!}
                                </div>
                            </div><!-- end .section row section -->
                        </div> <!-- end .form-body section -->
                        <div class="panel-footer">
                            <button type="submit" class="button btn-system dark">Save Product</button>
                        </div><!-- end .form-footer section -->
                        {!! Former::close() !!}
                    </div><!-- end .admin-form section -->
                </div><!-- end: .admin-form -->
            </div>
        </div><!-- ***********************  extra info Form *********************** -->




        @if(isset($model))
         <div id="related_articles" class="tab-pane">

            {!! Former::secure_open_vertical_for_files(route('gjadmin.product_related_article.add'),'POST') !!}
            {!! Former::token() !!}
            {!! Former::hidden('product_id',$product->id) !!}
            <div class="col-md-6">
                <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                    <div class="panel panel-dark heading-border">
                        <div class="panel-heading">
                            <span class="panel-title">
                                <i class="fa fa-chain"></i> Add Related Article Form
                            </span>
                        </div><!-- end .form-header section -->
                        <div class="panel-body p25">

                            <div class="section-divider mt10 mb40">
                                <span>Related Article Information</span>
                            </div> <!-- .section-divider -->

                            <div class="section row">
                                <div class="col-md-12">
                                    <?php  
                                        $ids =  DB::table('article_product')->where('product_id',$model->id)->pluck('article_id'); 
                                        $articleList = App\Article::approved()->posted()->whereNotIn('id',$ids)->orderBy('title','ASC')->get();
                                    ?>
                                    {!! Former::select('article_id','Available Articles')->fromQuery( $articleList ,'title','id')->class('form-control')->placeholder('Select Article') !!}
                                </div>
                            </div><!-- end .section row section -->

                        </div> <!-- end .form-body section -->
                        <div class="panel-footer">
                            <button type="submit" class="button btn-system dark">Add Related Article</button>
                        </div><!-- end .form-footer section -->

                    </div><!-- end .admin-form section -->
                </div><!-- end: .admin-form -->
            </div>
            {!! Former::close() !!}


            
            <div class="col-md-6">
                <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                    <div class="panel panel-dark heading-border">
                        <div class="panel-heading">
                            <span class="panel-title">
                                <i class="fa fa-chain"></i> Related Articles
                            </span>
                        </div><!-- end .form-header section -->
                        <div class="panel-body p25">
                            

                            <div class="section-divider mt10 mb40">
                                <span>Related Articles</span>
                            </div> <!-- .section-divider -->
                            <div class="section row">
                                <div class="col-md-12">
                                    <div class="row">

                                        @foreach( $product->articles as $relatedArticle)
                                        <?php  
                                            $category = $relatedArticle->categories->first();
                                            $link = route('detailtArticle',['categorySlug'=>$category->slug,'slug'=>$relatedArticle->slug]);
                                        ?>
                                            
                                            <div class="col-sm-12 col-xs-12 small-margin-bottom">
                                    
                                                <a href="{{route('gjadmin.product_related_article.delete',array($product->id,$relatedArticle->id) )}}" class="btn btn-xs btn-danger pull-left small-margin-right"><i class="fa fa-trash-o"></i></button>
                                                
                                                <a href="{{$link}}" target="_blank">
                                                    {{ $relatedArticle->title }} - 
                                                    <label>
                                                        <small> 
                                                            @if($relatedArticle->status ==1)
                                                               {{ $relatedArticle->post_date }} 
                                                            @else
                                                                <a href="{!! url('nfladmin/articles/' . $relatedArticle->id  . '/edit') !!}">Unpublished</a>
                                                            @endif
                                                        </small>
                                                    </label> 
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div><!-- end .section row section -->
                        </div> <!-- end .form-body section -->
                    </div><!-- end .admin-form section -->
                </div><!-- end: .admin-form -->
            </div>
        </div>
        


        <div id="reviews" class="tab-pane">

            {!! Former::secure_open_vertical_for_files()->route('gjadmin.shop.products.store') !!}
            {!! Former::token() !!}
            <div class="col-md-4">
                <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                    <div class="panel panel-dark heading-border">
                        <div class="panel-heading">
                            <span class="panel-title">
                                <i class="fa fa-comment"></i> Add Review
                            </span>
                        </div><!-- end .form-header section -->
                        <div class="panel-body p25">

                            <div class="section-divider mt10 mb40">
                                <span>Product Review Information</span>
                            </div> <!-- .section-divider -->

                            <div class="section row">
                                <div class="col-md-12">
                                    {!! Former::text('user_id','Customer')->class('form-control') !!}
                                </div>
                                
                                <div class="col-md-12">
                                    {!! Former::textarea('comment')->rows(3)->class('form-control') !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Former::select('rating')->options(array( '1'=>'1 Very Disappointed','2'=>'2 Disappointed','3'=>'3 Average','4'=>'4 Pretty Good','5'=>'5 Great'))->placeholder('Select Rating')->class('form-control') !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Former::select('status')->options(array( '1'=>'Approved','0'=>'Pending'))->placeholder('Select Status')->class('form-control') !!}
                                </div>
                            </div><!-- end .section row section -->

                        </div> <!-- end .form-body section -->
                        <div class="panel-footer">
                            <button type="submit" class="button btn-system dark">Add Review</button>
                        </div><!-- end .form-footer section -->

                    </div><!-- end .admin-form section -->
                </div><!-- end: .admin-form -->
            </div>
            {!! Former::close() !!}
            <div class="col-md-8">
                <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                    <div class="panel panel-dark heading-border">
                        <div class="panel-heading">
                            <span class="panel-title">
                                <i class="fa fa-comments"></i> Product Reviews
                            </span>
                        </div><!-- end .form-header section -->
                        <div class="panel-body p25">


                            <div class="section-divider mt10 mb40">
                                <span>Pending Reviews</span>
                            </div> <!-- .section-divider -->
                            <div class="section row">
                                <div class="col-md-12">
                                    <div class="row">
                                        
                                        <?php 
                                        $reviews = NULL;
                                        if(isset($model)) $reviews = Modules\Shop\Models\ProductReview::where('product_id',$model->id)->pending()->orderBy('created_at', 'desc')->get(); 
                                        ?>
                                        @if( count($reviews) )
                                            @foreach($reviews as $review)
                                                <div class="col-sm-6">
                                                   
                                                    <div class="review">
                                                        <p class="reviewer">
                                                            {!! $review->name !!} | 
                                                            <small class="text-system">{!! starRating($review->rating) !!}</small>
                                                            <span class="pull-right">{!! date("D, d M Y - H:i",strtotime($review->created_at)) !!}</span>
                                                        </p>
                                                        <p> {!! $review->comment !!}</p>
                                                    </div>
                                                  
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-sm-12"><p class="text-danger align-center"><em>No pending reviews</em></p></div>
                                        @endif
                                    
                                    </div>
                                </div>
                            </div><!-- end .section row section -->
                        </div> <!-- end .form-body section -->
                    </div><!-- end .admin-form section -->
                </div><!-- end: .admin-form -->
            </div>
            
        </div><!-- ***********************  related articles Form *********************** -->
        @endif




    </div>
</div>





















