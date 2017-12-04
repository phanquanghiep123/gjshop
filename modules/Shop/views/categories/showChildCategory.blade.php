@extends(config('shop.layout_no_banner'))

@section('title') Products - {{$category->name}} @endsection
@section('meta_keywords') {{ $category->meta_keywords}} @stop
@section('meta_description') {{ $category->meta_description}} @stop

@section('content')

<div class="shop-page">
    <h2 class="page-title no-margin-top">{{$category->name}}</h2>
    @if($category->list_text)
	    <div class="inner-article-page">
	    	{!! $category->list_text !!}
	    </div>
    @endif
    <div class="category-products">
        <div class="row">
           @include('shop::_partials.list_products',['products'=>$products])
        </div>
    </div>

</div>
{!! $products->links() !!}

@stop
