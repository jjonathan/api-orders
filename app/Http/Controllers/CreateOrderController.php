<?php

namespace App\Http\Controllers;

use App\Domains\Order\Actions\SaveOrderAction;
use App\Domains\Order\DTO\CreateOrderRequestDTO;
use App\Http\Requests\CreateOrderRequest;

class CreateOrderController extends Controller
{
    public function __invoke(CreateOrderRequest $createOrderRequest)
    {
        return (new SaveOrderAction())->execute(CreateOrderRequestDTO::fromRequest($createOrderRequest));
    }
}
