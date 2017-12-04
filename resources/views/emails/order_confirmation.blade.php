<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nurtured For Living | Order Invoice</title>
    
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 5px rgba(0, 0, 0, .15);
        font-size:14px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
        background-color: #fff; 
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }

    .label {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
        background-color: #8BA73A;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body bgcolor="#ddd">
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            
                            
                            <td>
                                
                            </td>
                            <td class="title">
                                <a href="http://www.nurturedforliving.com">
                                    <img src="{{ asset('/assets/frontend/images/emaillogo.jpg')}}">
                                </a>
                            </td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="left" valign="top">
                            {!! $data['message'] !!}
                            
                            <b>Nurtured For Living</b> <br/>
                            info@nurturedforliving.com<br/>
                            www.nurturedforliving.com
                        </td>
                      </tr>
                    </table>
                </td>
            </tr> 
            <tr>
              <td>
                <p style="text-align:center;">
                    <small>Nurtured For Living Ltd | PO box 69041, London, SW17 1FU | Tel: +44(0)207 993 6881</small>
                </p>
              </td>   
            </tr>           
        </table>
    </div>
    <br/>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td></td>
                            <td class="title">
                                <a href="http://nurturedforliving.com">
                                    <img src="{{ asset('/assets/frontend/images/emaillogo.jpg')}}">
                                </a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td style="text-align:left;">
                               <b>Delivery Address:</b><br/>
                                {!! $order->customer_name !!} <br>
                                {!! $order->customer_address !!} <br>
                                {!! $order->customer_city !!} , {!! strtoupper( $order->zip_code ) !!}  <br>
                                {!! $order->customer_country !!}  <br>
                            </td>
                            <td style="text-align:left;">
                                <b>Invoice Details:</b><br/>
                                <b>Order Number:</b> {!! $order->order_number !!}<br>
                                <b>Created:</b> {!! date('D, d M Y - H:i:s',strtotime( $order->created_at )) !!}<br>
                                <b>Points Earned:</b> {!! $order->points_earned !!}<br/>
                                <b>Status:</b> <label class="label label-success">PAID</label><br/>
                            </td>
                            @if($order->customer_note)
                            <td style="text-align:left;">
                                <b>Customer Note:</b><br/> {!! $order->customer_note !!}<br>
                            </td>
                            @endif
                        </tr>
                    </table>
                </td>
            </tr>
                           
            <tr>
                <td colspan="2">
                   <table>
                      <thead>
                        <tr class="heading">
                          <th>#</th>
                          <th>Item</th>
                          <th style="width: 135px;">QTY</th>
                          <th>Unit Price</th>
                          <th class="text-right pr10">Sub Total</th>
                        </tr>
                      </thead>
                      <tbody>
                    
                          @foreach($order->items as $item)
                          <?php $count = 1 ?>
                          <tr class="item">
                            <td> <b>{{$count++}}</b> </td>
                            <td style="text-align:left;"> <a href="{{route('shop.products.show',['slug'=> @$item['slug']] ) }}" target="_blank">{{@$item['name']}} </a></td>
                            <td> {{@$item['quantity']}}</td>
                            <td> {{Modules\Shop\Helper::formatPriceWithCurrency( @$item['price'] ,$order->currency)}} </td>
                            <td class="text-right pr10"> {{Modules\Shop\Helper::formatPriceWithCurrency(  @$item['price'] * @$item['quantity'], $order->currency)}}</td>
                          </tr>
                          @endforeach
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">
                                <table>
                                    <tbody>
                                      
                                      @if($order->discount != '0')
                                      <tr>
                                        <td>
                                          <b>Discount</b>
                                        </td>
                                        <td style="text-align:left;">-{{ Modules\Shop\Helper::formatPriceWithCurrency( $order->discount ,$order->currency)  }} </td>
                                      </tr>
                                      @endif
                                      @if($order->redeem_price != '0')
                                      <tr>
                                        <td>
                                          <b>Redeem</b>
                                        </td>
                                        <td style="text-align:left;">-{{ Modules\Shop\Helper::formatPriceWithCurrency( $order->redeem_price ,$order->currency)  }} </td>
                                      </tr>
                                      @endif
                                      <tr>
                                        <td> <b>Subtotal:</b> </td>
                                        <td style="text-align:left;">{{Modules\Shop\Helper::formatPriceWithCurrency( $order->discount + $order->price + $order->redeem_price, $order->currency)}}</td>
                                      </tr>
                                      <tr>
                                        <td> <b>Shipping:</b> </td>
                                        <td style="text-align:left;">{{ Modules\Shop\Helper::formatPriceWithCurrency( $order->ship_fee ,$order->currency) }}</td>
                                      </tr>
                                      <tr>
                                        <td> <b>Total:</b> </td>
                                        <td style="text-align:left;">{{Modules\Shop\Helper::formatPriceWithCurrency( $order->price + $order->ship_fee ,$order->currency)}}</td>
                                      </tr>
                                    </tbody>
                                </table>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2"><em>Your loyalty points balance is: {!! $customer->points !!}</em></td>
                          </tr>
                      </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>