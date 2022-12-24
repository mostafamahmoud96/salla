<?php

namespace App\Services\Salla\Actions;

use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CreateAction
{
    public function execute($data)
    {
        try {
            $output = Http::withHeaders([
                'Authorization' => 'Bearer WixnvB2ekMC5j8gDxOKx9wfE6288zstO6fpaBU9AS1Y.JP8rO9zGpajrI_VvLky_JfvDaL5KdOH784DF5V1zs00',
                'Content-Type' => 'application/json',
            ])->post('https://api.salla.dev/admin/v2/products', [
                'id' => $data['id'],
                'name' => $data['name'],
                'product_type' => $data['product_type'],
                'sku' => $data['sku'],
                'description' => $data['description'],
                'price' => $data['price'],
                'url' => $data['main_image'],
            ]);

            if ($output['status'] == 422) {
                throw ValidationException::withMessages($output['error']['fields']);
            }
            if ($output['status'] == 201) {
                if ($data['main_image']) {
                    $imageName = time().'.'.$data['main_image']->getClientOriginalName();

                    Storage::disk('local')->put('images/'.$imageName, 'public');
                }

                Product::create([
                    'id' => $output['data']['id'],
                    'name' => $data['name'],
                    'product_type' => $data['product_type'],
                    'sku' => $data['sku'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'main_image' => $imageName ?? null,
                ]);
            }

            return true;
        } catch (\Throwable$th) {
            throw $th;
        }
    }
}
