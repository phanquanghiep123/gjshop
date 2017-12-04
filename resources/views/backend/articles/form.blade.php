<?php

$role = App\Role::where('slug','author')->first();
$authors = NULL;
if($role){
 $authors = $role->users;
}

?>



<div class="tab-block mb25">
    <ul class="nav nav-tabs tabs-border">
        <li class="active">
            <a href="#article_details" data-toggle="tab" aria-expanded="true"> <i class="fa fa-file-o"></i> Article Details</a>
        </li>
        @if(isset($model))
            <li>
                <a href="#related_products" data-toggle="tab" aria-expanded="true"> <i class="fa fa-link"></i> Related Products</a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#" role="menu" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog pl5"></i><i class="fa fa-caret-down pl5"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{!! route('gjadmin.users.edit',$model->user_id) !!}">View author's profile</a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>


    <div class="tab-content">
        <div id="article_details" class="tab-pane active">

            @if(isset($model))
                {!! Former::secure_vertical_open_for_files()->route('gjadmin.articles.update',$model->id)->method('PUT') !!}
                {!! Former::populate($model) !!}
            @else
                {!! Former::secure_vertical_open_for_files( route('gjadmin.articles.store'),'POST')->class('form-horizontal') !!}
            @endif
            <div class="col-md-8">
                <div class="admin-form theme-dark tab-pane" role="tabpanel">
                    <div class="panel panel-dark heading-border">
                        
                        <div class="panel-heading">
                            <span class="panel-title">
                                <i class="fa fa-file-o"></i> Article Form
                            </span>
                        </div><!-- end .form-header section -->
                        <div class="panel-body p25">
                            
                            <div class="section-divider mt10 mb30">
                                <span>Article Details</span>
                            </div> <!-- .section-divider -->
                            <div class="section row">
                                <div class="col-md-6">
                                    {!! Former::text('title')->class('form-control') !!}
                                </div>
                                @if(isset($model))
                                    <div class="col-md-6">
                                        {!! Former::text('slug')->class('form-control')->disabled() !!}
                                    </div>
                                @endif

                                <div class="col-md-6">
                                    <label for="author" class="control-label">Author</label>
                                    <select class="form-control" id="user_id" name="user_id">
                                        @foreach($authors as $author)
                                            <option value="{{$author->id}}" @if( isset($model) && $model->user_id == $author->id) selected="selected" @endif>{{$author->fullname()}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!-- end .section row section -->

                            <div class="section row">
                                <div class="col-md-12">
                                    {!! Former::textarea('description','Description:')->class('form-control summernote') !!}
                                </div>
                                <div class="col-md-12 main_content_editor">
                                    {!! Former::textarea('content','Main Article:')->class('form-control summernote') !!}
                                </div>
                            </div><!-- end .section row section -->


                            <div class="form-group">
                                <label for="title" class="control-label mb20">List Image:</label>
                                <div class="col-sm-12">

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <button type="button" input-name="list_image" multiple des="#product-images-info" class="btn btn-default media-selector">
                                                Select image
                                            </button>
                                        </div>
                                        <div class="col-sm-10">
                                            <div id="product-images-info" class="clearfix">
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
                                </div>
                            </div>



                        </div> <!-- end .panel-body -->
                        <div class="panel-footer">
                            <button type="submit" class="button btn-system dark">Save Article</button>
                        </div> <!-- end .form-footer section -->
                    </div> <!-- end .panel panel-dark heading-border -->
                </div> <!-- end: .admin-form -->
            </div><!-- ./col-md-8 -->


            <div class="col-md-4">
                <!-- Registration 2 -->
                <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                    <div class="panel panel-dark heading-border">
                        <div class="panel-heading">
                            <span class="panel-title">
                                <i class="fa fa-pencil-square"></i> Settings
                            </span>
                        </div>
                        <!-- end .form-header section -->

                        <div class="panel-body p25">
                            <div class="section-divider mt10 mb30">
                                <span>Article Settings</span>
                            </div><!-- .section-divider -->


                            <div class="row">
                                <div class="col-md-12">
                                    {!! Former::text('meta_keywords','Meta Keywords:')->class('form-control') !!}
                                </div>
                                <div class="col-md-12">
                                    {!! Former::textarea('meta_description','Meta Description:')->rows(3)->class('form-control') !!}
                                </div>
                            </div><!-- end .section row section -->


                            <div class="row">
                                <div class="col-md-12">
                                    @if(isset($model))
                                    {!! Former::multiselect('categories','Categories:')->options($categories,$model->getAllCategoriesID())->row('15')->id('catSelect')->class('form-control') !!}
                                    @else
                                    {!! Former::multiselect('categories','Categories:')->options($categories)->row('15')->id('catSelect')->class('form-control') !!}
                                    @endif
                                </div> <!-- end section -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tags" class="control-label">Tags</label>
                                        <select id="tags" class="form-control select2" name="tags[]" multiple>
                                            <option></option>
                                            <?php
                                            if (isset($model)) {
                                                $currentTagsID = $model->tags()->lists('tag_id')->toArray();
                                            } else {
                                                $currentTagsID = array();
                                            }
                                            ?>
                                            @foreach( App\Tag::active()->get() as $tag)
                                            <option <?php if (in_array($tag->id, $currentTagsID)) echo 'selected="selected"' ?> value="{!! $tag->id !!}">{!! $tag->name !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    {!! Former::text('video_link','Article Video:')->class('form-control') !!}
                                </div>
                                <div class="col-md-12">
                                    {!! Former::text('video_placeholder','Article Video Placeholder:')->class('form-control')->id('datetimepicker2') !!}
                                </div>
                                <div class="col-md-12">
                                    {!! Former::select('approved','Approval Status:')->class('form-control')->options(array('2' => 'Pending','1' => 'Approved','3' => 'Rejected')) !!}
                                </div> <!-- end section -->
                                <div class="col-md-12">
                                    {!! Former::select('status','Status:')->class('form-control')->options(array('2' => 'Unpublished','1' => 'Published'))->id('status') !!}
                                </div> <!-- end section -->
                                <div id="post-date-wrapper" id="post-date-wrapper" style="<?php if (isset($model) && $model->status != \App\Article::APPROVED || !isset($model)) echo "display:none" ?>">
                                    <div class="col-md-12">
                                        <?php
                                        $post_date = isset($model) ? $model->post_date : '';
                                        if (!$post_date) {
                                            $post_date = Carbon\Carbon::now()->format("D, d F Y");
                                        }
                                        ?>
                                        {!! Former::text('post_date','Post Date:')->class('form-control')->id('datetimepicker1')->dataDateFormat("D, dd MM yyyy")->forceValue($post_date) !!}
                                    
                                    </div>
                                </div> <!-- end section -->

                            </div> <!-- end .section row section -->
                        </div> <!-- end .form-body section -->

                        <div class="panel-footer">
                            <button type="submit" class="button btn-system dark">Save Settings</button>
                        </div><!-- end .form-footer section -->
                        
                    </div><!-- end .admin-form section -->
                </div><!-- end: .admin-form -->
            </div>
            {!! Former::close() !!}
        </div><!-- ***********************  User Form *********************** -->
        

        @if(isset($model))
            <div id="related_products" class="tab-pane">
                {!! Former::secure_open_vertical_for_files(route('gjadmin.product_related_article.add'),'POST') !!}
                {!! Former::token() !!}
                {!! Former::hidden('article_id',$model->id) !!}     
                 <div class="col-md-6">
                    <div class="admin-form theme-dark tab-pane" role="tabpanel">
                        <div class="panel panel-dark heading-border">
                            <div class="panel-heading">
                                <span class="panel-title">
                                    <i class="fa fa-file-o"></i> Related Products Form
                                </span>
                            </div><!-- end .form-header section -->
                            <div class="panel-body p25">
                                
                                <div class="section-divider mt10 mb30">
                                    <span>Product List</span>
                                </div> <!-- .section-divider -->
                                <div class="section row">
                                    <div class="col-md-12">
                                        
                                        
                                        <?php  
                                            $ids =  DB::table('article_product')->where('article_id',$model->id)->pluck('product_id'); 
                                            $productList = \Modules\Shop\Models\Product::published()->whereNotIn('id',$ids)->orderBy('name','ASC')->get();
                                        ?>
                                        {!! Former::select('product_id','Product')->fromQuery( $productList,'name','id')->class('form-control') !!}
                                        
                                    </div>
                                </div><!-- end .section row section -->
                            </div> <!-- end .panel-body -->
                            <div class="panel-footer">
                                <button type="submit" class="button btn-system dark">Save Related Product</button>
                            </div> <!-- end .form-footer section -->
                            
                        </div> <!-- end .panel panel-dark heading-border -->
                    </div> <!-- end: .admin-form -->
                </div><!-- ./col-md-8 -->
                {!! Former::close() !!}

                <div class="col-md-6">
                    <!-- Registration 2 -->
                    <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                        <div class="panel panel-dark heading-border">
                            <div class="panel-heading">
                                <span class="panel-title">
                                    <i class="fa fa-pencil-square"></i> Products
                                </span>
                            </div>
                            <!-- end .form-header section -->

                            <div class="panel-body p25">
                                <div class="section-divider mt10 mb30">
                                    <span> Products </span>
                                </div><!-- .section-divider -->
                                <div class="row">
                                    <div class="col-md-12">
                                        @foreach( $model->products as $relatedProducts)
                         
                                            <div class="col-sm-12 col-xs-12 small-margin-bottom">
                                    
                                                <a href="{{route('gjadmin.product_related_article.delete',array($relatedProducts->id,$model->id) )}}" class="btn btn-xs btn-danger pull-left small-margin-right"><i class="fa fa-trash-o"></i></a>
                                                
                                                <a href="{{$link}}" target="_blank">
                                                    {{ $relatedProducts->name }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div> <!-- end .section row section -->
                            </div> <!-- end .form-body section -->
                         
                        </div><!-- end .admin-form section -->
                    </div><!-- end: .admin-form -->
                </div>

            </div><!-- ***********************  User Form *********************** -->
        @endif

    </div>
</div>


