<?php

namespace App\Services;

use App\Item;
use Auth;
use Illuminate\Support\Str;

class ItemService
{
    use MapToTrait;

    protected $returnData;

    public function createItemsFromMultiple($items)
    {
        $itemsToCreate = [];
        $newItems = [];
        foreach ($items as $key => $item) {
            foreach (range(1, $item['qty'] ?? 1) as $key => $qty) {
                $newItem = $this->newItemFromArray($item, $key);
                $newItems[] = $newItem;
                $itemsToCreate[] = $newItem->toArray();
            }
        }
        Item::insert($itemsToCreate);

        $this->returnData = $newItems;

        return $this;
    }

    public function newItemFromArray($item, $index = 0)
    {
        return new Item([
          'id' => (string) Str::uuid(),
          'room_id' => optional($item['room'] ?? null)->id,
          'make_id' => optional($item['make'] ?? null)->id,
          'item_category_id' => optional($item['itemCategory'] ?? null)->id,
          'name' => $item['name'] ?? null,
          'description' => $item['description'] ?? null,
          'serial_number' => ($index === 0) ? ($item['serial'] ?? null) : null,
          'purchase_price' => $item['purchasePrice'] ?? null,
          'purchase_date' => dtFromInput($item['purchaseDate'] ?? null),
          'meta' => json_encode($item['meta'] ?? []),
          'write_off' => dtFromInput($item['writeOff'] ?? null),
          'missing_at' => dtFromInput($item['missingAt'] ?? null),
          'barcode' => $this->calculateBarcode($item, $index),
          'created_by' => Auth::user()->id,
          'created_at' => now()->toDateTimeString(),
          'updated_at' => now()->toDateTimeString(),
        ]);
    }

    public function calculateBarcode($item, $index)
    {
        if ((int) ($item['barcodeStart'] ?? 0) >= 1) {
            return (int) $item['barcodeStart'] + $index;
        }
        return null;
    }
}
