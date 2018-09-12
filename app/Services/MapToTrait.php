<?php

namespace App\Services;

trait MapToTrait
{
    function mapTo($items, $mapTo)
    {
        $items = $items->map(function ($item) use ($mapTo) {
            $item[$mapTo] = $this->returnData->where(
                'name',
                'like',
                trim($item[$mapTo])
            )->first();
            return $item;
        });
        $this->returnData = $items;

        return $this;
    }

    public function get()
    {
        return $this->returnData;
    }
}
