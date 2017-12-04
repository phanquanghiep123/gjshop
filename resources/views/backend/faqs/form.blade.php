<div class="tab-block mb25">
  <ul class="nav nav-tabs tabs-border">
    <li class="active">
      <a href="#user_details" data-toggle="tab" aria-expanded="true"> <i class="glyphicon glyphicon-user"></i> Faq Details</a>
    </li>

    @if(isset($model))
	    <li class="dropdown">
	      <a class="dropdown-toggle" href="#" role="menu" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog pl5"></i><i class="fa fa-caret-down pl5"></i>
	      </a>
	      <ul class="dropdown-menu">
	        <li>
			{!! Former::open()->route('gjadmin.faqs.destroy', $model->id)->method('DELETE')!!}    
			{!! Former::token() !!}                                  
			<button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete Faq</button>
			{!! Former::close() !!}
	        </li>
	      </ul>
	    </li>
    @endif
  </ul>
  <div class="tab-content">

    <div id="user_details" class="tab-pane active">
    @if(isset($model))
      {!! Former::secure_vertical_open_for_files()->route('gjadmin.faqs.update', $model->id)->method('PUT') !!}
      {!! Former::populate($model) !!}
    @else
      {!! Former::secure_vertical_open_for_files()->route('gjadmin.faqs.store')->method('POST') !!}
    @endif
	    {!! Former::token() !!}  
       	
            <div class="col-md-6">
              <!-- Registration 2 -->
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="fa fa-pencil-square"></i>Faq
                    </span>
                  </div>
                  <!-- end .form-header section -->

                    <div class="panel-body p25">
                      <div class="section-divider mt10 mb40">
                        <span>Faq Details</span>
                      </div>
                      <!-- .section-divider -->

                      <div class="row">
                      	<div class="col-md-12">
		                      {!! Former::textarea('question')->rows(3)->class('form-control') !!}
                        </div>
                        <div class="col-md-12">
                          {!! Former::textarea('answer')->rows(6)->class('form-control summernote') !!}
                        </div> 
                        <div class="col-md-12">
                        	{!! Former::select('faq_category_id','Category:')->fromQuery( App\FaqCategory::active()->get(), 'name','id')->class('form-control')->required() !!}
                        </div> 
                        <div class="col-md-12">
                          {!! Former::text('order')->class('form-control') !!}
                        </div> 
                        <div class="col-md-12">
                          {!! Former::select('status')->options(array('1'=>'Acive','2'=>'Inactive'))->class('form-control')->required() !!}
                        </div> 
                      </div> <!-- end .section row section -->


                    </div>
                    <!-- end .form-body section -->
                    <div class="panel-footer">
                      <button type="submit" class="button btn-system dark">Save Faq</button>
                    </div>
                    <!-- end .form-footer section -->
                </div>
                <!-- end .admin-form section -->
              </div>
              <!-- end: .admin-form -->
            </div>
        
    </div><!-- ***********************  User Form *********************** -->



  </div>
</div>
{!! Former::close() !!}


