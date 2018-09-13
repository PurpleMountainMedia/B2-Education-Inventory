<?php

namespace App\Services;

use App\Make;
use Auth;
use Illuminate\Support\Str;

class MakeService
{
    use MapToTrait;

    protected $returnData;

    public function makesFromNames($schoolId, $items)
    {
        $makeNames = $items->pluck('make')->toArray();

        $newMakes = [];
        $existingMakes = Make::where(function ($query) use ($makeNames) {
            for ($i = 0; $i < count($makeNames); $i++) {
                $query->orwhere('name', 'like', '%' . $makeNames[$i] .'%');
            }
        })->get();

        if ($existingMakes->count() !== count($makeNames)) {
            $existingMakeNames = $existingMakes->pluck('name')->map(function ($make) {
                return strtolower($make);
            })->toArray();

            $makesToCreate = [];
            foreach ($makeNames as $key => $makeName) {
                if (!in_array(trim(strtolower($makeName)), $existingMakeNames) && !empty($makeName)) {
                    $make = $this->newMakeFromName($schoolId, $makeName);
                    $newMakes[] = $make;
                    $makesToCreate[] = $make->toArray();
                }
            }
            Make::insert($makesToCreate);
        }

        $this->returnData = $existingMakes->merge($newMakes);

        return $this;
    }

    public function newMakeFromName($schoolId, $name)
    {
        return new Make([
            'id' => (string) Str::uuid(),
            'school_id' => $schoolId,
            'created_by' => Auth::user()->id,
            'name' => trim($name),
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ]);
    }
}
