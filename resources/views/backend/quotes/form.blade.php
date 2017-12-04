<div class="tab-block mb25">
  <ul class="nav nav-tabs tabs-border">
    <li class="active">
      <a href="#user_details" data-toggle="tab" aria-expanded="true"> <i class="glyphicon glyphicon-user"></i> Quote Details</a>
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
        {!! Former::open_vertical()->route('gjadmin.quotes.update',$model->id)->method('PUT') !!}
        {!! Former::populate($model) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'gjadmin.quotes.store']) !!}
    @endif
        {!! Former::token() !!}

            <!-- Registration 2 -->
            <div class="col-md-8">
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="glyphicon glyphicon-user"></i> Quote Form
                    </span>
                  </div>
                  <!-- end .form-header section -->

                 
                    <div class="panel-body p25">
                      <div class="section-divider mt10 mb40">
                        <span>Quote Details</span>
                      </div> <!-- .section-divider -->

                      <div class="section row">
                        <div class="col-md-6">
                            {!! Former::select('category_id','Category:')->fromQuery( \App\Category::getAllCategoriesWithChildsByArray(),'name','id')->placeholder('Select Category')->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::text('author','Author:')->class('form-control') !!}
                        </div>
                      </div><!-- end .section row section -->

                      <div class="section row">
                        <div class="col-md-12">
                            {!! Former::textarea('quote','Description')->rows(5)->class('form-control summernote') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::select('status','Status:')->class('form-control')->options(array('2' => 'Unpublished','1' => 'Published'))->id('status') !!}
                        </div> <!-- end section -->
                      </div><!-- end .section row section -->

                    </div> <!-- end .form-body section -->


                    <div class="panel-footer">
                      <button type="submit" class="button btn-system dark">Save Quote</button>
                    </div>
                    <!-- end .form-footer section -->
                  
                </div>
                <!-- end .admin-form section -->
              </div>
              <!-- end: .admin-form -->
             </div>


        </div>


  </div>
</div>
{!! Former::close() !!}









