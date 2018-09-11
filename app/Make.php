<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\ResponsableTrait;

class Make extends Model
{
    use SoftDeletes, ResponsableTrait;

    /**
     * The attributes that should be mutated into dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'organisation_id', 'description', 'owned_by', 'created_by'];

    /**
     * The Item Types that have this make.
     *
     * @return collection
     */
    public function itemCategories()
    {
        return $this->hasMany('App\ItemCategory');
    }
}
