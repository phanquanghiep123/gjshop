@extends(config('shop.shop_categories'))

@section('title')
    Products - Shop Categories
@endsection

@section('content')
<section>
    <div class="page-title-article">
        <h2 class="page-title no-margin-top"> PRODUCT CATEGORIES </h2>
    </div>
</section>

<div class="shop-page xlarge-margin-top">
    <div class="root-category">
        <div class="row">
            @foreach($categories as $cat)
                @foreach($cat->childs as $child)
                    <div class="col-sm-6 root-category-name">
                        <a href="{{route('shop.categories.showChildCategory',['slug'=>$child->slug])}}">
                            <img src="{{ asset($child->list_image) }}">
                        </a>
                        <div class="productCategoryTitle">
                            <a href="{{route('shop.categories.showChildCategory',['slug'=>$child->slug])}}">{{$child->name}}</a>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
@stop