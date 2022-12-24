<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

class SyncSalla
{
    public function syncProducts()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer WixnvB2ekMC5j8gDxOKx9wfE6288zstO6fpaBU9AS1Y.JP8rO9zGpajrI_VvLky_JfvDaL5KdOH784DF5V1zs00',
            'Content-Type' => 'application/json',
        ])->get('https://api.salla.dev/admin/v2/products');
    }
}
