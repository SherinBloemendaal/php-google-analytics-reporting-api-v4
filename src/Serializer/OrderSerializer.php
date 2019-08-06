<?php


namespace sherin\google\analytics\Serializer;

use Google_Service_AnalyticsReporting_OrderBy;
use sherin\google\analytics\Order\OrderCollection;

class OrderSerializer
{
    /**
     * @param OrderCollection $orderCollection
     * @return array
     */
    public static function serialize(OrderCollection $orderCollection): array
    {
        $orders = $orderCollection->getOrders()->toArray();
        $googleOrders = [];
        foreach ($orders as $order) {
            $googleOrder = new Google_Service_AnalyticsReporting_OrderBy();
            $googleOrder->setFieldName($order->getName());
            $googleOrder->setOrderType($order->getOrderBy());
            $googleOrder->setSortOrder($order->getDirection());
            $googleOrders[] = $googleOrder;
        }

        return $googleOrders;

//        return $orderCollection->getOrders()->forAll(function ($key, Order $order) {
//            $orderBy = new \Google_Service_AnalyticsReporting_OrderBy();
//            $orderBy->setFieldName($order->getName());
//            $orderBy->setOrderType($order->getOrderBy());
//            $orderBy->setSortOrder($order->getDirection());
//            return $orderBy;
//        });
    }
}
