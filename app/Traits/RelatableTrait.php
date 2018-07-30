<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;
use Exception;

trait RelatableTrait
{

    /**
     * @param $relations
     * @return $this
     */
    public function load($relations)
    {
        $relations = $this->getValidRelations($relations);
        return parent::load($relations);
    }



    /**
     * @param $relations
     * @return mixed
     */
    public static function with($relations)
    {
        $relations = $this->getValidRelations($relations);
        return parent::with($relations);
    }


    /**
     * @param $relation
     * @return bool
     */
    public function isValidRelationship($relation)
    {
        $model = $this;
        $valid = true;
        $parts = explode('.', $relation);

        while ($part = array_shift($parts)) {
            if (method_exists($model, $part)) {
                try {
                    $rel = $model->$part();
                } catch (Exception $e) {
                    report($e);
                    $rel = null;
                }

                if ($rel instanceof Relation) {
                    $model = $rel->getRelated();
                } else {
                    $valid = false;
                }
            } else {
                $valid = false;
            }
            if (!$valid) {
                break;
            }
        }

        return $valid;
    }

    /**
     * @param $relations
     * @return array
     */
    public function getValidRelations($relations)
    {
        if (!is_array($relations)) {
            $relations = explode(',', preg_replace('/\s+/', '', $relations));
        }

        $valid = [];

        foreach ($relations as $relation) {
            if ((new static)->isValidRelationship($relation)) {
                $valid[] = $relation;
            }
        }

        return $valid;
    }
}
