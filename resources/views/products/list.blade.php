@extends('layouts.app')
@section('content')
    <div class="container-xl">
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary" href="{{ route('pull-data') }}">Pull</a>
                </div>
                <div class="card-body">
                    <table class="table  table-vcenter card-table table-striped yajra-datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Main image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="ajaxModel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modelHeading"></h4>
                            </div>
                            <div class="modal-body">
                                <form id="productForm" name="productForm" class="form-horizontal">
                                    <input type="hidden" name="product_id" id="product_id">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="name" name="name"
                                                placeholder="Enter Name" value="" maxlength="50" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-12">
                                            <textarea id="description" name="description" required="" placeholder="Enter descriptions" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save
                                            changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
                <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
                <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
                <script type="text/javascript">
                    $(function() {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        var table = $('.yajra-datatable').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: "{{ route('products.list') }}",
                            columns: [{
                                    data: 'id',
                                    name: 'id'
                                },
                                {
                                    data: 'name',
                                    name: 'name'
                                },
                                {
                                    data: 'sku',
                                    name: 'sku'
                                },
                                {
                                    data: 'description',
                                    name: 'description'
                                },
                                {
                                    data: 'price',
                                    name: 'price'
                                },
                                {
                                    data: 'main_image',
                                    name: 'main_image',
                                    "render": function(data, type, full, meta) {
                                        return "<img src=\"" + data + "\" height=\"50\"/>";
                                    },
                                },
                                {
                                    data: 'action',
                                    name: 'action',
                                    orderable: true,
                                    searchable: true
                                },
                            ]
                        });

                    });
                </script>
            </div>
        </div>
    </div>
@endsection
