<?php

namespace App\Traits;
use Route;

trait LinkableTrait
{
    public function getLinksAttribute()
    {
        $self = str_plural(strtolower(str_replace("App\\", "", static::class))) ?? '';
        return [
            "self" => route("{$self}.show", $this),
            "url" => route("web.{$self}.show", $this),
        ];
    }
}
