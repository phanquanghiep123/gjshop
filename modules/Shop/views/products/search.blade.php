@extends(config('shop.layout_no_banner'))

@section('title') Search results for {{$keyword }} @endsection

@section('content')
<?php $productCount = count($products);   ?>

<div class="shop-page">
    <h2 class="page-title no-margin-top">Search Result for "{{$keyword }}"</h2>
    <div class="category-products">
        <div class="row">
            @if($productCount)
                @include('shop::_partials.list_products',['products'=>$products])
            @else
                <h3 class="text-danger align-center"><em>Sorry, no products have been found. Please try again with different search criteria</em></h3>
            @endif
        </div>
    </div>

</div>
{!! $products->links() !!}

@stop