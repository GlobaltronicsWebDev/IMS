<div class="row">
    @include('livewire.admin.order.modal-form')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Checkout
                    <a href="#" class="btn btn-primary btn-sm shadow-none float-right" data-toggle="modal"
                        data-target="#addOrderModal">Checkout Item</a>
                    <a href="#" class="btn btn-warning btn-sm shadow-none float-right mr-2" data-toggle="modal"
                        data-target="#exportStoModal">STO Form</a>
                    {{-- <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-sm text-white float-right">Add Product</a> --}}
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th style=" font-weight:bold ;">Stockout ID</th>
                                    <th style=" font-weight:bold ;">Location</th>
                                    <th style=" font-weight:bold ;">Checkout Date</th>
                                    <th style=" font-weight:bold ;">Client</th>
                                    <th style=" font-weight:bold ;">STO No.</th>
                                    <th style=" font-weight:bold ;">SRF No.</th>
                                    <th style=" font-weight:bold ;">SKU</th>
                                    <th style=" font-weight:bold ;">Product code</th>
                                    <th style=" font-weight:bold ;">Model</th>
                                    <th style=" font-weight:bold ;">UOM</th>
                                    <th style=" font-weight:bold ;">Description</th>
                                    <th style=" font-weight:bold ;">Serial No.</th>
                                    <th style=" font-weight:bold ;">Quantity</th>
                                    <th style=" font-weight:bold ;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_items as $order_item)
                                    <tr>
                                        <td>{{ $order_item->order_id }}</td>
                                        <td>{{ $order_item->location }}</td>
                                        <td>{{ $order_item->checkoutdate }}</td>
                                        <td>{{ $order_item->client }}</td>
                                        <td>{{ $order_item->stonumber }}</td>
                                        <td>{{ $order_item->srfnumber }}</td>
                                        <td>{{ $order_item->sku }}</td>
                                        <td>{{ $order_item->productcode }}</td>
                                        <td>{{ $order_item->model }}</td>
                                        <td>{{ $order_item->uom }}</td>
                                        <td style="word-wrap: break-word;min-width: 250px;max-width: 250px;">{{ $order_item->itemdescription }}</td>
                                        <td>{{ $order_item->serialnumber }}</td>
                                        <td>{{ $order_item->quantity }}</td>
                                        <td> <a href="#" wire:click=""
                                            data-toggle="modal" data-target="#updateCheckoutModal"
                                            class="btn btn-sm btn-warning" title="Edit item">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="#" wire:click=""
                                            data-toggle="modal" data-target="#deleteModal"
                                            class="btn btn-danger shadow-none btn-sm" title="Delete item"><i class="bi bi-trash3-fill"></i></a>
                                        </td>
                                        {{-- -  <td><a href="{{ url('admin/orders/'.$item->id) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ url('admin/orders/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger btn-sm">Delete</a></td> - --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">
                        {{ $order_items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

