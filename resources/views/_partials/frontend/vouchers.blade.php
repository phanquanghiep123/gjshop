<?php 
$vouchers = \Modules\Shop\Models\DiscountCode::where('user_id', $loggedUser->id)->orWhere('assigned_to_user',$loggedUser->id)->get();
?>
<table class="table" id="vouchers-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Voucher Code</th>
            <th>Amount</th>
            <th>Type</th>
            <th>Expires</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @if(count($vouchers))
        <?php $count = 1 ?>
            @foreach( $vouchers as $voucher )
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $voucher->code }}</td>
                    <td>{{ $voucher->discount_type =='percent' ?  $voucher->discount_amount .'%' :  '£' . $voucher->discount_amount }}</td>
                    <td>{{ $voucher->voucher_type =='1' ?  'Discount' :  'Loyalty' }}</td>
                    <td>{{ $voucher->valid_until ? date("d M Y", strtotime($voucher->valid_until)) : 'N/A' }}</td>
                    <td>{{ $voucher->status =='1' ?  'Active' :  'Used' }}</td>
                </tr>
            @endforeach
        @else
            <tr><td colspan="6"><p><em>You do not have any vouchers</em></p></td></tr>
        @endif
    </tbody>
</table>  