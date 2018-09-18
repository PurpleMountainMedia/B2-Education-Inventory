<?php

namespace App\Services;

use App\Item;
use App\Resources\ReportQuery;

class ReportService
{
    public function getDataFromQuery($type, $query)
    {
        $query = new ReportQuery($query);

        switch ($type) {
            case 'items':
                return $this->getItems($query);
                break;

            case 'rooms':
                // code...
                break;

            case 'buildings':
                // code...
                break;
        }
    }

    public function getItems($query)
    {
        return Item::inSchool($query->schoolId)
                   ->inRoom($query->roomId)
                   ->withCount($query->withCount ?: [])
                   ->filterable($query->filters)
                   ->with($query->with ?: [])
                   ->basicResponse(null, false, $query->search)
                   ->get();
    }
}
