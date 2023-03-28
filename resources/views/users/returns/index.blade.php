@extends('layouts.app')
@section('title', 'Returns')
@section('content')
    <div class="card mb-5 mx-5">
        <div class="card-header">
            <h3 class="mt-2">RETURNS
                <a href="{{ url('/returns/returnsPDF') }}" class="btn btn-sm text-white float-right"
                    style="margin-right: 5px; background-color: rgb(196, 80, 80);"
                    title="Export table data to PDF file">Export to PDF</a>
            </h3>
        </div>

        <div class="card-body" style="background-color: #ffffff">
            <div class="mb-3">
                <form action="{{ route('return.search') }}" method="GET" role="search">
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
                                    href="{{ url('/returns') }}"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
                        @forelse ($return_slips as $return_slip)
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
                                <td class="text-nowrap text-center">

                                    {{-- View Button --}}
                                    <a href="#" data-toggle="modal" data-target="#viewCheckoutModal-{{ $return_slip->id }}"
                                        class="btn btn-sm btn-primary" title="View item">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>

                            {{-- View Modal --}}
                            <div class="modal fade" id="viewCheckoutModal-{{ $return_slip->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
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
                            @empty
                            <tr>
                                <td colspan="17">No Items Available</td>
                            </tr>
                        @endforelse
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
