<?php

namespace App\Services\Salla\Actions;

use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Http;

class SyncAction
{
    public function execute()
    {
        try {
            $products = [];
            $page = 1;

            do {
                $rows = $this->getProducts($page);

                foreach ($rows['data'] as $row) {
                    $products[] = [
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'sku' => $row['sku'],
                        'description' => $row['description'],
                        'price' => $row['price']['amount'],
                        'main_image' => $row['url'],
                    ];
                }

                $page++;
            } while ($page <= $rows['pagination']['totalPages']);

            Product::upsert(
                $products, ['id', 'sku'], ['name', 'description', 'price', 'main_image']
            );

            return true;
        } catch (\Throwable$th) {
            return $th;
        }
    }

    private function getProducts($page = 1): object
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer WixnvB2ekMC5j8gDxOKx9wfE6288zstO6fpaBU9AS1Y.JP8rO9zGpajrI_VvLky_JfvDaL5KdOH784DF5V1zs00',
            'Content-Type' => 'application/json',
        ])->get('https://api.salla.dev/admin/v2/products?page='.$page);

        if ($response['status'] !== 200) {
            throw new Exception();
        }

        if (count($response['data']) == 0) {
            return [];
        }

        return $response;
    }
}
