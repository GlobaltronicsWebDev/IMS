@extends('layouts.admin')
@section('title', 'Check-in Items')
@section('content')
    @include('admin.checkin.checkin-modal')
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
            @elseif (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
        @endif
    </div>
    <div class="card mb-5">
        <div class="card-header">
            <h3 class="mt-2 text">CHECK-IN
                <a href="{{ url('admin/checkins/checkinsPDF') }}" class="btn btn-danger btn-sm text-white float-right mx-1"
                    title="Export table data to PDF">Export to PDF</a>
                <a href="#" data-toggle="modal" data-target="#addCheckinModal"
                    class="btn btn-primary btn-sm text-white float-right mx-1"
                    title="Checkout items">Check-in Item/s</a>
            </h3>
        </div>
        <div class="card-body" style="background-color: #ffffff">
            <div class="mb-3">
                <form action="{{ route('checkins.search') }}" method="GET" role="search">
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
                                    href="{{ url('admin/checkins') }}"><i class="fas fa-sync-alt"></i></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-stripped">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center align-middle">ID</th>
                            <th class="text-center align-middle"> Location</th>
                            <th style=" font-weight:bold ;">Checkin Date</th>
                            <th style=" font-weight:bold ;">PO No.</th>
                            <th style=" font-weight:bold ;">STR No.</th>
                            <th style=" font-weight:bold ;">Category</th>
                            <th style=" font-weight:bold ;">Brand</th>
                            <th style=" font-weight:bold ;">Product Code</th>
                            <th style=" font-weight:bold ;">SKU</th>
                            <th style=" font-weight:bold ;">Model</th>
                            <th style=" font-weight:bold ;">Description</th>
                            <th style=" font-weight:bold ;">Serial No.</th>
                            <th style=" font-weight:bold ;">QTY</th>
                            <th style=" font-weight:bold ;">UOM</th>
                            <th style=" font-weight:bold ;">Status</th>
                            <th style=" font-weight:bold ;">Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($checkins as $checkin)
                            <tr>
                                <td>{{ $checkin->id }}</td>
                                <td>{{ $checkin->location }}</td>
                                <td>{{ $checkin->checkindate }}</td>
                                <td>{{ $checkin->ponumber }}</td>
                                <td>{{ $checkin->strnumber }}</td>
                                <td>{{ $checkin->category->name }}</td>
                                <td>{{ $checkin->brand }}</td>
                                <td>{{ $checkin->productcode }}</td>
                                <td>{{ $checkin->sku }}</td>
                                <td>{{ $checkin->model }}</td>
                                <td>{{ $checkin->itemdescription }}</td>
                                <td>{{ $checkin->serialnumber }}</td>
                                <td>{{ $checkin->quantity }}</td>
                                <td>{{ $checkin->uom }}</td>
                                <td>{{ $checkin->status }}</td>
                                <td>{{ $checkin->remarks }}</td>
                                <td>
                                    {{-- <a href="{{ url('admin/checkins/'.$checkin->id.'/edit') }}" class="btn btn-sm btn-success">Edit</a> --}}
                                    {{-- View --}}
                                    <a href="#" data-toggle="modal" data-target="#viewCheckinModal-{{ $checkin->id }}" class="btn btn-sm btn-primary" title="View item">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="#" data-toggle="modal"
                                        data-target="#editCheckinModal-{{ $checkin->id }}" class="btn btn-sm btn-warning" title="Edit item">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <a href="{{ url('admin/checkins/' . $checkin->id . '/delete') }}"
                                        onclick="return confirm('Are you sure, you want to delete this data?')"
                                        class="btn btn-sm btn-danger" title="Delete item">
                                        <i class="bi bi-trash3-fill"></i>
                                    </a>
                            </tr>

                            {{-- Delete Modal --}}
                            <div class="modal fade" id="modal-delete-{{ $checkin->id }}" tabindex="-1"
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
                                            <a href="{{ url('admin/orders/' . $checkin->id . '/delete') }}"
                                                class="btn btn-sm btn-danger">Yes. Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editCheckinModal-{{ $checkin->id }}" tabindex="-1"
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
                                            <form action="{{ url('admin/checkins/' . $checkin->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label>Location</label>
                                                            <select name="location" class="form-control" disabled>
                                                                <option value="" selected disabled>Select Location
                                                                </option>
                                                                <option value="Ortigas"
                                                                    {{ old('location', $checkin->location) == 'Ortigas' ? 'selected' : '' }}>
                                                                    Ortigas</option>
                                                                <option value="A Juan"
                                                                    {{ old('location', $checkin->location) == 'A Juan' ? 'selected' : '' }}>
                                                                    A Juan</option>
                                                                <option value="Marikina"
                                                                    {{ old('location', $checkin->location) == 'Marikina' ? 'selected' : '' }}>
                                                                    Marikina</option>
                                                            </select>
                                                        </div>

                                                        <div class="col">
                                                            <label>Check-in date</label>
                                                            <input type="date" name="checkindate" class="form-control"
                                                                value="{{ old('checkindate', $checkin->checkindate) }}" />
                                                        </div>


                                                        <div class="col">
                                                            <label>PO No.</label>
                                                            <input type="text" name="ponumber" class="form-control"
                                                                value="{{ old('ponumber', $checkin->ponumber) }}" />
                                                        </div>


                                                        <div class="col">
                                                            <label>STR No.</label>
                                                            <input type="text" name="strnumber" class="form-control"
                                                                value="{{ old('strnumber', $checkin->strnumber) }}" />
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label>Category</label>
                                                            <select name="category_id" class="form-control" disabled>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        {{ old('category_id', $checkin->category_id) == $category->id ? 'selected' : '' }}>
                                                                        {{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col">
                                                            <label>Brand</label>
                                                            <select name="brand" class="form-control" disabled>
                                                                @foreach ($brands as $brand)
                                                                    <option value="{{ $brand->name }}"
                                                                        {{ old('brand', $checkin->brand) == $brand->name ? 'selected' : '' }}>
                                                                        {{ $brand->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label>Product Code</label>
                                                            <input type="text" name="productcode" class="form-control"
                                                                value="{{ old('productcode', $checkin->productcode) }}" disabled/>
                                                        </div>

                                                        <div class="col">
                                                            <label>SKU</label>
                                                            <input type="text" name="sku" class="form-control"
                                                                value="{{ old('sku', $checkin->sku) }}" disabled/>
                                                        </div>

                                                        <div class="col">
                                                            <label>Model</label>
                                                            <input type="text" name="model" class="form-control"
                                                                value="{{ old('model', $checkin->model) }}" disabled/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label>Item Description</label>
                                                            <textarea name="itemdescription" class="form-control" rows="4">{{ old('itemdescription', $checkin->itemdescription) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label>Serial No.</label>
                                                            <input type="text" name="serialnumber" class="form-control"
                                                                value="{{ old('serialnumber', $checkin->serialnumber) }}" />
                                                        </div>
                                                        <div class="col">
                                                            <label>Quantity</label>
                                                            <input type="text" name="quantity" class="form-control"
                                                                value="{{ old('quantity', $checkin->quantity) }}" disabled/>
                                                        </div>

                                                        <div class="col">
                                                            <label>UOM</label>
                                                            <select name="uom" class="form-control" disabled>
                                                                <option value="" selected disabled>Select UOM
                                                                </option>
                                                                <option value="Units"
                                                                    {{ old('uom', $checkin->uom) == 'Units' ? 'selected' : '' }}>
                                                                    Units</option>
                                                                <option value="Panels"
                                                                    {{ old('uom', $checkin->uom) == 'Panels' ? 'selected' : '' }}>
                                                                    Panels</option>
                                                                <option value="Pcs"
                                                                    {{ old('uom', $checkin->uom) == 'Pcs' ? 'selected' : '' }}>
                                                                    Pcs</option>
                                                            </select>
                                                        </div>

                                                        <div class="col">
                                                            <label>Status</label>
                                                            <select name="status" class="form-control">
                                                                <option value="" selected disabled>Select status
                                                                </option>
                                                                <option
                                                                    value="Complete"{{ old('status', $checkin->status) == 'Complete' ? 'selected' : '' }}>
                                                                    Complete</option>
                                                                <option value="Incomplete"
                                                                    {{ old('status', $checkin->status) == 'Incomplete' ? 'selected' : '' }}>
                                                                    Incomplete</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label>Remarks</label>
                                                            <textarea type="text" name="remarks" class="form-control" rows="4">{{ old('remarks', $checkin->remarks) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                            <button type="button" data-dismiss="modal"
                                                class="btn btn-sm btn-secondary btn-close">Cancel</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- View Modal --}}
                            <div class="modal fade" id="viewCheckinModal-{{ $checkin->id }}" tabindex="-1"
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
                                            <form method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label>Location</label>
                                                            <select name="location" class="form-control" disabled>
                                                                <option value="" selected disabled>Select Location
                                                                </option>
                                                                <option value="Ortigas"
                                                                    {{ old('location', $checkin->location) == 'Ortigas' ? 'selected' : '' }}>
                                                                    Ortigas</option>
                                                                <option value="A Juan"
                                                                    {{ old('location', $checkin->location) == 'A Juan' ? 'selected' : '' }}>
                                                                    A Juan</option>
                                                                <option value="Marikina"
                                                                    {{ old('location', $checkin->location) == 'Marikina' ? 'selected' : '' }}>
                                                                    Marikina</option>
                                                            </select>
                                                        </div>

                                                        <div class="col">
                                                            <label>Check-in date</label>
                                                            <input type="date" name="checkindate" class="form-control" disabled
                                                                value="{{ old('checkindate', $checkin->checkindate) }}" />
                                                        </div>
                                                        <div class="col">
                                                            <label>PO No.</label>
                                                            <input type="text" name="ponumber" class="form-control" disabled
                                                                value="{{ old('ponumber', $checkin->ponumber) }}" />
                                                        </div>
                                                        <div class="col">
                                                            <label>STR No.</label>
                                                            <input type="text" name="strnumber" class="form-control" disabled
                                                                value="{{ old('strnumber', $checkin->strnumber) }}" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label>Category</label>
                                                            <select name="category_id" class="form-control" disabled>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}"
                                                                        {{ old('category_id', $checkin->category_id) == $category->id ? 'selected' : '' }}>
                                                                        {{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col">
                                                            <label>Brand</label>
                                                            <select name="brand" class="form-control" disabled>
                                                                @foreach ($brands as $brand)
                                                                    <option value="{{ $brand->name }}"
                                                                        {{ old('brand', $checkin->brand) == $brand->name ? 'selected' : '' }}>
                                                                        {{ $brand->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label>Product Code</label>
                                                            <input type="text" name="productcode" class="form-control" disabled
                                                                value="{{ old('productcode', $checkin->productcode) }}" />
                                                        </div>

                                                        <div class="col">
                                                            <label>SKU</label>
                                                            <input type="text" name="sku" class="form-control" disabled
                                                                value="{{ old('sku', $checkin->sku) }}" />
                                                        </div>

                                                        <div class="col">
                                                            <label>Model</label>
                                                            <input type="text" name="model" class="form-control" disabled
                                                                value="{{ old('model', $checkin->model) }}" />
                                                        </div>

                                                        <div class="col">
                                                            <label>Serial No.</label>
                                                            <input type="text" name="serialnumber" class="form-control" disabled
                                                                value="{{ old('serialnumber', $checkin->serialnumber) }}" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label>Item Description</label>
                                                            <textarea name="itemdescription" class="form-control" rows="4" disabled>{{ old('itemdescription', $checkin->itemdescription) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label>Quantity</label>
                                                            <input type="text" name="quantity" class="form-control" disabled
                                                                value="{{ old('quantity', $checkin->quantity) }}" />
                                                        </div>

                                                        <div class="col">
                                                            <label>UOM</label>
                                                            <select name="uom" class="form-control" disabled>
                                                                <option value="" selected disabled>Select UOM
                                                                </option>
                                                                <option value="Units"
                                                                    {{ old('uom', $checkin->uom) == 'Units' ? 'selected' : '' }}>
                                                                    Units</option>
                                                                <option value="Panels"
                                                                    {{ old('uom', $checkin->uom) == 'Panels' ? 'selected' : '' }}>
                                                                    Panels</option>
                                                                <option value="Pcs"
                                                                    {{ old('uom', $checkin->uom) == 'Pcs' ? 'selected' : '' }}>
                                                                    Pcs</option>
                                                            </select>
                                                        </div>

                                                        <div class="col">
                                                            <label>Status</label>
                                                            <select name="status" class="form-control" disabled>
                                                                <option value="" selected disabled>Select status
                                                                </option>
                                                                <option
                                                                    value="Complete"{{ old('status', $checkin->status) == 'Complete' ? 'selected' : '' }}>
                                                                    Complete</option>
                                                                <option value="Incomplete"
                                                                    {{ old('status', $checkin->status) == 'Incomplete' ? 'selected' : '' }}>
                                                                    Incomplete</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-row">
                                                        <div class="col">
                                                            <label>Remarks</label>
                                                            <textarea type="text" disabled name="remarks" class="form-control" rows="4">{{ old('remarks', $checkin->remarks) }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                            <button type="button" data-dismiss="modal"
                                                class="btn btn-sm btn-secondary btn-close">Cancel</button>
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
                <div class="mt-5">
                    {{ $checkins->links() }}
                </div>
            </div>



        </div>
    </div>

@endsection
