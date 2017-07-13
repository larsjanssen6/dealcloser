<?php

namespace App\Dealcloser\Traits;

trait Calculatable
{
    /**
     * Make gross margin attribute.
     *
     * @return mixed
     */
    public function getGrossMarginAttribute()
    {
        return $this->calculate()->grossMargin(
            $this->calculate()->revenue($this->price, $this->amount),
            $this->calculate()->totalPurchase($this->purchase, $this->amount)
        );
    }

    /**
     * Make total purchase attribute.
     *
     * @return mixed
     */
    public function getTotalPurchaseAttribute()
    {
        return $this->calculate()->totalPurchase($this->purchase, $this->amount);
    }

    /**
     * Make revenue attribute.
     *
     * @return mixed
     */
    public function getRevenueAttribute()
    {
        return $this->calculate()->revenue($this->price, $this->amount);
    }
}
