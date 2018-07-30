<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated into dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'missing_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'room_id', 'make_id', 'item_type_id', 'name', 'description', 'serial_number', 'purchase_price',
      'purchase_date', 'meta', 'created_by', 'write_off', 'missing_at', 'bardcode'
    ];

    /**
      * The attributes that should be cast to native types.
      *
      * @var array
      */
    protected $casts = [
         'meta' => 'array',
    ];

    /**
     * The building that the item belongs to.
     *
     * @return collection
     */
    public function room()
    {
         return $this->belongsTo('App\Room');
    }

    /**
    * The make of the item.
    *
    * @return collection
    */
    public function make()
    {
        return $this->belongsTo('App\Make');
    }

    /**
    * The Item Type that the item belongs to.
    *
    * @return collection
    */
    public function itemType()
    {
        return $this->belongsTo('App\ItemType');
    }
}
