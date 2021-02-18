<?php

namespace App\Domains\Order\Actions;

use App\Domains\Order\Models\OrderModel;

class GetOrdersAction
{
    public function execute()
    {
        return OrderModel::with('items')->get();
    }
}
