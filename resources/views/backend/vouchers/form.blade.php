<div class="tab-block mb25">
  <ul class="nav nav-tabs tabs-border">
    <li class="active">
      <a href="#user_details" data-toggle="tab" aria-expanded="true"> <i class="glyphicon glyphicon-user"></i> Voucher Details</a>
    </li>

    @if(isset($model))
        <li class="dropdown">
          <a class="dropdown-toggle" href="#" role="menu" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog pl5"></i><i class="fa fa-caret-down pl5"></i>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="#tab8_4" tabindex="-1" data-toggle="tab">Delete {{$model->code}}</a>
            </li>
          </ul>
        </li>
    @endif
  </ul>
  <div class="tab-content">

    <div id="user_details" class="tab-pane active">
    @if (isset($model))
        {!! Former::open_vertical()->route('gjadmin.vouchers.update',$model->id)->method('PUT') !!}
        {!! Former::populate($model) !!}
    @else
        {!! Former::open_vertical()->route('gjadmin.vouchers.store') !!}
        {!! Former::hidden('created_by',$loggedUser->id) !!}
    @endif
        {!! Former::token() !!}

            <!-- Registration 2 -->
            <div class="col-md-6">
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="glyphicon glyphicon-user"></i> Voucher Form
                    </span>
                  </div>
                  <!-- end .form-header section -->

                 
                    <div class="panel-body p25">
                      <div class="section-divider mt10 mb40">
                        <span>Voucher Details</span>
                      </div> <!-- .section-divider -->

                      <div class="section row">
                        <div class="col-md-12">
                            {!! Former::text('code','Code:')->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::select('discount_type','Discount Type:')->options(array('percent'=>'%','amount'=>'£'))->placeholder('Select Option')->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::text('discount_amount','Amount')->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::text('valid_from','Valid From:')->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::text('valid_until','Valid Until:')->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::select('multiple_use','Usage:')->options(array('2'=>'Single','1'=>'Multiple'))->placeholder('Select Option')->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::select('voucher_type','Voucher Type:')->options(array('1' => 'Discount','2' => 'Loyalty','3' => 'Commission'))->placeholder('Select Option')->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::select('assigned_to_user','Assigned To:')->fromQuery(App\User::all(),'full_name','id')->addOption('---- N/A ----','0')->placeholder('Select Option')->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::select('status','Status:')->class('form-control')->options(array('2' => 'Inactive','1' => 'Active')) !!}
                        </div>
                      </div><!-- end .section row section -->
                    </div> <!-- end .form-body section -->


                    <div class="panel-footer">
                      <button type="submit" class="button btn-system dark">Save Voucher</button>
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









