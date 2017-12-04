<div class="tab-block mb25">
 
  <ul class="nav nav-tabs tabs-border">
    <li class="active">
      <a href="#retailer_details" data-toggle="tab" aria-expanded="true"> <i class="glyphicon glyphicon-user"></i> Product Category Details</a>
    </li>
    @if(isset($model))
      <li class="dropdown">
        <a class="dropdown-toggle" href="#" role="menu" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog pl5"></i><i class="fa fa-caret-down pl5"></i>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a href="#tab8_4" tabindex="-1" data-toggle="tab">Delete Category: {{ $model->name}}</a>
          </li>
        </ul>
      </li>
    @endif
  </ul>


@if (isset($model))
    {!! Former::open_vertical()->route('gjadmin.shop.productcategories.update',$model->id)->method('PUT') !!}
    {!! Former::populate($model) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'gjadmin.shop.productcategories.store']) !!}
@endif
    {!! Former::token() !!}

  <div class="tab-content">
    <div id="retailer_details" class="tab-pane active">

        <div class="col-md-6">
            <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
              <div class="panel panel-dark heading-border">
                  <div class="panel-heading">
                      <span class="panel-title">
                         Category Deatils
                      </span>
                  </div>
                  <div class="panel-body p25">
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
                            {!! Former::select('parent_id','Parent Category:')->fromQuery( \Modules\Shop\Models\ProductCategory::all(),'name','id')->addOption(array('No Parent Category'))->class('form-control') !!}
                        </div>
                        <div class="col-md-12">
                            {!! Former::textarea('list_text','Into Text:')->class('form-control summernote') !!}
                        </div>
                    </div><!-- end .section row section -->
                    <div class="section row">
                        <div class="col-md-12"><hr class="no-margin-top large-margin-bottom"></div>
                        <div class="col-md-6">
                            {!! Former::select('show_in_menu','Show in menu')->class('form-control')->options(array('1' => 'Visible','2' => 'Hidden'))->placeholder('Select Status') !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::select('status')->class('form-control')->options(array('1' => 'Active','2' => 'Inactive'))->placeholder('Select Status') !!}
                        </div>
                    </div>
                  </div> <!-- end .form-body section -->
                  <div class="panel-footer">
                    <button type="submit" class="button btn-system dark">Save Category</button>
                  </div>
              </div><!-- end .admin-form section -->
            </div><!-- end: .admin-form -->
        </div>

        <div class="col-md-6">
          <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
            <div class="panel panel-dark heading-border">
              <div class="panel-heading">
                <span class="panel-title">
                   Meta Deatils
                </span>
              </div>
              <div class="panel-body p25">
                  <div class="section row">
                      <div class="col-md-12">
                          {!! Former::text('meta_keywords','Keywords')->class('form-control') !!}
                      </div>
                      <div class="col-md-12">
                          {!! Former::textarea('meta_description','Description')->rows(5)->class('form-control') !!}
                      </div>
                  </div>
              </div> 
            </div>
          </div>
        </div>

    </div>
  </div>

</div>
{!! Former::close() !!}







