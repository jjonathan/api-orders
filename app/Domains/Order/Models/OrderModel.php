<?php

namespace App\Domains\Order\Models;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    public $table = 'orders';

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(ItemModel::class, 'order_id', 'id');
    }
}
