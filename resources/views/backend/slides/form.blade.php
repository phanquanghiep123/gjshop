<div class="tab-block mb25">
  <ul class="nav nav-tabs tabs-border">
    <li class="active">
      <a href="#user_details" data-toggle="tab" aria-expanded="true"> <i class="glyphicon glyphicon-user"></i> Slide Details</a>
    </li>

    @if(isset($model))
        <li class="dropdown">
          <a class="dropdown-toggle" href="#" role="menu" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog pl5"></i><i class="fa fa-caret-down pl5"></i>
          </a>
          <ul class="dropdown-menu">
            <li>
              {!! Form::open(['method' => 'DELETE', 'route' => ['gjadmin.slides.destroy', $model->id]]) !!}                                    
              <button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete Slide</button>
              {!! Former::close() !!}
            </li>
          </ul>
        </li>
    @endif
  </ul>
  <div class="tab-content">

    <div id="user_details" class="tab-pane active">
    @if (isset($model))
        {!! Former::open_vertical()->route('gjadmin.slides.update',$model->id)->method('PUT') !!}
        {!! Former::populate($model) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'gjadmin.slides.store']) !!}
    @endif
        {!! Former::token() !!}

            <!-- Registration 2 -->
            <div class="col-md-8">
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="glyphicon glyphicon-user"></i> Slide Form
                    </span>
                  </div>
                  <!-- end .form-header section -->

                 
                    <div class="panel-body p25">
                      <div class="section-divider mt10 mb40">
                        <span>Slide Details</span>
                      </div> <!-- .section-divider -->
                      

                      <div class="form-group">
                            <label for="title" class="control-label mb20">Image:</label>
                            <div class="col-sm-12">

                                <div class="row">
                                    <div class="col-sm-2">
                                        <button type="button" input-name="image" multiple des="#product-images-info" class="btn btn-default media-selector">
                                            Select image
                                        </button>
                                    </div>
                                    <div class="col-sm-12">
                                        <div id="product-images-info" class="clearfix">
                                            @if (isset($model))
                                                <?php $image = $model->image; ?>
                                                @if($image) 
                                                  <div class="row">
                                                    <div class="file-selected col-md-12">
                                                        <input name="image" value="{{$image}}" type="hidden">
                                                        <img src="{{url($image)}}" class="thumbnail img-responsive">
                                                        <button onclick="removeFileSelected(this)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>
                                                    </div>
                                                  </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="section row">
                        <div class="col-md-12">
                            {!! Former::text('caption','Caption:')->class('form-control') !!}
                        </div>
                      </div><!-- end .section row section -->

                      <div class="section row">
                        <div class="col-md-6">
                            {!! Former::text('caption_colour','Caption Colour:')->rows(5)->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::text('caption_position','Caption Position:')->rows(5)->class('form-control') !!}
                        </div>
                      </div><!-- end .section row section -->

                      <div class="section row">
                        <div class="col-md-6">
                            {!! Former::text('order','Order:')->rows(5)->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::select('status','Status:')->class('form-control')->options(array('1' => 'Active','2' => 'Inactive'))->placeholder('Select Status') !!}
                        </div>
                      </div><!-- end .section row section -->

                    </div> <!-- end .form-body section -->


                    <div class="panel-footer">
                      <button type="submit" class="button btn-system dark">Save Slide</button>
                    </div>
                  
                </div>
              </div>
             </div>


    </div>


  </div>
</div>
{!! Former::close() !!}






