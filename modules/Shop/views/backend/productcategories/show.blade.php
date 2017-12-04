@extends(config('shop.backend_layout'))

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Productcategory
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('gjadmin.shop.productcategories.edit', $productcategory->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('gjadmin.shop.productcategories.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $productcategory->id !!}</td>
            </tr>

			
            <tr>
                <td><b>Name</b></td>
                <td>{!! $productcategory->name !!}</td>
            </tr>			
            <tr>
                <td><b>Slug</b></td>
                <td>{!! $productcategory->slug !!}</td>
            </tr>			
            <tr>
                <td><b>Parent_id</b></td>
                <td>{!! $productcategory->parent_id !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $productcategory->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop