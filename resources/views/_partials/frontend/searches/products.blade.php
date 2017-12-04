@if(count($products))
<div class="col-sm-6 col-md-6 col-xs-12 search-section articles">
    <h3><i class="icon-bag"></i> Products ({{count($products)}})</h3>
    <ul>
        @foreach($products as $product)
        <li>• <a href="{{route('shop.products.show',['slug'=>$product->slug])}}">{{$product->name}}</a></li>
        @endforeach
    </ul>
    
    {!! $products->appends(['search_in'=>'products','search'=>$search])->links() !!}
</div>
@endif


