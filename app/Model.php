<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;
use App\Traits\HasUUID;
use App\Traits\RelatableTrait;

class Model extends BaseModel {

    use HasUUID;

    public $incrementing = false;
}
