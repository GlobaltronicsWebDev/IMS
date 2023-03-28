{{-- MODALS --}}
{{-- Generate PDF Modal --}}
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="staticBackdropLabel">Generate Form</h3>
                <a class="btn" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </a>
            </div>
            <form method="POST" action="{{ url('manager/purchasereturns/generateForm') }}" enctype="multipart/form-data"
                id="form">
                <div class="modal-body">
                    <!-- form -->
                    @csrf
                    <div class="mb-3">
                        <label for="drnumber">DR No.</label>
                        <input type="text" name="drnumber" id="drnumber" type="text"
                            class="form-control" required placeholder="Enter DR No."
                            value="{{ old('drnumber', '') }}" />
                        @error('drnumber')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Generate PDF</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Create MOdal --}}
<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h3 class="modal-title" id="exampleModalLabel">Checkout Items</h3> --}}
                <h3 class="modal-title" id="exampleModalLabel">Return Items</h3>
                <a class="btn" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </a>
            </div>
            <form method="POST" id="forms">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label for="location" class="block font-medium text-sm text-gray-700">Location</label>
                                <select name="location" id="location" class="form-control" required>
                                    <option value="" selected disabled>Select Location</option>
                                    <option value="Ortigas">Ortigas</option>
                                    <option value="A Juan">A Juan</option>
                                    <option value="Marikina">Marikina</option>
                                </select>
                                @error('location')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="checkoutdate">Checkout date</label>
                                <input type="date" required name="checkoutdate" id="checkoutdate"
                                    class="form-control" value="{{ old('checkoutdate', '') }}" />
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
                                <input type="text" required name="client" id="client" class="form-control"
                                    value="{{ old('client', '') }}" placeholder="Enter client name" />
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
                                <input type="text" required name="drnumber" id="drnumber" class="form-control"
                                    value="{{ old('drnumber', '') }}" placeholder="Enter DR no." />
                                @error('drnumber')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="prsnumber">PRS No.</label>
                                <input type="text" required name="prsnumber" id="prsnumber" class="form-control"
                                    value="{{ old('prsnumber', '') }}" placeholder="Enter PRS No." />
                                @error('prsnumber')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered" id="dynamicTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>SKU</th>
                                        <th>Product Code</th>
                                        <th>Model</th>
                                        <th>Quantity</th>
                                        <th>UOM</th>
                                        <th>Item Description</th>
                                        <th>Serial No.</th>
                                    </tr>
                                </thead>
                                <tr>
                                    {{-- <td>
                                    <input type="text" name="addmore[0][stockout_id]" placeholder="Stockout ID"class="form-control"/>
                                </td> --}}
                                    <td>
                                        <input type="text" required name="sku" placeholder="SKU"
                                            class="form-control" />
                                    </td>
                                    <td><input type="text" required name="productcode"
                                            placeholder="Product Code" class="form-control" /></td>
                                    <td><input type="text" required name="model" placeholder="Model"
                                            class="form-control" /></td>
                                    <td><input type="text" required name="quantity"
                                            placeholder="Quantity" class="form-control" /></td>
                                    <td><select name="uom" required class="form-control">
                                            <option value="Units">Unit/s</option>
                                            <option value="Panels">Panel/s</option>
                                            <option value="Pcs">Pc/s</option>
                                        </select></td>
                                    <td><input type="text" required name="itemdescription"
                                            placeholder="Item Description" class="form-control" /></td>
                                    <td><input type="text" required name="serialnumber"
                                            placeholder="Serial No." class="form-control" /></td>
                                    {{---<td class="border border-white"><button type="button" name="add"
                                            id="add" class="btn btn-primary btn-sm">
                                            <i class="bi bi-plus-circle"></i>
                                        </button>
                                    </td>---}}
                                </tr>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        Please fill out all of the table fields.
                                    </div>
                                @endif
                            </table>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="submitButt" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
{{-- <div class="modal fade" id="updateCheckoutModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Checkout Items</h3>
                <a class="btn" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </a>
            </div>
                <div class="modal-body">
                    <form action="{{ url('manager/orders/'.$order_item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label for="location" class="block font-medium text-sm text-gray-700">Location</label>
                                <select name="location" id="location" class="form-control" required>
                                    <option value="" selected disabled>Select Location</option>
                                    <option value="Ortigas">Ortigas</option>
                                    <option value="A Juan">A Juan</option>
                                    <option value="Marikina">Marikina</option>
                                </select>
                                @error('location')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="checkoutdate">Checkout date</label>
                                <input type="date" required name="checkoutdate" id="checkoutdate"
                                    class="form-control" value="{{ old('checkoutdate', '') }}" />
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
                                <input type="text" required name="client" id="client" class="form-control"
                                    value="{{ old('client', '') }}" placeholder="Enter client name" />
                                @error('client')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label for="stonumber">STO No.</label>
                                <input type="text" required name="stonumber" id="stonumber" class="form-control"
                                    value="{{ old('stonumber', '') }}" placeholder="Enter STO no." />
                                @error('stonumber')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col">
                                <label for="srfnumber">SRF No.</label>
                                <input type="text" required name="srfnumber" id="srfnumber" class="form-control"
                                    value="{{ old('srfnumber', '') }}" placeholder="Enter SRF no." />
                                @error('srfnumber')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                </div>
            </form>
        </div>
    </div>
</div> --}}


{{-- Delete Modal --}}

@push('script')
    {{-- <script>
        window.addEventListener('close-modal', event => {
            $('#addOrderModal').modal('hide');
        });
    </script>
    <script>
        $("#forms").submit(function(e) {
            e.preventDefault();
            {{ url('manager/orders') }};
        });
    </script> --}}

@endpush
