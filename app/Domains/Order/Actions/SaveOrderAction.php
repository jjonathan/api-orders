<?php

namespace App\Domains\Order\Actions;

use App\Domains\Order\DTO\CreateOrderRequestDTO;
use App\Domains\Order\DTO\ItemsOrderDTO;
use App\Domains\Order\Models\ItemModel;
use App\Domains\Order\Models\OrderModel;
use Illuminate\Support\Facades\DB;

class SaveOrderAction
{
    public function execute(CreateOrderRequestDTO $createOrderRequestDTO)
    {
        DB::beginTransaction();
        try {
            $order = $this->saveOrder($createOrderRequestDTO);
            $items = $this->saveItems($createOrderRequestDTO->items, $order);
            DB::commit();
            return [
                'status' => 'ok',
                'msg' => 'Ordem criada com sucesso',
                'data' => [
                    'order' => $order,
                    'items' => $items
                ]
            ];
        } catch (\Exception $e) {
            DB::rollback();
            return [
                'status' => 'error',
                'msg' => 'Houve um erro ao executar sua solicitação: ' . $e->getMessage()
            ];
        }
    }

    private function saveOrder(CreateOrderRequestDTO $createOrderRequestDTO): OrderModel
    {
        return OrderModel::create([
            'name' => $createOrderRequestDTO->name,
            'email' => $createOrderRequestDTO->email,
            'cpf' => $createOrderRequestDTO->cpf,
            'cep' => $createOrderRequestDTO->cep,
            'shipping' => $createOrderRequestDTO->shipping,
            'value' => $createOrderRequestDTO->value
        ]);
    }

    private function saveItems(array $items, OrderModel $orderModel): array
    {
        return collect($items)->map(function (ItemsOrderDTO $item) use ($orderModel) {
            return ItemModel::create([
                'order_id' => $orderModel->id,
                'sku' => $item->sku,
                'desc' => $item->desc,
                'value' => $item->value,
                'qtd' => $item->qtd
            ]);
        })->toArray();
    }
}
