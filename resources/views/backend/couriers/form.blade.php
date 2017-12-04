<div class="tab-block mb25">
  <ul class="nav nav-tabs tabs-border">
    <li class="active">
      <a href="#user_details" data-toggle="tab" aria-expanded="true"> <i class="glyphicon glyphicon-user"></i> Courier Details</a>
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
        {!! Former::open_vertical()->route('gjadmin.couriers.update',$model->id)->method('PUT') !!}
        {!! Former::populate($model) !!}
    @else
        {!! Former::open_vertical()->route('gjadmin.couriers.store')->method('POST') !!}
    @endif
        {!! Former::token() !!}

        
            <div class="col-md-6">
              <!-- Registration 2 -->
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="fa fa-pencil-square"></i>Courier Setttings
                    </span>
                  </div>
                  <!-- end .form-header section -->

                    <div class="panel-body p25">

                      <div class="row">
                        <div class="col-md-12">
                            {!! Former::text('name','Name:')->class('form-control') !!}
                        </div>
    
                        <div class="col-md-6">
                            {!! Former::select('status')->class('form-control')->options(array('1' => 'Active','0' => 'Inactive'))->placeholder('Select Status') !!}
                        </div>
                      </div> <!-- end .section row section -->


                    </div>
                    <!-- end .form-body section -->
                    <div class="panel-footer">
                      <button type="submit" class="button btn-system dark">Save Courier</button>
                    </div>
                    <!-- end .form-footer section -->
                </div>
                <!-- end .admin-form section -->
              </div>
              <!-- end: .admin-form -->
            </div>



            <div class="col-md-6">
              <ul>
                @foreach( App\Courier::all() as $courier )
                  <li> {{ $courier->name }}</li>
                @endforeach
              </ul>
            </div>

        <!-- ***********************  User Form *********************** -->
    </div>


  </div>
</div>
{!! Former::close() !!}






