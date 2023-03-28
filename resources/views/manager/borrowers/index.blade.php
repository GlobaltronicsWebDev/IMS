@extends('layouts.manager')
@section('title', 'Borrow Items')
@section('content')
    @include('manager.borrowers.borrowers-modal')
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
            <h3 class="mt-2">Borrow Items
                <a class="btn btn-warning btn-sm text-white float-right" data-toggle="modal" data-target="#staticBackdrop"
                    style="margin-right: 5px;" title="Generate DR Form PDF File">Borrower Slip</a>
                {{-- <a href="{{ url('manager/borrowers/create') }}" class="btn btn-primary btn-sm text-white float-end"
                    style="margin-right: 5px;">CREATE</a> --}}
                <a href="{{ url('manager/borrowers/borrowersPDF') }}" class="btn btn-sm text-white float-right"
                    style="margin-right: 5px; background-color: rgb(196, 80, 80);"
                    title="Export table data to PDF file">Export to PDF</a>
                <a href="#" data-toggle="modal" data-target="#addOrderModal"
                    class="btn btn-primary btn-sm text-white float-right" style="margin-right: 5px;"
                    title="Checkout items">Borrow Items</a>

            </h3>
        </div>

        <div class="card-body" style="background-color: #ffffff">

            <div class="mb-3">
                <form action="{{ route('borrowers.search') }}" method="GET" role="search">
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
                                    href="{{ url('manager/borrowers') }}"><i class="fas fa-sync-alt"></i></a>
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
                            <th class="font-weight-bold text-center align-middle">Location</th>
                            <th class="font-weight-bold text-center align-middle">Borrow Date</th>
                            <th class="font-weight-bold text-center align-middle">Client</th>
                            <th class="font-weight-bold text-center align-middle">BR No.</th>
                            <th class="font-weight-bold text-center align-middle">Date of Return</th>
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
                        @forelse ($borrowers as $borrower)
                            <tr>
                                {{---<td class="text-nowrap">{{ $borrower->order_id }}</td>---}}
                                <td class="text-nowrap">{{ $borrower->location }}</td>
                                <td class="text-nowrap">{{ $borrower->checkoutdate }}</td>
                                <td class="text-nowrap">{{ $borrower->client }}</td>
                                <td>{{ $borrower->brnumber }}</td>
                                <td class="text-nowrap">{{ $borrower->dateofreturn }}</td>
                                <td class="text-nowrap">{{ $borrower->sku }}</td>
                                <td class="text-nowrap">{{ $borrower->productcode }}</td>
                                <td class="text-nowrap">{{ $borrower->model }}</td>
                                <td>{{ $borrower->uom }}</td>
                                <td style="word-wrap: break-word;min-width: 250px;max-width: 250px;">
                                    {{ $borrower->itemdescription }}</td>
                                <td class="text-nowrap">{{ $borrower->serialnumber }}</td>
                                <td>{{ $borrower->quantity }}</td>
                                <td class="text-nowrap">

                                    {{-- View Button --}}
                                    <a href="#" data-toggle="modal" data-target="#viewCheckoutModal-{{ $borrower->id }}"
                                        class="btn btn-sm btn-primary" title="View item">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- Edit Button --}}
                                    <a href="#" data-toggle="modal" data-target="#updateCheckoutModal-{{ $borrower->id }}"
                                        class="btn btn-sm btn-warning" title="Update item">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- Delete Button --}}
                                    <a class="btn btn-sm btn-danger" role="button" data-toggle="modal"
                                        data-target="#modal-delete-{{ $borrower->id }}">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>


                                </td>
                                {{-- -
                        <td><a href="{{ url('manager/borrowers/'.$item->id) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="{{ url('manager/borrowers/'.$item->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger btn-sm">Delete</a></td> - --}}
                            </tr>

                            {{-- Delete Modal --}}
                            <div class="modal fade" id="modal-delete-{{ $borrower->id }}" tabindex="-1"
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
                                            <a href="{{ url('manager/borrowers/' . $borrower->id . '/delete') }}"
                                                class="btn btn-sm btn-danger">Yes. Delete</a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- Edit Modal --}}
                            <div class="modal fade" id="updateCheckoutModal-{{ $borrower->id }}" tabindex="-1"
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
                                            <form action="{{ url('manager/borrowers/'.$borrower->id) }}" method="POST"enctype="multipart/form-data">
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
                                                            <option value="Ortigas" {{ old('location',$borrower->location) == "Ortigas" ? 'selected' : '' }}>Ortigas</option>
                                                            <option value="A Juan" {{ old('location',$borrower->location) == "A Juan" ? 'selected' : '' }}>A Juan</option>
                                                            <option value="Marikina" {{ old('location',$borrower->location) == "Marikina" ? 'selected' : '' }}>Marikina</option>
                                                        </select>
                                                        @error('location')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="col">
                                                        <label for="checkoutdate">Borrow date</label>
                                                        <input type="date" required name="checkoutdate"
                                                            id="checkoutdate" class="form-control"
                                                            value="{{ old('checkoutdate', $borrower->checkoutdate) }}" />
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
                                                            class="form-control" value="{{ old('client',$borrower->client ) }}"
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
                                                        <label for="brnumber">BR No.</label>
                                                        <input type="text" required name="brnumber" id="brnumber"
                                                            class="form-control" value="{{ old('brnumber',$borrower->brnumber) }}"
                                                            placeholder="Enter BR No." />
                                                        @error('brnumber')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="col">
                                                        <label for="srnumber">Date of Return</label>
                                                        <input type="date" required name="dateofreturn" id="dateofreturn"
                                                            class="form-control" value="{{ old('dateofreturn',$borrower->dateofreturn) }}"
                                                            placeholder="Enter Date of Return" />
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
                                                            class="form-control" value="{{ old('sku',$borrower->sku) }}"
                                                            placeholder="Enter SKU" disabled/>
                                                    </div>

                                                    <div class="col">
                                                        <label for="productcode">Product
                                                            Code</label>
                                                        <input type="text" name="productcode" id="productcode"
                                                            class="form-control" value="{{ old('productcode',$borrower->productcode) }}"
                                                            placeholder="Enter product code" disabled/>
                                                    </div>

                                                    <div class="col">
                                                        <label for="model">Model</label>
                                                        <input type="text" name="model" id="model"
                                                            class="form-control" value="{{ old('model',$borrower->model) }}"
                                                            placeholder="Enter model" disabled/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="quantity">Quantity</label>
                                                        <input type="text" name="quantity" id="quantity"
                                                            class="form-control" value="{{ old('quantity',$borrower->quantity) }}"
                                                            placeholder="Enter quantity" disabled />
                                                    </div>

                                                    <div class="col">
                                                        <label for="uom">UOM</label>
                                                        <input type="text" name="uom" id="uom"
                                                            class="form-control" value="{{ old('uom',$borrower->uom) }}"
                                                            placeholder="Enter UOM" disabled/>
                                                    </div>

                                                    <div class="col">
                                                        <label for="serialnumber">Serial No.</label>
                                                        <input type="text" name="serialnumber" id="serialnumber"
                                                            class="form-control" value="{{ old('serialnumber',$borrower->serialnumber) }}"
                                                            placeholder="Enter serial no." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="itemdescription">Item Description</label>
                                                        <textarea type="text" name="itemdescription" id="itemdescription" class="form-control"
                                                             placeholder="Enter description">{{ old('itemdescription', $borrower->itemdescription) }}</textarea>
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
                            <div class="modal fade" id="viewCheckoutModal-{{ $borrower->id }}" tabindex="-1"
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
                                                            <option value="Ortigas" {{ old('location',$borrower->location) == "Ortigas" ? 'selected' : '' }}>Ortigas</option>
                                                            <option value="A Juan" {{ old('location',$borrower->location) == "A Juan" ? 'selected' : '' }}>A Juan</option>
                                                            <option value="Marikina" {{ old('location',$borrower->location) == "Marikina" ? 'selected' : '' }}>Marikina</option>
                                                        </select>
                                                        @error('location')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="col">
                                                        <label for="checkoutdate">Borrow date</label>
                                                        <input type="date" required name="checkoutdate"
                                                            id="checkoutdate" class="form-control" disabled
                                                            value="{{ old('checkoutdate', $borrower->checkoutdate) }}" />
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
                                                            class="form-control" value="{{ old('client',$borrower->client ) }}"
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
                                                        <label for="brnumber">BR No.</label>
                                                        <input type="text" required name="brnumber" id="brnumber" disabled
                                                            class="form-control" value="{{ old('brnumber',$borrower->stonumber) }}"
                                                            placeholder="Enter BR No." />
                                                        @error('brnumber')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <div class="col">
                                                        <label for="dateofreturn">Date of Return</label>
                                                        <input type="date" required name="dateofreturn" id="dateofreturn" disabled
                                                            class="form-control" value="{{ old('dateofreturn',$borrower->dateofreturn) }}"
                                                            placeholder="Enter Date of Return" />
                                                        @error('dateofreturn')
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
                                                            class="form-control" value="{{ old('sku',$borrower->sku) }}"
                                                            placeholder="Enter SKU" />
                                                    </div>

                                                    <div class="col">
                                                        <label for="productcode">Product
                                                            Code</label>
                                                        <input type="text" name="productcode" id="productcode" disabled
                                                            class="form-control" value="{{ old('productcode',$borrower->productcode) }}"
                                                            placeholder="Enter product code" />
                                                    </div>

                                                    <div class="col">
                                                        <label for="model">Model</label>
                                                        <input type="text" name="model" id="model" disabled
                                                            class="form-control" value="{{ old('model',$borrower->model) }}"
                                                            placeholder="Enter model" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="quantity">Quantity</label>
                                                        <input type="text" name="quantity" id="quantity" disabled
                                                            class="form-control" value="{{ old('quantity',$borrower->quantity) }}"
                                                            placeholder="Enter quantity" />
                                                    </div>

                                                    <div class="col">
                                                        <label for="uom">UOM</label>
                                                        <input type="text" name="uom" id="uom" disabled
                                                            class="form-control" value="{{ old('uom',$borrower->uom) }}"
                                                            placeholder="Enter UOM" />
                                                    </div>

                                                    <div class="col">
                                                        <label for="serialnumber">Serial No.</label>
                                                        <input type="text" name="serialnumber" id="serialnumber" disabled
                                                            class="form-control" value="{{ old('serialnumber',$borrower->serialnumber) }}"
                                                            placeholder="Enter serial no." />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="itemdescription">Item Description</label>
                                                        <textarea rows="6" type="text" name="itemdescription" id="itemdescription" class="form-control" disabled
                                                             placeholder="Enter description">{{ old('itemdescription', $borrower->itemdescription) }}</textarea>
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
            {{ $borrowers->links() }}
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
