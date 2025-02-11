<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use App\Models\DistributorProduct;

use function Laravel\Prompts\alert;

class DistributorProductObserver
{
    /**
     * Handle the DistributorProduct "created" event.
     */
    // public function created(DistributorProduct $distributorProduct): void
    // {
    //     $product = $distributorProduct->manifactureProduct->product;
    //     $product->stock -= $distributorProduct->manifactureproduct->qty;
    //     if ($distributorProduct->qty > $product->stock) {
    //         alert('Not available in stock');
    //     }
    //     $product->update();
    //     $distributor = $distributorProduct->distributor;

    // }


    /**
     * Handle the DistributorProduct "updated" event.
     */
    public function updated(DistributorProduct $distributorProduct): void
    {
        //
    }

    /**
     * Handle the DistributorProduct "deleted" event.
     */
    public function deleted(DistributorProduct $distributorProduct): void
    {
        $product = $distributorProduct->product;
        $product->stock += $distributorProduct->qty;
        $product->update();
    }

    /**
     * Handle the DistributorProduct "restored" event.
     */
    public function restored(DistributorProduct $distributorProduct): void
    {
        //
    }

    /**
     * Handle the DistributorProduct "force deleted" event.
     */
    public function forceDeleted(DistributorProduct $distributorProduct): void
    {
        //
    }
}
