<?php

namespace App\Traits;
use Route;

trait LinkableTrait
{
    public function additionalLinks()
    {
        return [];
    }

    public function getLinksAttribute()
    {
        $self = str_plural(strtolower(str_replace("App\\", "", static::class))) ?? '';
        $links = [
            "self" => route("{$self}.show", $this),
            "url" => route("web.{$self}.show", $this),
        ];
        return array_merge($links, $this->additionalLinks());
    }
}
