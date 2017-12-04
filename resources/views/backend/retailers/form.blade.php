

<div class="tab-block mb25">
  <ul class="nav nav-tabs tabs-border">
    <li class="active">
      <a href="#retailer_details" data-toggle="tab" aria-expanded="true"> <i class="glyphicon glyphicon-user"></i> Retailer Details</a>
    </li>

    @if(isset($model))
        <li class="dropdown">
          <a class="dropdown-toggle" href="#" role="menu" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog pl5"></i><i class="fa fa-caret-down pl5"></i>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="#tab8_4" tabindex="-1" data-toggle="tab">Delete {{ $model->company}}</a>
            </li>
          </ul>
        </li>
    @endif
  </ul>

@if (isset($model))
    {!! Former::open_vertical()->route('gjadmin.retailers.update',$model->id)->method('PUT') !!}
    {!! Former::populate($model) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'gjadmin.retailers.store']) !!}
@endif
    {!! Former::token() !!}

  <div class="tab-content">

    <div id="retailer_details" class="tab-pane active">


        <div class="col-md-6">
          <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
            <div class="panel panel-dark heading-border">
                <div class="panel-heading">
                    <span class="panel-title">
                       Retailer Deatils
                    </span>
                </div>

                 
                <div class="panel-body p25">
                    <div class="section row">
                        <div class="col-md-6">
                            {!! Former::text('company','Company:')->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                          {!! Former::text('website','Website:')->class('form-control') !!}
                        </div>
                    </div><!-- end .section row section -->

                    <div class="section row">
                        <div class="col-md-6">
                            {!! Former::select('region','Region:')->options(array( 'europe'=>'Europe','middle_east'=>'Middle East','americas'=>'Americas','africa'=>'Africa','asia'=>'Asia','australia'=>'Australia', ))->placeholder('Select Region')->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::select('country','Country:')->fromQuery( \App\Country::all(),'name','name')->class('form-control') !!}
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
                      <button type="submit" class="button btn-system dark">Save Retailer</button>
                    </div>
                </div><!-- end .admin-form section -->

            </div><!-- end: .admin-form -->
        </div>

    


            <div class="col-md-6">
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                  <div class="panel-heading">
                    <span class="panel-title">
                       Contact Deatils
                    </span>
                  </div>
                  <!-- end .form-header section -->

                 
                    <div class="panel-body p25">
                        <div class="section row">
                            <div class="col-md-6">
                              {!! Former::text('contact_name','Name')->class('form-control') !!}
                            </div>
                            <div class="col-md-6">
                              {!! Former::text('position','Position')->class('form-control') !!}
                            </div>
                            <div class="col-md-6">
                                {!! Former::text('contact_number','Store Contact Number')->class('form-control') !!}
                            </div>
                            <div class="col-md-6">
                              {!! Former::text('contact_email','Email')->class('form-control') !!}
                            </div>
                            <div class="col-md-12">
                                {!! Former::textarea('head_office','Head Office Address')->rows(3)->class('form-control') !!}
                            </div>
                            <div class="col-md-12">
                                {!! Former::textarea('delivery_address','Delivery Address')->rows(3)->class('form-control') !!}
                            </div>
                        </div><!-- end .section row section -->
                    </div> <!-- end .form-body section -->
                  
                </div>
                <!-- end .admin-form section -->
              </div>
              <!-- end: .admin-form -->
             </div>

    </div>


  </div>
</div>
{!! Former::close() !!}







