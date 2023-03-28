@extends('layouts.admin')
@section('title', 'Returns')
@section('content')
    @include('admin.returns.returns-modal')
    <div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
        @elseif (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
        @endif
    </div>
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="mt-2">RETURNS
                <a class="btn btn-warning btn-sm text-white float-right" data-toggle="modal" data-target="#staticBackdrop"
                    style="margin-right: 5px;" title="Generate DR Form PDF File">Return Slip</a>
                {{-- <a href="{{ url('admin/returns/create') }}" class="btn btn-primary btn-sm text-white float-end"
                    style="margin-right: 5px;">CREATE</a> --}}
                <a href="{{ url('admin/returns/returnsPDF') }}" class="btn btn-sm text-white float-right"
                    style="margin-right: 5px; background-color: rgb(196, 80, 80);"
                    title="Export table data to PDF file">Export to PDF</a>
                <a href="#" data-toggle="modal" data-target="#addOrderModal"
                    class="btn btn-primary btn-sm text-white float-right" style="margin-right: 5px;"
                    title="Checkout items">Return Items</a>

            </h3>
        </div>

        <div class="card-body" style="background-color: #ffffff">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            {{--<th class="font-weight-bold text-center align-middle">Stockout ID</th>--}}
                            <th class="font-weight-bold text-center align-middle"> Location</th>
                            <th class="font-weight-bold text-center align-middle">Checkout Date</th>
                            <th class="font-weight-bold text-center align-middle">Client</th>
                            <th class="font-weight-bold text-center align-middle">DR No.</th>
                            <th class="font-weight-bold text-center align-middle">RS No.</th>
                            <th class="font-weight-bold text-center align-middle">SKU</th>
                            <th class="font-weight-bold text-center align-middle">Product code</th>
                            <th class="font-weight-bold text-center align-middle">Model</th>
                            <th class="font-weight-bold text-center align-middle">UOM</th>
                            <th class="font-weight-bold text-center align-middle">Description</th>
                            <th class="font-weight-bold text-center align-middle">Serial No.</th>
                            <th class="font-weight-bold text-center align-middle">Quantity</th>
                            <th class="font-weight-bold text-center align-middle">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($return_slips as $return_slip)
                            <tr>
                                {{---<td class="text-nowrap">{{ $return_slip->order_id }}</td>---}}
                                <td class="text-nowrap">{{ $return_slip->location }}</td>
                                <td class="text-nowrap">{{ $return_slip->checkoutdate }}</td>
                                <td class="text-nowrap">{{ $return_slip->client }}</td>
                                <td>{{ $return_slip->drnumber }}</td>
                                <td class="text-nowrap">{{ $return_slip->rsnumber }}</td>
                                <td class="text-nowrap">{{ $return_slip->sku }}</td>
                                <td class="text-nowrap">{{ $return_slip->productcode }}</td>
                                <td class="text-nowrap">{{ $return_slip->model }}</td>
                                <td>{{ $return_slip->uom }}</td>
                                <td style="word-wrap: break-word;min-width: 250px;max-width: 250px;">
                                    {{ $return_slip->itemdescription }}</td>
                                <td class="text-nowrap">{{ $return_slip->serialnumber }}</td>
                                <td>{{ $return_slip->quantity }}</td>
                                <td class="text-nowrap">

                                    {{-- View Button --}}
                                    <a href="#" data-toggle="modal" data-target="#viewCheckoutModal-{{ $return_slip->id }}"
                                        class="btn btn-sm btn-primary" title="View item">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- Edit Button --}}
                                    <a href="#" data-toggle="modal" data-target="#updateCheckoutModal-{{ $return_slip->id }}"
                                        class="btn btn-sm btn-warning" title="Update item">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- Delete Button --}}
                                    <a class="btn btn-sm btn-danger" role="button" data-toggle="modal"
                                        data-target="#modal-delete-{{ $return_slip->id }}">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>


                                </td>
                                {{-- -
                        <td><a href="{{ url('admin/returns/'.$item->id) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ url('admin/returns/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger btn-sm">Delete</a></td> - --}}
                            </tr>

                            {{-- Delete Modal --}}
                            <div class="modal fade" id="modal-delete-{{ $return_slip->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title fs-5" id="exampleModalLabel">Delete Item</h3>
                                            <a class="btn-close" class="btn" data-dismiss="modal" aria-label="Close"></a>
                                        </div>

                                        <div class="modal-body">
                                            <strong class="text-danger mb-2">Warning!</strong> This action is irreversible.
                                            <h6>Are you sure you want to delete this item and its data?</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <a href="{{ url('admin/returns/' . $return_slip->id . '/delete') }}"
                                                class="btn btn-sm btn-danger">Yes. Delete</a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Edit Modal --}}
                            <div class="modal fade" id="updateCheckoutModal-{{ $return_slip->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLabel">Edit Item</h3>
                                            <a class="btn" data-dismiss="modal" aria-label="Close">
                                                <i class="bi bi-x-circle"></i>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('admin/returns/'.$return_slip->id) }}" method="POST"enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="location">Location</label>
                                                        <select name="location" id="location" class="form-control"
                                                            required disabled>
                                                            <option value="" selected disabled>Select Location
                                                            </option>
                                                            <option value="Ortigas" {{ old('location',$return_slip->location) == "Ortigas" ? 'selected' : '' }}>Ortigas</option>
                                                            <option value="A Juan" {{ old('location',$return_slip->location) == "A Juan" ? 'selected' : '' }}>A Juan</option>
                                                            <option value="Marikina" {{ old('location',$return_slip->location) == "Marikina" ? 'selected' : '' }}>Marikina</option>
                                                        </select>
                                                        @error('location')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="col">
                                                        <label for="checkoutdate">Checkout date</label>
                                                        <input type="date" required name="checkoutdate"
                                                            id="checkoutdate" class="form-control"
                                                            value="{{ old('checkoutdate', $return_slip->checkoutdate) }}" />
                                                        @error('checkoutdate')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="client">Client</label>
                                                        <input type="text" required name="client" id="client"
                                                            class="form-control" value="{{ old('client',$return_slip->client ) }}"
                                                            placeholder="Enter client name" />
                                                        @error('client')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="drnumber">DR No.</label>
                                                        <input type="text" required name="drnumber" id="drnumber"
                                                            class="form-control" value="{{ old('drnumber',$return_slip->drnumber) }}"
                                                            placeholder="Enter DR no." />
                                                        @error('drnumber')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="col">
                                                        <label for="srnumber">RS No.</label>
                                                        <input type="text" required name="rsnumber" id="rsnumber"
                                                            class="form-control" value="{{ old('rsnumber',$return_slip->rsnumber) }}"
                                                            placeholder="Enter RS no." />
                                                        @error('srnumber')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="sku">SKU</label>
                                                        <input type="text" name="sku" id="sku"
                                                            class="form-control" value="{{ old('sku',$return_slip->sku) }}"
                                                            placeholder="Enter SKU" disabled/>
                                                    </div>

                                                    <div class="col">
                                                        <label for="productcode">Product
                                                            Code</label>
                                                        <input type="text" name="productcode" id="productcode"
                                                            class="form-control" value="{{ old('productcode',$return_slip->productcode) }}"
                                                            placeholder="Enter product code" disabled/>
                                                    </div>

                                                    <div class="col">
                                                        <label for="model">Model</label>
                                                        <input type="text" name="model" id="model"
                                                            class="form-control" value="{{ old('model',$return_slip->model) }}"
                                                            placeholder="Enter model" disabled/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="quantity">Quantity</label>
                                                        <input type="text" name="quantity" id="quantity"
                                                            class="form-control" value="{{ old('quantity',$return_slip->quantity) }}"
                                                            placeholder="Enter quantity" disabled />
                                                    </div>

                                                    <div class="col">
                                                        <label for="uom">UOM</label>
                                                        <input type="text" name="uom" id="uom"
                                                            class="form-control" value="{{ old('uom',$return_slip->uom) }}"
                                                            placeholder="Enter UOM" disabled/>
                                                    </div>

                                                    <div class="col">
                                                        <label for="serialnumber">Serial No.</label>
                                                        <input type="text" name="serialnumber" id="serialnumber"
                                                            class="form-control" value="{{ old('serialnumber',$return_slip->serialnumber) }}"
                                                            placeholder="Enter serial no." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="itemdescription">Item Description</label>
                                                        <textarea type="text" name="itemdescription" id="itemdescription" class="form-control"
                                                             placeholder="Enter description">{{ old('itemdescription', $return_slip->itemdescription) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="submitButt" class="btn btn-sm btn-primary">Save</button>
                                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-secondary">Cancel</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- View Modal --}}
                            <div class="modal fade" id="viewCheckoutModal-{{ $return_slip->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="exampleModalLabel">Item Details</h3>
                                            <a class="btn" data-dismiss="modal" aria-label="Close">
                                                <i class="bi bi-x-circle"></i>
                                            </a>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST"enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="location">Location</label>
                                                        <select name="location" id="location" class="form-control"
                                                            required disabled>
                                                            <option value="" selected>Select Location
                                                            </option>
                                                            <option value="Ortigas" {{ old('location',$return_slip->location) == "Ortigas" ? 'selected' : '' }}>Ortigas</option>
                                                            <option value="A Juan" {{ old('location',$return_slip->location) == "A Juan" ? 'selected' : '' }}>A Juan</option>
                                                            <option value="Marikina" {{ old('location',$return_slip->location) == "Marikina" ? 'selected' : '' }}>Marikina</option>
                                                        </select>
                                                        @error('location')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="col">
                                                        <label for="checkoutdate">Checkout date</label>
                                                        <input type="date" required name="checkoutdate"
                                                            id="checkoutdate" class="form-control" disabled
                                                            value="{{ old('checkoutdate', $return_slip->checkoutdate) }}" />
                                                        @error('checkoutdate')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="client">Client</label>
                                                        <input type="text" required name="client" id="client" disabled
                                                            class="form-control" value="{{ old('client',$return_slip->client ) }}"
                                                            placeholder="Enter client name" />
                                                        @error('client')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="drnumber">DR No.</label>
                                                        <input type="text" required name="drnumber" id="drnumber" disabled
                                                            class="form-control" value="{{ old('drnumber',$return_slip->stonumber) }}"
                                                            placeholder="Enter DR no." />
                                                        @error('drnumber')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="col">
                                                        <label for="rsnumber">RS No.</label>
                                                        <input type="text" required name="rsnumber" id="rsnumber" disabled
                                                            class="form-control" value="{{ old('rsnumber',$return_slip->rsnumber) }}"
                                                            placeholder="Enter RS no." />
                                                        @error('rsnumber')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="sku">SKU</label>
                                                        <input type="text" name="sku" id="sku" disabled
                                                            class="form-control" value="{{ old('sku',$return_slip->sku) }}"
                                                            placeholder="Enter SKU" />
                                                    </div>

                                                    <div class="col">
                                                        <label for="productcode">Product
                                                            Code</label>
                                                        <input type="text" name="productcode" id="productcode" disabled
                                                            class="form-control" value="{{ old('productcode',$return_slip->productcode) }}"
                                                            placeholder="Enter product code" />
                                                    </div>

                                                    <div class="col">
                                                        <label for="model">Model</label>
                                                        <input type="text" name="model" id="model" disabled
                                                            class="form-control" value="{{ old('model',$return_slip->model) }}"
                                                            placeholder="Enter model" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="quantity">Quantity</label>
                                                        <input type="text" name="quantity" id="quantity" disabled
                                                            class="form-control" value="{{ old('quantity',$return_slip->quantity) }}"
                                                            placeholder="Enter quantity" />
                                                    </div>

                                                    <div class="col">
                                                        <label for="uom">UOM</label>
                                                        <input type="text" name="uom" id="uom" disabled
                                                            class="form-control" value="{{ old('uom',$return_slip->uom) }}"
                                                            placeholder="Enter UOM" />
                                                    </div>

                                                    <div class="col">
                                                        <label for="serialnumber">Serial No.</label>
                                                        <input type="text" name="serialnumber" id="serialnumber" disabled
                                                            class="form-control" value="{{ old('serialnumber',$return_slip->serialnumber) }}"
                                                            placeholder="Enter serial no." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="itemdescription">Item Description</label>
                                                        <textarea rows="6" type="text" name="itemdescription" id="itemdescription" class="form-control" disabled
                                                             placeholder="Enter description">{{ old('itemdescription', $return_slip->itemdescription) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-secondary btn-close">Close</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $return_slips->links() }}
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.deleteOrderButton').click(function(e) {
                e.preventDefault();

                var item_id = $(this.val());
                $('#item_id').val(item_id);

                $('#deleteOrderModal').modal('show');

            });
        });
    </script>
@endsection
