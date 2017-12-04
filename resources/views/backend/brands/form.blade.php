<div class="tab-block mb25">
  <ul class="nav nav-tabs tabs-border">
    <li class="active">
      <a href="#user_details" data-toggle="tab" aria-expanded="true"> <i class="glyphicon glyphicon-user"></i> Brand Details</a>
    </li>

    @if(isset($model))
        <li class="dropdown">
          <a class="dropdown-toggle" href="#" role="menu" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog pl5"></i><i class="fa fa-caret-down pl5"></i>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="#tab8_4" tabindex="-1" data-toggle="tab">Delete {{$model->f_name}}</a>
            </li>
          </ul>
        </li>
    @endif
  </ul>
  <div class="tab-content">

    <div id="user_details" class="tab-pane active">
    @if (isset($model))
        {!! Former::open_vertical()->route('gjadmin.brands.update',$model->id)->method('PUT') !!}
        {!! Former::populate($model) !!}
    @else
        {!! Former::open_vertical()->route('gjadmin.brands.store')->method('POST') !!}
    @endif
        {!! Former::token() !!}

            <!-- Registration 2 -->
            <div class="col-md-8">
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="glyphicon glyphicon-user"></i> Brand Form
                    </span>
                  </div>
                  <!-- end .form-header section -->

                 
                    <div class="panel-body p25">
                      <div class="section-divider mt10 mb40">
                        <span>Brand Details</span>
                      </div> <!-- .section-divider -->

                      <div class="section row">
                        <div class="col-md-6">
                            {!! Former::text('name','Name:')->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::text('slug','Slug:')->class('form-control') !!}
                        </div>
                      </div><!-- end .section row section -->

                      <div class="section row">
                        <div class="col-md-12">
                            {!! Former::textarea('description','Description')->rows(5)->class('form-control summernote') !!}
                        </div>
                        <div class="col-md-12">
                            {!! Former::textarea('content','Content')->rows(5)->class('form-control summernote') !!}
                        </div>
                      </div><!-- end .section row section -->

                
                        <div class="form-group">
                            <label for="title" class="control-label mb20">List Image:</label>
                            <div class="col-sm-12">

                                <div class="row">
                                    <div class="col-sm-2">
                                        <button type="button" input-name="brand_logo" multiple des="#product-images-info" class="btn btn-default media-selector">
                                            Select image
                                        </button>
                                    </div>
                                    <div class="col-sm-10">
                                        <div id="product-images-info" class="clearfix">
                                            @if (isset($model))
                                                <?php $image = $model->brand_logo; ?>
                                                @if($image) 
                                                    <div class="file-selected col-md-4">
                                                        <input name="brand_logo" value="{{$image}}" type="hidden">
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
                    </div> <!-- end .form-body section -->


                    <div class="panel-footer">
                      <button type="submit" class="button btn-system dark">Save Brand</button>
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
                      <i class="fa fa-pencil-square"></i>Brand Setttings
                    </span>
                  </div>
                  <!-- end .form-header section -->

                    <div class="panel-body p25">

                      <div class="row">
                        <div class="col-md-12">
                            {!! Former::text('meta_keywords','Keywords:')->class('form-control') !!}
                        </div>
                        <div class="col-md-12">
                            {!! Former::textarea('meta_description','Description:')->rows(4)->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::select('status')->class('form-control')->options(array('1' => 'Active','2' => 'Inactive'))->placeholder('Select Status') !!}
                        </div>
                      </div> <!-- end .section row section -->


                    </div>
                    <!-- end .form-body section -->
                    <div class="panel-footer">
                      <button type="submit" class="button btn-system dark">Save Brand</button>
                    </div>
                    <!-- end .form-footer section -->
                </div>
                <!-- end .admin-form section -->
              </div>
              <!-- end: .admin-form -->
            </div>

        <!-- ***********************  User Form *********************** -->
    </div>


  </div>
</div>
{!! Former::close() !!}






