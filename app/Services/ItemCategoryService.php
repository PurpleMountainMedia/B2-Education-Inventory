<?php

namespace App\Services;

use App\ItemCategory;

class ItemCategoryService
{
    use MapToTrait;

    protected $returnData;

    public function categoriesFromNames($items)
    {
        $categoryNames = $items->pluck('itemCategory')->toArray();

        $existingCategories = ItemCategory::where(function ($query) use ($categoryNames) {
            for ($i = 0; $i < count($categoryNames); $i++) {
                $query->orwhere('name', 'like', '%' . $categoryNames[$i] .'%');
            }
        })->get();

        $this->returnData = $existingCategories;

        return $this;
    }

    public function newCategoryFromName()
    {
        return new ItemCategory([

        ]);
    }
}
