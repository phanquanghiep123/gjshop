var Shop = Shop ||  {};

Shop.updateQuantity = function(dom){
    var quantity = $(dom).val();
    if(quantity >= 0){
        $(dom).val(1);
    }else{
        $.put(baseUrl + '/shop/cart/update',[],function(){
            
        });
    }
};