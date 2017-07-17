<?php

namespace App\Dealcloser\Logic;

use App\Dealcloser\Interfaces\Logic\IProductCalculation;

class ProductCalculation implements IProductCalculation
{
    /**
     * Calculate the revenue.
     *
     * @param $price
     * @param $number
     * @return mixed
     */
    public function revenue($price, $number)
    {
        return $price * $number;
    }

    /**
     * Calculate the total purchase.
     *
     * @param $purchase
     * @param $number
     * @return mixed
     */
    public function totalPurchase($purchase, $number)
    {
        return $purchase * $number;
    }

    /**
     * Calculate the gross margin.
     *
     * @param $revenue
     * @param $totalPurchase
     * @return mixed
     */
    public function grossMargin($revenue, $totalPurchase)
    {
        return $revenue - $totalPurchase;
    }
}
