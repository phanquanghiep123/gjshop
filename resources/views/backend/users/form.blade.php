@if (isset($model))
    {!! Former::open_vertical()->route('gjadmin.users.update',$model->id)->method('PUT') !!}
    {!! Former::populate($model) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'gjadmin.users.store']) !!}
@endif
	{!! Former::token() !!}

<div class="tab-block mb25">
  <ul class="nav nav-tabs tabs-border">
    <li class="active">
      <a href="#user_details" data-toggle="tab" aria-expanded="true"> <i class="glyphicon glyphicon-user"></i> User Details</a>
    </li>

    @if(isset($model))
	    <li class="dropdown">
	      <a class="dropdown-toggle" href="#" role="menu" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog pl5"></i><i class="fa fa-caret-down pl5"></i>
	      </a>
	      <ul class="dropdown-menu">
	        <li>
	          <a href="#tab8_3" tabindex="-1" data-toggle="tab">Login as {{$model->f_name}} </a>
	        </li>
	        <li>
	          <a href="#tab8_4" tabindex="-1" data-toggle="tab">Delete {{$model->f_name}}</a>
	        </li>
	      </ul>
	    </li>
    @endif
  </ul>
  <div class="tab-content">

    <div id="user_details" class="tab-pane active">
     <!-- ***********************  User Form *********************** -->

       		<!-- Registration 2 -->
       		<div class="col-md-8">
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="glyphicon glyphicon-user"></i> User Account Form
                    </span>
                  </div>
                  <!-- end .form-header section -->

                 
                    <div class="panel-body p25">
                      <div class="section-divider mt10 mb40">
                        <span>Users Account Details</span>
                      </div> <!-- .section-divider -->

                      <div class="section row">
                        <div class="col-md-6">
                          	{!! Former::text('f_name','First Name:')->class('form-control')->placeholder('First name...') !!}
                        </div>
                        <div class="col-md-6">
                          {!! Former::text('l_name','Last Name:')->class('form-control')->placeholder('First name...') !!}
                        </div>
                      </div><!-- end .section row section -->

                      <div class="section row">
                        <div class="col-md-6">
                          	{!! Former::text('mobile','Contact No:')->class('form-control')->placeholder('Contact No...') !!}
                        </div>
                        <div class="col-md-6">
                          	{!! Former::text('email','Email:')->class('form-control')->placeholder('Email...') !!}
                        </div>
                      </div><!-- end .section row section -->

                      <div class="section row">
                        <div class="col-md-6">
                          	{!! Former::text('username','Username:')->class('form-control')->placeholder('Username...') !!}
                        </div>
                        <div class="col-md-6">
                          	{!! Former::select('gender','Gender:')->class('form-control')->options(array('male' => 'Male','female' => 'Female'))->placeholder('Select Gender') !!}
                        </div>
                      </div><!-- end .section row section -->

                      <div class="section-divider mv40">
                        <span>Password</span>
                      </div>

						<div class="section row">
							<div class="col-md-6">
							  	{!! Former::password('password','Password:')->class('form-control') !!}
							</div>
							<div class="col-md-6">
							  	{!! Former::password('confirm_password','Confirm Password:')->class('form-control') !!}
							</div>
						</div><!-- end .section row section -->

						<div class="section-divider mt10 mb40">
							<span>Delivery Details</span>
						</div> <!-- .section-divider -->

						<div class="section row">
	                        <div class="col-md-6">
	                          	{!! Former::text('address')->class('form-control') !!}
	                        </div>
	                        <div class="col-md-6">
	                          {!! Former::text('city')->class('form-control') !!}
	                        </div>
	                        <div class="col-md-6">
	                          	{!! Former::text('town')->class('form-control') !!}
	                        </div>
	                        <div class="col-md-6">
	                          {!! Former::text('zip_code','Zip/Post Code')->class('form-control') !!}
	                        </div>
	                        <div class="col-md-6">
	                          {!! Former::select('country')->fromQuery( App\Country::all() ,'name','name' )->class('form-control') !!}
	                        </div>
	                    </div><!-- end .section row section -->

	                    <div class="section row">
	                    	<div class="col-md-12"><hr class="no-margin-top large-margin-bottom"></div>
		                    <div class="col-md-6">
	                          	{!! Former::select('status')->class('form-control')->options(array('1' => 'Active','2' => 'Inactive'))->placeholder('Select Status') !!}
	                        </div>
	                    </div>
                    </div> <!-- end .form-body section -->


                    <div class="panel-footer">
                      <button type="submit" class="button btn-system dark">Save Profile</button>
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
                      <i class="fa fa-pencil-square"></i>User Roles
                    </span>
                  </div>
                  <!-- end .form-header section -->

                    <div class="panel-body p25">
                      <div class="section-divider mt10 mb40">
                        <span>Set up your account</span>
                      </div>
                      <!-- .section-divider -->

                      <div class="row">
                        <div class="col-md-12">
                            {!! Form::label('role', 'Role', ['class' => 'col-md-2 control-label']) !!}
            						    <div class="col-sm-9">
              								@if(!isset($userRoles))
              									{!! Form::select('roles[]', App\Role::lists('name', 'id')->all(),null, ['class' => 'form-control ','multiple'=>'multiple','id'=>'roleSelect']) !!}
              								@else 
              									{!! Form::select('roles[]', App\Role::lists('name', 'id')->all(),$userRoles, ['class' => 'form-control','multiple'=>'multiple','id'=>'roleSelect']) !!}
              								@endif
            						    </div>
                        </div> <!-- end section -->
                      </div> <!-- end .section row section -->


                    </div>
                    <!-- end .form-body section -->
                    <div class="panel-footer">
                      <button type="submit" class="button btn-system dark">Save Roles</button>
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
