@extends('layouts.backend')

@section('breadcrumb')
<ul class="page-breadcrumb">
    <li>
        <a href="index.html">Dashboard</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{!! route('gjadmin.users.index') !!}">Users</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>{!! $user->f_name !!}</li>
</ul>
@stop


@section('content')




<!-- BEGIN PAGE TITLE-->
<h3 class="page-title"> {!! $user->fullname() !!}</h3>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="profile">
    <div class="tabbable-line tabbable-full-width">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#overview" data-toggle="tab"> Overview </a>
            </li>
            <li>
                <a href="#bio" data-toggle="tab"> Bio's </a>
            </li>
            <li>
                <a href="#account" data-toggle="tab"> Account </a>
            </li>
            
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="overview">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-unstyled profile-nav">
                            <li>
                                <img src="{!! asset('/assets/backend/pages/media/profile/people19.png') !!}" class="img-responsive pic-bordered" alt="" />
                                <a href="javascript:;" class="profile-edit"> edit </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                     <i class="fa fa-user"></i> Name:  {!! $user->fullname() !!}
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-envelope"></i> Email: {!! $user->email !!}
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-mobile"></i> Mobile: {!! $user->mobile !!}
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <ul class="list-inline">
                                        <li><i class="fa fa-lock"></i> Role:</li>
                                        @foreach( $user->roles as $role )
                                        <li>• {!! $role->name !!} </li>
                                        @endforeach
                                    </ul>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-7 profile-info">
                                <h1 class="font-green sbold uppercase">{!! $user->fullname() !!} ({!! $user->status == 1 ? 'Active' : 'Inactive' !!})</h1>
                                <p> {!! $user->mini_bio_approved !!}</p>
                                <p> <a href="{!! $user->website !!}" targe="_blank"> {!! $user->website !!} </a> </p>
                            </div>
                            <!--end col-md-8-->
                            <div class="col-md-5">
                                <div class="portlet sale-summary">
                                    <ul class="list">
                                    <li>
                                        <a href="#" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-blue bg-hover-grey-salsa font-white bg-hover-white socicon-facebook tooltips" data-original-title="Facebook"></a>
                                        <a href="https://facebook.com/{!! $user->facebook !!}">
                                            {!! $user->facebook !!}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-blue bg-hover-grey-salsa font-white bg-hover-white socicon-twitter tooltips" data-original-title="Twitter"></a>
                                        <a href="https://twitter.com/{!! $user->twitter !!}">
                                            {!! $user->twitter !!}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-green bg-hover-grey-salsa font-white bg-hover-white socicon-linkedin tooltips" data-original-title="Linkedin"></a>
                                        <a href="https://linkedin.com/{!! $user->linkedin !!}">
                                            {!! $user->linkedin !!}
                                        </a>
                                    </li>
                                    <li>
                                        
                                        <a href="#" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white socicon-pinterest tooltips" data-original-title="Pinterest"></a>                                        <a href="http://facebook.com/{!! $user->pintrest !!}">
                                        <a href="https://pinterest.com/{!! $user->pintrest !!}"> 
                                            {!! $user->pintrest !!}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white socicon-youtube tooltips" data-original-title="Youtube"></a>
                                        <a href="https://youtube.com/{!! $user->youtube !!}">
                                            {!! $user->youtube !!}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="socicon-btn socicon-btn-circle socicon-sm socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white socicon-google tooltips" data-original-title="Google"></a>
                                        <a href="http://facebook.com/{!! $user->google !!}">
                                            {!! $user->google !!}
                                        </a>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            <!--end col-md-4-->
                        </div>
                        <!--end row-->
                        <div class="tabbable-line tabbable-custom-profile">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab_1_11" data-toggle="tab"> Latest Customers </a>
                                </li>
                                <li>
                                    <a href="#tab_1_22" data-toggle="tab"> Feeds </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1_11">
                                    <div class="portlet-body">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <i class="fa fa-briefcase"></i> Company </th>
                                                    <th class="hidden-xs">
                                                        <i class="fa fa-question"></i> Descrition </th>
                                                    <th>
                                                        <i class="fa fa-bookmark"></i> Amount </th>
                                                    <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:;"> Pixel Ltd </a>
                                                    </td>
                                                    <td class="hidden-xs"> Server hardware purchase </td>
                                                    <td> 52560.10$
                                                        <span class="label label-success label-sm"> Paid </span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:;"> Smart House </a>
                                                    </td>
                                                    <td class="hidden-xs"> Office furniture purchase </td>
                                                    <td> 5760.00$
                                                        <span class="label label-warning label-sm"> Pending </span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:;"> FoodMaster Ltd </a>
                                                    </td>
                                                    <td class="hidden-xs"> Company Anual Dinner Catering </td>
                                                    <td> 12400.00$
                                                        <span class="label label-success label-sm"> Paid </span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:;"> WaterPure Ltd </a>
                                                    </td>
                                                    <td class="hidden-xs"> Payment for Jan 2013 </td>
                                                    <td> 610.50$
                                                        <span class="label label-danger label-sm"> Overdue </span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:;"> Pixel Ltd </a>
                                                    </td>
                                                    <td class="hidden-xs"> Server hardware purchase </td>
                                                    <td> 52560.10$
                                                        <span class="label label-success label-sm"> Paid </span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:;"> Smart House </a>
                                                    </td>
                                                    <td class="hidden-xs"> Office furniture purchase </td>
                                                    <td> 5760.00$
                                                        <span class="label label-warning label-sm"> Pending </span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href="javascript:;"> FoodMaster Ltd </a>
                                                    </td>
                                                    <td class="hidden-xs"> Company Anual Dinner Catering </td>
                                                    <td> 12400.00$
                                                        <span class="label label-success label-sm"> Paid </span>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm grey-salsa btn-outline" href="javascript:;"> View </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--tab-pane-->
                                <div class="tab-pane" id="tab_1_22">
                                    <div class="tab-pane active" id="tab_1_1_1">
                                        <div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
                                            <ul class="feeds">
                                               
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-default">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New order received. Please take care of it. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 3 hours </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-warning">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New order received. Please take care of it. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 5 hours </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-info">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New order received. Please take care of it. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 18 hours </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-default">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New order received. Please take care of it. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 21 hours </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-info">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New order received. Please take care of it. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 22 hours </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-default">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New order received. Please take care of it. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 21 hours </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-info">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New order received. Please take care of it. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 22 hours </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-default">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New order received. Please take care of it. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 21 hours </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-info">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New order received. Please take care of it. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 22 hours </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-default">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New order received. Please take care of it. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 21 hours </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-info">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> New order received. Please take care of it. </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 22 hours </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!--tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--tab_1_2-->
            <div class="tab-pane" id="account">
                <div class="row profile-account">
                    <div class="col-md-3">
                        <ul class="ver-inline-menu tabbable margin-bottom-10">
                            <li class="active">
                                <a data-toggle="tab" href="#personal-info">
                                    <i class="fa fa-user"></i> Personal info </a>
                                <span class="after"> </span>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab_2-2">
                                    <i class="fa fa-picture-o"></i> Change Avatar </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab_3-3">
                                    <i class="fa fa-lock"></i> Change Password </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab_4-4">
                                    <i class="fa fa-eye"></i> Privacity Settings </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div id="personal-info" class="tab-pane active">
              
                                    {!! Form::model($user, ['files' => true, 'method' => 'PUT', 'route' => ['gjadmin.users.update', $user->id]]) !!}
                                    {!! Former::populate($user) !!}
                                
                                    <div classs="row">
                                        <div class="form-group col-sm-4">
                                            <label class="control-label">First Name</label>
                                            {!! Former::text('f_name','')->placeholder('First Name')->class('form-control') !!}
                                        </div>
                                        <div class="form-group  col-sm-4">
                                            <label class="control-label">Last Name</label>
                                           {!! Former::text('l_name','')->placeholder('First Name')->class('form-control') !!}
                                       </div>
                                       <div class="form-group col-sm-4">
                                            <label class="control-label">Username</label>
                                            {!! Former::text('username','')->placeholder('EG: AbuLayla')->class('form-control') !!}
                                        </div>

                                        <div class="form-group col-sm-12">
                                            {!! Former::label('role', 'Role', ['class' => 'col-md-12 control-label']) !!}
                                       
                                                @if(!isset($userRoles))
                                                    {!! Form::select('roles[]', App\Role::lists('name', 'id')->all(),null, ['class' => 'form-control','multiple'=>'multiple']) !!}
                                                @else 
                                                    {!! Form::select('roles[]', App\Role::lists('name', 'id')->all(),$userRoles, ['class' => 'form-control','multiple'=>'multiple']) !!}
                                                @endif
                                     
                                        </div>



                                        <div class="form-group col-sm-6">
                                            <label class="control-label">Email</label>
                                            {!! Former::text('email','')->placeholder('+1 646 580 DEMO (6284)')->class('form-control') !!}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">Mobile Number</label>
                                            {!! Former::text('mobile','')->placeholder('+1 646 580 DEMO (6284)')->class('form-control') !!}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">Gender</label>
                                           {!! Former::select('gender','')->options(array('male' => 'Male','female' => 'Female'))->class('form-control') !!}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">Country</label>
                                           {!! Former::select('country','')->fromQuery( App\Country::all(),'name','name')->class('form-control') !!}
                                        </div>


                                        <div class="form-group col-sm-6">
                                            <label class="control-label">Website</label>
                                            {!! Former::text('website','')->placeholder('www.nurturedforliving.com')->class('form-control') !!}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">Facebook</label>
                                            {!! Former::text('facebook','')->placeholder('username')->class('form-control') !!}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">Twitter</label>
                                            {!! Former::text('twitter','')->placeholder('username')->class('form-control') !!}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">LinkedIn</label>
                                            {!! Former::text('linkedin','')->placeholder('username')->class('form-control') !!}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">Pintrest</label>
                                            {!! Former::text('pintrest','')->placeholder('username')->class('form-control') !!}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">Youtube</label>
                                            {!! Former::text('youtube','')->placeholder('username')->class('form-control') !!}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">Instagram</label>
                                            {!! Former::text('instagram','')->placeholder('username')->class('form-control') !!}
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label class="control-label">Google</label>
                                            {!! Former::text('google','')->placeholder('username')->class('form-control') !!}
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label class="control-label">Status</label>
                                           {!! Former::select('status','')->options(array('1' => 'Active','2' => 'Inactive'))->class('form-control') !!}
                                        </div>
                                        <div class="col-sm-6">
                                            {!! Former::submit('Save','Update')->class('btn btn-primary') !!}
                                        </div>
                                    </div>
                                {!! Former::close() !!}
                            </div>
                            <div id="tab_2-2" class="tab-pane">
                                <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                    </p>
                                <form action="#" role="form">
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" name="..."> </span>
                                                <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                        <div class="clearfix margin-top-10">
                                            <span class="label label-danger"> NOTE! </span>
                                            <span> Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
                                        </div>
                                    </div>
                                    <div class="margin-top-10">
                                        <a href="javascript:;" class="btn green"> Submit </a>
                                        <a href="javascript:;" class="btn default"> Cancel </a>
                                    </div>
                                </form>
                            </div>
                            <div id="tab_3-3" class="tab-pane">
                                {!! Former::open(url('nfladmin/users/update-password'),'POST') !!}
                                {!! Former::token() !!}
                                {!! Former::hidden('id',$user->id)  !!}
                                    <div class="form-group">
                                        <label class="control-label">New Password</label>
                                        {!! Former::password('password','')->class('form-control') !!}
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Re-type New Password</label>
                                        {!! Former::password('confirm_password','')->class('form-control') !!}
                                    </div>
                                    <div class="margin-top-10">
                                        {!! Former::submit('Save','Change Password')->class('btn btn-primary') !!}
                                    </div>
                                {!! Former::close() !!}
                            </div>
                            <div id="tab_4-4" class="tab-pane">
                                <form action="#">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus.. </td>
                                            <td>
                                                <label class="uniform-inline">
                                                    <input type="radio" name="optionsRadios1" value="option1" /> Yes </label>
                                                <label class="uniform-inline">
                                                    <input type="radio" name="optionsRadios1" value="option2" checked/> No </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                            <td>
                                                <label class="uniform-inline">
                                                    <input type="checkbox" value="" /> Yes </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                            <td>
                                                <label class="uniform-inline">
                                                    <input type="checkbox" value="" /> Yes </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> Enim eiusmod high life accusamus terry richardson ad squid wolf moon </td>
                                            <td>
                                                <label class="uniform-inline">
                                                    <input type="checkbox" value="" /> Yes </label>
                                            </td>
                                        </tr>
                                    </table>
                                    <!--end profile-settings-->
                                    <div class="margin-top-10">
                                        <a href="javascript:;" class="btn green"> Save Changes </a>
                                        <a href="javascript:;" class="btn default"> Cancel </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end col-md-9-->
                </div>
            </div>
            <!--end tab-pane-->
            <div class="tab-pane" id="bio">
                <div class="row">
                    <div class="col-md-2">
                        <ul class="ver-inline-menu tabbable margin-bottom-10">
                            <li class="active">
                                <a data-toggle="tab" href="#tab_1">
                                    <i class="fa fa-briefcase"></i> Pending Mini Bio </a>
                                <span class="after"> </span>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab_2">
                                    <i class="fa fa-group"></i> Approved Full Bio </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab_3">
                                    <i class="fa fa-leaf"></i> Pending Full Bio</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <div class="tab-content">
                            <div id="tab_1" class="tab-pane active">
                                <div id="accordion1" class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1"> 1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion1_1" class="panel-collapse collapse in">
                                            <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes
                                                anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't
                                                heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_2"> 2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion1_2" class="panel-collapse collapse">
                                            <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                VHS. </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_3"> 3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion1_3" class="panel-collapse collapse">
                                            <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                VHS. </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-warning">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_4"> 4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion1_4" class="panel-collapse collapse">
                                            <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_5"> 5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion1_5" class="panel-collapse collapse">
                                            <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_6"> 6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion1_6" class="panel-collapse collapse">
                                            <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_7"> 7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion1_7" class="panel-collapse collapse">
                                            <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab_2" class="tab-pane">
                                <div id="accordion2" class="panel-group">
                                    <div class="panel panel-warning">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_1"> 1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion2_1" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                                    wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                                    haven't heard of them accusamus labore sustainable VHS. </p>
                                                <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                                    wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                                    haven't heard of them accusamus labore sustainable VHS. </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_2"> 2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion2_2" class="panel-collapse collapse">
                                            <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                VHS. </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_3"> 3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion2_3" class="panel-collapse collapse">
                                            <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                VHS. </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_4"> 4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion2_4" class="panel-collapse collapse">
                                            <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_5"> 5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion2_5" class="panel-collapse collapse">
                                            <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_6"> 6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion2_6" class="panel-collapse collapse">
                                            <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_7"> 7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion2_7" class="panel-collapse collapse">
                                            <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab_3" class="tab-pane">
                                <div id="accordion3" class="panel-group">
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_1"> 1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion3_1" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. </p>
                                                <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. </p>
                                                <p> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                                    craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt
                                                    you probably haven't heard of them accusamus labore sustainable VHS. </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-success">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_2"> 2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion3_2" class="panel-collapse collapse">
                                            <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                VHS. </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_3"> 3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion3_3" class="panel-collapse collapse">
                                            <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable
                                                VHS. </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_4"> 4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion3_4" class="panel-collapse collapse">
                                            <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_5"> 5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion3_5" class="panel-collapse collapse">
                                            <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_6"> 6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion3_6" class="panel-collapse collapse">
                                            <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_7"> 7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                                            </h4>
                                        </div>
                                        <div id="accordion3_7" class="panel-collapse collapse">
                                            <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee
                                                nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat
                                                craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod. Brunch 3
                                                wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end tab-pane-->
        </div>
    </div>
</div>
@stop




@section('styles')
<link href="{{asset('/assets/backend/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/assets/backend/pages/css/profile-2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/assets/backend/global/plugins/socicon/socicon.css')}}" rel="stylesheet" type="text/css">
@endsection



@section('plugins')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('/assets/backend/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
<script src="h t t p://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="{{asset('/assets/backend/global/plugins/gmaps/gmaps.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
@endsection



@section('scripts')

@endsection

