<?php

namespace App\Traits;

use Uuid;

trait HasUUID
{
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return $this->getUUIDFieldName();
    }

    public static function bootHasUUID()
    {
        static::creating(function ($model) {
            $uuidFieldName = $model->getUUIDFieldName();
            if (empty($model->$uuidFieldName)) {
                $model->$uuidFieldName = static::generateUUID();
            }
        });
    }

    public function getUUIDFieldName()
    {
        if (!empty($this->uuidFieldName)) {
            return $this->uuidFieldName;
        }
        return 'id';
    }

    public static function generateUUID()
    {
        return (string) Uuid::generate(4);
    }
}
