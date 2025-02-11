<?php

namespace App\Observers;

use App\Models\ManifactureProduct;
use Illuminate\Console\View\Components\Warn;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;
use function Laravel\Prompts\warning;

class ManifactureProductObserver
{
    /**
     * Handle the ManifactureProduct "created" event.
     */
    public function created(ManifactureProduct $manifactureProduct): void
    {
        $product = $manifactureProduct->product;
        $product->stock -= $manifactureProduct->qty;
        if ($manifactureProduct->qty > $product->stock) {
            alert('Stock is less than 0');
        }
        $product->update();
        $distributor = $manifactureProduct->distributor;

    }

    /**
     * Handle the ManifactureProduct "updated" event.
     */
    public function updated(ManifactureProduct $manifactureProduct): void
    {
        // if ($manifactureProduct->isDirty('qty')) {
        //     $product = $manifactureProduct->product;
        //     $product->stock -= $manifactureProduct->qty;
        //     $product->update();
        // }
    }

    /**
     * Handle the ManifactureProduct "deleted" event.
     */
    public function deleted(ManifactureProduct $manifactureProduct): void
    {
        $product = $manifactureProduct->product;
        $product->stock += $manifactureProduct->qty;
        $product->update();
    }

    /**
     * Handle the ManifactureProduct "restored" event.
     */
    public function restored(ManifactureProduct $manifactureProduct): void
    {
        //
    }

    /**
     * Handle the ManifactureProduct "force deleted" event.
     */
    public function forceDeleted(ManifactureProduct $manifactureProduct): void
    {
        //
    }
}
