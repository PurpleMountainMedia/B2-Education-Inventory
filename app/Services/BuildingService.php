<?php

namespace App\Services;

use App\Building;
use Auth;
use Illuminate\Support\Str;

class BuildingService
{
    public function buildingsFromNames($schoolId, array $buildingNames)
    {

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

        return $existingBuildings->merge($newBuildings);
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
