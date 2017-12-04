<?php
namespace Modules\Shop\Services;

use Modules\Shop\Models\Order;

/**
 * Description of CheckUserPurcharsedProductBefore
 *
 * @author dinhtrong
 */
class CheckUserPurcharsedProductBefore
{

    public function call($productId)
    {
        $user           = auth()->user();
        $acceptedStatus = [
            Order::PAYMENT_MADE_STATUS,
            Order::SHIPPING_STATUS,
            Order::COMPLETED_STATUS
        ];
        $orders         = $user->getOrdersQuery()->whereIn('status', $acceptedStatus)->get();
        foreach ($orders as $order) {
            $items = $order->items;
            if (!is_array($items)) {
                continue;
            }
            foreach ($items as $item) {
                if ($item['id'] == $productId) {
                    return true;
                }
            }
        }
        return false;
    }
}
