<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;
use App\Traits\HasUUID;
use App\Traits\RelatableTrait;
use App\Traits\ResponsableTrait;

class Model extends BaseModel {

    use HasUUID, ResponsableTrait;

    public $incrementing = false;
}
