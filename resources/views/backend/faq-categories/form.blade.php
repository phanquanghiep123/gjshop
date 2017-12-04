<div class="tab-block mb25">
  <ul class="nav nav-tabs tabs-border">
    <li class="active">
      <a href="#user_details" data-toggle="tab" aria-expanded="true"> <i class="glyphicon glyphicon-user"></i> Faq Category Details</a>
    </li>

    @if(isset($model))
        <li class="dropdown">
          <a class="dropdown-toggle" href="#" role="menu" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog pl5"></i><i class="fa fa-caret-down pl5"></i>
          </a>
          <ul class="dropdown-menu">
            <li>
            {!! Former::open()->route('gjadmin.faq-categories.destroy', $model->id)->method('DELETE')!!}    
            {!! Former::token() !!}                                  
            <button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete Category</button>
            {!! Former::close() !!}
            </li>
          </ul>
        </li>
    @endif
  </ul>
  <div class="tab-content">

    <div id="user_details" class="tab-pane active">
    {!! Former::open_vertical()->route('gjadmin.faq-categories.update', $model->id)->method('PUT') !!}
    {!! Former::populate($model) !!}
    {!! Former::token() !!}  
        
            <div class="col-md-4">
              <!-- Registration 2 -->
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="fa fa-pencil-square"></i>Faq Category
                    </span>
                  </div>
                  <!-- end .form-header section -->

                    <div class="panel-body p25">
                      <div class="section-divider mt10 mb40">
                        <span>Faq Category Details</span>
                      </div>
                      <!-- .section-divider -->

                      <div class="row">
                        <div class="col-md-12">
                            {!! Former::text('name')->class('form-control') !!}
                        </div> <!-- end section -->
                        <div class="col-md-12">
                            {!! Former::number('order')->class('form-control') !!}
                        </div> <!-- end section -->
                        <div class="col-md-12">
                            {!! Former::select('status','Category:')->options(array('1' => 'Active','2' => 'Inactive'))->class('form-control')->required() !!}
                        </div> <!-- end section -->
                      </div> <!-- end .section row section -->


                    </div><!-- end .form-body section -->
                    <div class="panel-footer">
                      <button type="submit" class="button btn-system dark">Update Faq Category</button>
                    </div><!-- end .form-footer section -->
                </div><!-- end .admin-form section -->
              </div><!-- end: .admin-form -->
            </div>
        
    </div><!-- ***********************  User Form *********************** -->



  </div>
</div>
{!! Former::close() !!}

