<?php

namespace App\Services\Salla\Actions;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class UpdateAction
{
    public function execute($data, $product)
    {
        try {
            $output = Http::withHeaders([
                'Authorization' => 'Bearer WixnvB2ekMC5j8gDxOKx9wfE6288zstO6fpaBU9AS1Y.JP8rO9zGpajrI_VvLky_JfvDaL5KdOH784DF5V1zs00',
                'Content-Type' => 'application/json',
            ])->put('https://api.salla.dev/admin/v2/products/'.$product->id, [
                'name' => $data['name'],
                'product_type' => $data['product_type'],
                'sku' => $data['sku'],
                'description' => $data['description'],
                'price' => $data['price'],
                'main_image' => $data['main_image'],
            ]);

            if ($output['status'] == 422) {
                throw ValidationException::withMessages($output['error']['fields']);
            }
            if ($output['status'] == 404) {
                throw new Exception();
            }

            if ($output['status'] == 201) {
                if ($data['main_image']) {
                    if ($data['main_image']) {
                        $imageName = time().'.'.$data['main_image']->getClientOriginalName();

                        Storage::disk('local')->put('images/'.$imageName, 'public');
                    }

                    $data['main_image'] = $imageName ?? null;
                }
                $product->update($data->all());

                return true;
            }
        } catch (\Throwable$th) {
            throw $th;
        }
    }
}
