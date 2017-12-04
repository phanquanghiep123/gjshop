@extends('layouts.no_banner')

@section('title') Favorites @stop


@section('breadcrumb')

<ul class="breadcrumb">
    <li><a href="{!! url('/') !!}"><img src="{{asset('assets/frontend/images/home_icon.png') }}" alt="back home" /></a></li>
    <li><a href="{{ route('my_account')}}">Account</a></li>
    <li><a href="#">Favorites</a></li>
</ul>
@stop

@section('content')


<div class="row large-margin-top">
    <div class="col-md-3">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-dark bold uppercase">Welcome {!! $loggedUser->username ? $loggedUser->username : $loggedUser->f_name !!} </span>
                </div>
            </div>
            <div class="portlet-body">
                @include('_partials.frontend.side_quick_links')
            </div>
        </div> 
    </div>
    <div class="col-md-9">
        @include('_partials.backend.notifications')
        <div>
            <h4 class="account-page-title no-margin-top large-margin-bottom"> <i class="fa fa-heart text-danger"></i> My Favorites</h4>
        </div>
        <div class="portlet-body user-info">
            <div class="tab-pane fade active in" id="favorites">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-files-o"></i> Articles ({{ count($loggedUser->favoriteArticles()->get()) }})</span>
                                </div>
                            </div>
                            <div class="portlet-body" id="my-favorite-articles">
                                @include('_partials.frontend.favoriteArticles')   
                            </div>
                        </div> 
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-dark bold uppercase"><i class="fa fa-gift"></i> Products ({{ count($loggedUser->favoriteProducts()->get()) }})</span>
                                </div>
                            </div>
                            <div class="portlet-body" id="user-favorite-products">
                                @include('shop::_partials.myAccountFavoriteProducts')        
                            </div>
                        </div> 
                    </div>    
                </div>
            </div>
        </div>
       
    </div>

</div>
@endsection

@section('scripts')


@endsection