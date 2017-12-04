@extends(config('shop.backend_layout'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Product
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('gjadmin.shop.products.edit', $product->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('gjadmin.shop.products.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $product->id !!}</td>
            </tr>

			
            <tr>
                <td><b>Name</b></td>
                <td>{!! $product->name !!}</td>
            </tr>			
            <tr>
                <td><b>Slug</b></td>
                <td>{!! $product->slug !!}</td>
            </tr>			
            <tr>
                <td><b>List_image</b></td>
                <td>{!! $product->list_image !!}</td>
            </tr>			
            <tr>
                <td><b>Description</b></td>
                <td>{!! $product->description !!}</td>
            </tr>			
            <tr>
                <td><b>Content</b></td>
                <td>{!! $product->content !!}</td>
            </tr>			
            <tr>
                <td><b>Is_featured</b></td>
                <td>{!! $product->is_featured !!}</td>
            </tr>			
            <tr>
                <td><b>Regular_price</b></td>
                <td>{!! $product->regular_price !!}</td>
            </tr>			
            <tr>
                <td><b>Sale_price</b></td>
                <td>{!! $product->sale_price !!}</td>
            </tr>			
            <tr>
                <td><b>Sale_expired_at</b></td>
                <td>{!! $product->sale_expired_at !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $product->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop