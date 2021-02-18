<?php

namespace App\Domains\Order\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class ItemsOrderDTO extends DataTransferObject
{
    /**
     * SKU do item
     *
     * @var string
     */
    public $sku;

    /**
     * Descrição do item
     *
     * @var string
     */
    public $desc;

    /**
     * Valor do item
     *
     * @var float|integer
     */
    public $value;

    /**
     * Qntd dos itens
     *
     * @var integer
     */
    public $qtd;

    public static function fromArray(array $array): self
    {
        return new self([
            'sku' => $array['sku'],
            'desc' => $array['desc'],
            'value' => $array['value'],
            'qtd' => $array['qtd']
        ]);
    }
}
