<?php

namespace App\Observers;

use App\Item;
use App\Events\ItemUpdated;

class ItemObserver
{
    /**
     * Handle to the item "created" event.
     *
     * @param  \App\Item  $item
     * @return void
     */
    public function created(Item $item)
    {
        //
    }

    /**
     * Handle the item "updated" event.
     *
     * @param  \App\Item  $item
     * @return void
     */
    public function updated(Item $item)
    {
        event(new ItemUpdated($item));
    }

    /**
     * Handle the item "deleted" event.
     *
     * @param  \App\Item  $item
     * @return void
     */
    public function deleted(Item $item)
    {
        //
    }
}
