<?php

namespace App\Http\Controllers;

use App\Domains\Order\Actions\GetOrdersAction;

class GetOrdersController extends Controller
{
    public function __invoke()
    {
        return (new GetOrdersAction())->execute();
    }
}
