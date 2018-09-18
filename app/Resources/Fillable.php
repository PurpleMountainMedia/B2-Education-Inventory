<?php

namespace App\Resources;

trait Fillable
{
    private function fill(array $attributes)
    {
        foreach ($attributes as $key => $attribute) {
            $key = camel_case($key);
            $this->{$key} = $attribute;
        }
    }
}
