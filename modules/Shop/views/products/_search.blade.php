<form action="{{route('shop.products.search')}}" method="GET">
    <input style="padding: 10px;height: 40px;" class="form-control product-search" placeholder="Enter product name or barcode..." type="text" name="search" required="required" min="5">
    <button type="submit" class="sidebarSearch"><i class="fa fa-search"></i></button>
</form>