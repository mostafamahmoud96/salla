@extends('layouts.app')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <form class="card" method="POST" action="{{ route('edit-product', $product->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h3 class="card-title"> Edit Product</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input class="form-control @error('name') is-invalid @enderror" type="text"
                                                placeholder="Name" name="name" value="{{ $product->name }}">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5">{{ $product->description }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sku</label>
                                <input type="text" class="form-control @error('sku') is-invalid @enderror"
                                    placeholder="SKU" name="sku" value="{{ $product->sku }}">
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror"
                                    name="price" placeholder="price" value="{{ $product->price }}">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label class="col-2 col-form-label required">Product Type</label>

                                <select class="form-select @error('product_type') is-invalid @enderror " name="product_type"
                                    value="{{ $product->product_type }}">
                                    <option value=>Select...</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                                @error('product_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label class="form-label">Main Image</label>
                                <input type="file" class="form-control  @error('main_image') is-invalid @enderror"
                                    name="main_image">
                                @error('main_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary ms-auto">Update </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
