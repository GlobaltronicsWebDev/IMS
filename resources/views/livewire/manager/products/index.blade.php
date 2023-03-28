<div class="row">
    @section('title', 'Inventory')
    @include('livewire.manager.products.modal-form')
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
        @endif
        <div class="card mb-5">
            <div class="card-header">
                <h3>Inventory
                    <a href="{{ url('manager/products/productsPDF') }}" class="btn btn-danger btn-sm shadow-none float-right mx-1" >Export to PDF</a>
                    <a href="#" class="btn btn-primary btn-sm shadow-none float-right mx-1" data-toggle="modal"
                        data-target="#addInventoryModal">Add Item</a>
                    {{-- <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm text-white float-right">Add Product</a> --}}
                </h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <form action="{{ route('products.search') }}" method="GET" role="search">
                        <div class="form-row float-right mb-2 mr-1">
                            <div class="input-group" style="max-width:18rem;">
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary" type="submit" title="Search Products"
                                        id="button-addon1"><i class="fas fa-search"></i></button>
                                </div>
                                <input type="text" class="form-control" placeholder="Search Products" name="term"
                                    id="term" aria-label="Search field" aria-describedby="button-addon1">
                                <div class="input-group-append">
                                    <a class="btn btn-danger" type="button" title="Refresh page"
                                        href="{{ url('manager/products') }}"><i class="fas fa-sync-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center align-middle">ID</th>
                                <th class="text-center align-middle">Location</th>
                                <th class="text-center align-middle">Date Added</th>
                                <th class="text-center align-middle">Date Updated</th>

                                <th class="text-center align-middle">Category</th>
                                <th class="text-center align-middle">Brand</th>
                                <th class="text-center align-middle">Model</th>
                                <th class="text-center align-middle">SKU</th>
                                <th class="text-center align-middle">Product Code</th>
                                <th class="text-center align-middle">UOM</th>

                                <th class="text-center align-middle">Description</th>
                                <th class="text-center align-middle">Quantity</th>
                                <th class="text-center align-middle">Status</th>

                                <th class="text-center align-middle">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td class="text-nowrap">{{ $product->location }}</td>
                                    <td class="text-nowrap">{{ $product->created_at }}</td>
                                    <td class="text-nowrap">{{ $product->updated_at }}</td>

                                    <td class="text-nowrap">
                                        @if ($product->category)
                                            {{ $product->category->name }}
                                        @else
                                            No Category
                                        @endif
                                    </td>
                                    <td class="text-nowrap">{{ $product->brand }}</td>
                                    <td class="text-nowrap">{{ $product->model }}</td>
                                    <td class="text-nowrap">{{ $product->sku }}</td>
                                    <td class="text-nowrap">{{ $product->productcode }}</td>
                                    <td class="text-nowrap">{{ $product->uom }}</td>

                                    <td style="word-wrap: break-word;min-width: 260px;max-width: 260px;"
                                        class="text-truncate">{{ $product->description }}</td>

                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->status }}</td>

                                    <td class="text-nowrap">
                                        <a href="#" wire:click="editProduct({{ $product->id }})"
                                            data-toggle="modal" data-target="#viewProductModal"
                                            class="btn btn-primary shadow-none btn-sm" title="View item">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <a href="#" wire:click="editProduct({{ $product->id }})"
                                            data-toggle="modal" data-target="#updateProductModal"
                                            class="btn btn-warning shadow-none btn-sm" title="Update item">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="#" wire:click="deleteProduct({{ $product->id }})"
                                            data-toggle="modal" data-target="#deleteModal"
                                            class="btn btn-danger shadow-none btn-sm" title="Delete item">
                                            <i class="bi bi-trash3-fill"></i>
                                        </a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="14">No Item Available</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                <div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addInventoryModal').modal('hide');
            $('#updateProductModal').modal('hide');
            $('#deleteModal').modal('hide');
        });
    </script>
@endpush
