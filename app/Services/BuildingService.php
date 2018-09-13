<?php

namespace App\Services;

use App\Building;
use Auth;
use Illuminate\Support\Str;

class BuildingService
{
    use MapToTrait;

    protected $returnData;

    public function buildingsFromNames($schoolId, $items)
    {
        $buildingNames = $items->pluck('building')->toArray();

        $newBuildings = [];
        $existingBuildings = Building::where('school_id', $schoolId)
                             ->where(function ($query) use ($buildingNames) {
                                for ($i = 0; $i < count($buildingNames); $i++) {
                                     $query->orwhere('name', 'like', '%' . $buildingNames[$i] .'%');
                                }
                             })->get();


        if ($existingBuildings->count() !== count($buildingNames)) {
            $existingBuildingNames = $existingBuildings->pluck('name')->map(function ($item) {
                return strtolower($item);
            })->toArray();

            $buildingsToCreate = [];
            foreach ($buildingNames as $key => $buildingName) {
                if (!in_array(trim(strtolower($buildingName)), $existingBuildingNames)) {
                    $building = $this->newBuildingFromName($schoolId, $buildingName);
                    $newBuildings[] = $building;
                    $buildingsToCreate[] = $building->toArray();
                }
            }
            Building::insert($buildingsToCreate);
        }

        $this->returnData = $existingBuildings->merge($newBuildings);

        return $this;
    }

    public function newBuildingFromName($schoolId, $name)
    {
        return new Building([
            'id' => (string) Str::uuid(),
            'school_id' => $schoolId,
            'type' => 'Building',
            'created_by' => Auth::user()->id,
            'name' => trim($name),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ]);
    }
}
