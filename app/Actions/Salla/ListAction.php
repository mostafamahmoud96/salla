<?php

namespace App\Actions\Salla;

use App\Models\Product;
use Yajra\DataTables\DataTables;

class ListAction
{
    public function execute()
    {

        $data = Product::latest()->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a href="javascript:void(0)"data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>
                <a href="javascript:void(0)"data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>
                ';

                return $actionBtn;
            })

            ->rawColumns(['action'])
            ->make(true);

    }

}
