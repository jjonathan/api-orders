<?php

namespace App\Domains\Order\DTO;

use App\Http\Requests\CreateOrderRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CreateOrderRequestDTO extends DataTransferObject
{
    /**
     * Nome do cliente
     *
     * @var string
     */
    public $name;

    /**
     * Email do cliente
     *
     * @var string
     */
    public $email;

    /**
     * CPF do cliente
     *
     * @var string
     */
    public $cpf;

    /**
     * CEP
     *
     * @var string
     */
    public $cep;

    /**
     * Valor do frete do pedido
     *
     * @var integer|float
     */
    public $shipping;

    /**
     * Valor total do pedido
     *
     * @var integer|float
     */
    public $value;

    /**
     * Items do pedido
     *
     * @var array
     */
    public $items;

    public static function fromRequest(CreateOrderRequest $createOrderRequest): self
    {
        return new self([
            'name' => $createOrderRequest->name,
            'email' => $createOrderRequest->email,
            'cpf' => $createOrderRequest->cpf,
            'cep' => $createOrderRequest->cep,
            'shipping' => $createOrderRequest->shipping,
            'value' => $createOrderRequest->value,
            'items' => collect($createOrderRequest->items)->map(function($itemArr) {
                return ItemsOrderDTO::fromArray($itemArr);
            })->toArray()
        ]);
    }
}
