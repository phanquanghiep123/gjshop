@if (isset($model))
    {!! Former::open_vertical()->route('gjadmin.pages.update',$model->id)->method('PUT') !!}
    {!! Former::populate($model) !!}
@else
    {!! Former::open_vertical()->route('gjadmin.pages.store')->method('POST') !!}
@endif
    {!! Former::token() !!}

<div class="tab-block mb25">
  <ul class="nav nav-tabs tabs-border">
    <li class="active">
      <a href="#page" data-toggle="tab" aria-expanded="true"> <i class="fa fa-file-o"></i> Page Details</a>
    </li>

    @if(isset($model))
        <li class="dropdown">
          <a class="dropdown-toggle" href="#" role="menu" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog pl5"></i><i class="fa fa-caret-down pl5"></i>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="#tab8_4" tabindex="-1" data-toggle="tab">Delete {{$model->title}}</a>
            </li>
          </ul>
        </li>
    @endif
  </ul>
  <div class="tab-content">

    <div id="page" class="tab-pane active">
     <!-- ***********************  User Form *********************** -->

            <!-- Registration 2 -->
            <div class="col-md-8">
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="fa fa-file-o"></i> CMS Page Form
                    </span>
                  </div>
                  <!-- end .form-header section -->

                 
                    <div class="panel-body p25">
                      <div class="section-divider mt10 mb40">
                        <span>Page Information</span>
                      </div> <!-- .section-divider -->

                      <div class="section row">
                        <div class="col-md-6">
                            {!! Former::text('title')->class('form-control') !!}
                        </div>
                        <div class="col-md-6">
                          {!! Former::text('slug')->class('form-control') !!}
                        </div>
                        <div class="col-md-12">
                            {!! Former::text('meta_keywords','Meta Keywords:')->class('form-control') !!}
                        </div>
                        <div class="col-md-12">
                            {!! Former::textarea('meta_description','Meta Description:')->rows(3)->class('form-control') !!}
                        </div>
                      </div><!-- end .section row section -->

                      <div class="section row">
                        <div class="col-md-12">
                            {!! Former::textarea('content','Page Content:')->class('form-control summernote') !!}
                        </div>
                        <div class="col-md-12">
                            {!! Former::textarea('extra_info','Extra Info:')->class('form-control summernote') !!}
                        </div>
                      </div><!-- end .section row section -->
                    </div> <!-- end .form-body section -->


                    <div class="panel-footer">
                      <button type="submit" class="button btn-system dark">Save Page</button>
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
                      <i class="fa fa-cogs"></i> Settings
                    </span>
                  </div>
                  <!-- end .form-header section -->

                    <div class="panel-body p25">
                      <div class="section-divider mt10 mb40">
                        <span>Page Settings</span>
                      </div>
                      <!-- .section-divider -->

                      <div class="row">
                        <div class="col-md-12">
                            {!! Former::select('show_top_share_icons','Show Top Share Icons:')->class('form-control')->options(array('1' => 'Show','2' => 'Hide'))->placeholder('Select Status') !!}
                        </div> <!-- end section -->
                        <div class="col-md-12">
                            {!! Former::select('show_bottom_share_icons','Show Bottom Share Icons:')->class('form-control')->options(array('1' => 'Show','2' => 'Hide'))->placeholder('Select Status') !!}
                        </div> <!-- end section -->
                        <div class="col-md-12">
                            {!! Former::select('allow_comments','Allow Comments:')->class('form-control')->options(array('1' => 'Show','2' => 'Hide'))->placeholder('Select Status') !!}
                        </div> <!-- end section -->
                        <div class="col-md-12">
                            {!! Former::select('status','Status:')->class('form-control')->options(array('1' => 'Active','2' => 'Inactive'))->placeholder('Select Status') !!}
                        </div> <!-- end section -->
                      </div> <!-- end .section row section -->

                    </div>
                    <!-- end .form-body section -->
                    <div class="panel-footer">
                      <button type="submit" class="button btn-system dark">Save Settings</button>
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









