<?php

namespace App\Dealcloser\Interfaces\Logic;

interface IProductCalculation
{
    public function revenue($price, $number);

    public function totalPurchase($purchase, $number);

    public function grossMargin($revenue, $totalPurchase);
}
