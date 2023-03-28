<div wire:ignore.self class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Checkout Items</h3>
                <a wire:click="closeModal" class="btn" data-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-circle"></i></a>
            </div>
            <form wire:submit.prevent="storeOrder">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Location</label>
                                <select wire:model.defer="location" id="location" recquired class="form-control">
                                    <option value="">Select Location</option>
                                    <option value="Ortigas">Ortigas</option>
                                    <option value="A Juan">A Juan</option>
                                    <option value="Marikina">Marikina</option>
                                </select>
                                @error('location')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>
                            <div class="col">
                                <label>Checkout Date</label>
                                <input type="date" wire:model.defer="checkoutdate" id="checkoutdate"
                                    class="form-control" placeholder="Enter category name">
                                @error('checkoutdate')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Client</label>
                        <input type="text" wire:model.defer="client" id="client" class="form-control"
                            placeholder="Enter client name" value="{{ old('client', '') }}">
                        @error('client')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>STO No.</label>
                                <input type="number" wire:model.defer="client" id="client" class="form-control"
                                    placeholder="Enter STO No." value="{{ old('stonumber', '') }}">
                                @error('client')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>
                            <div class="col">
                                <label>SRF No.</label>
                                <input type="text" wire:model.defer="srfnumber" id="srfnumber" class="form-control"
                                    placeholder="Enter STO No." value="{{ old('srfnumber', '') }}">
                                @error('srfnumber')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered" id="dynamicTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Stock Keeping Unit</th>
                                        <th>Product Code</th>
                                        <th>Model</th>
                                        <th>Quantity</th>
                                        <th>Unit of Measurement</th>
                                        <th>Description</th>
                                        <th>Serial No.</th>
                                        {{-- <th>Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        {{--   <td>
                                                <input type="text" name="addmore[0][stockout_id]" placeholder="Stockout ID"
                                                    class="form-control"
                                                     />
                                            </td> --}}
                                        <td>
                                            <input type="text" wire:model.defer="addmore[0][sku]"
                                                placeholder="Stock keeping unit" class="form-control" />
                                        </td>

                                        <td><input type="text" wire:model.defer="addmore[0][productcode]"
                                                placeholder="Product Code" class="form-control" /></td>

                                        <td><input type="text" wire:model.defer="addmore[0][model]" placeholder="Model"
                                                class="form-control" /></td>

                                        <td><input type="number" wire:model.defer="addmore[0][quantity]" placeholder="Quantity"
                                                class="form-control" /></td>

                                        <td><select wire:model.defer="addmore[0][uom]" class="form-control">
                                                <option value="Units">Unit/s</option>
                                                <option value="Panels">Panel/s</option>
                                                <option value="Pcs">Pc/s</option>
                                            </select></td>
                                        <td><input type="text" wire:model.defer="addmore[0][itemdescription]"
                                                placeholder="Description" class="form-control" /></td>

                                        <td><input type="text" wire:model.defer="addmore[0][serialnumber]"
                                                placeholder="Serial No." class="form-control" /></td>

                                        <td class="border border-white"><button type="button" name="add"
                                                id="add" class="btn btn-primary btn-sm"
                                                title="Add another item"><i class="bi bi-plus-circle"></i>
                                            </button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" title="Save item">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Generete PDF Modal --}}
<div wire:ignore.self class="modal fade" id="exportStoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Generate Form</h3>
                <a wire:click="closeModal" class="btn" data-dismiss="modal" aria-label="Close"><i
                        class="bi bi-x-circle"></i></a>
            </div>
            <form wire:submit.prevent="storeInventory">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Stock Transfer Outgoing Number (STO No.)</label>
                        <input type="text" wire:model.defer="stonumbersearch" class="form-control"
                            placeholder="Enter STO No." id="stonumbersearch"
                            value="{{ old('stonumbersearch', '') }}">
                        @error('stonumbersearch')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-sm btn-secondary"
                        data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Generate Form</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- card -->
                <div class="card p-3">
                    <!-- form -->
                    <form method="POST" action="{{ url('admin/orders/generateForm') }}" enctype="multipart/form-data"
                        id="form">
                        @csrf
                        <div class="mb-3">
                            <label for="stonumbersearch" class="block font-medium text-sm text-gray-700"
                                style="font-weight: bold;">STO No.</label>
                            <input type="text" name="stonumbersearch" id="stonumbersearch" type="text"
                                class="form-input rounded-md shadow-sm mt-1 block w-full"
                                value="{{ old('stonumbersearch', '') }}" />
                            @error('stonumbersearch')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning text-light"
                    style="background-color: rgb(0, 3, 158); border-color: rgb(0, 3, 158);">GENERATE</button>
            </div>
            </form>
        </div>
    </div>
</div> --}}
