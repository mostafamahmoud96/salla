<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\Salla\Actions\CreateAction;
use App\Services\Salla\Actions\SyncAction;
use App\Services\Salla\Actions\UpdateAction;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public $product_types = [
        'product',
        'service',
        'group_products',
        'codes',
        'digital',
        'food',
        'donating'];

    public function index()
    {
        return view('products.list');
    }

    public function getProducts(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a class="btn btn-sm btn-primary" href="' . route('update-product', $row->id) . '">Edit</a>';

                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function pullProducts()
    {
        (new SyncAction())->execute();
    }

    public function createProduct(Request $request)
    {
        if ((new CreateAction())->execute($request)) {
            return redirect()->route('index');
        }
        return redirect()->back()->withInput();
    }

    public function create()
    {
        return view('products.create', ['types' => $this->product_types]);
    }

    public function editProduct(Product $product)
    {
        return view('products.edit', ['product' => $product, 'types' => $this->product_types]);
    }

    public function update(Request $request, Product $product)
    {
        if ((new UpdateAction())->execute($request, $product)) {
            return redirect()->route('index');
        }

    }

    public function pullButton()
    {
        if ((new SyncAction())->execute()) {
            return redirect()->back();
        }
    }
}
