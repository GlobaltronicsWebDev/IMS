@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-2">Check-in Item
                        <a href="{{ url('admin/checkins') }}" class="btn btn-danger btn-sm text-white float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-warning">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ url('admin/checkins') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Navigation Tabs
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">Home</button>
                            </li>


                        </ul>
--}}
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                {{-- Home Tab Content

                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Select Brand</label>
                                    <select name="brand" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                --}}



                                        <div class="mb-3">
                                            <label>Location</label>
                                            <select name="location" class="form-control">
                                                <option value="" selected disabled>Select Location</option>
                                                <option value="Ortigas">Ortigas</option>
                                                <option value="A Juan">A Juan</option>
                                                <option value="Marikina">Marikina</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label>Check-in date</label>
                                            <input type="date" name="checkindate" class="form-control" />
                                        </div>

                                <div class="mb-3">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Brand</label>
                                    <select name="brand" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>                                </div>

                                <div class="mb-3">
                                    <label>Product Code</label>
                                    <input type="text" name="productcode" class="form-control" />
                                </div>

                                <div class="mb-3">
                                    <label>SKU</label>
                                    <input type="text" name="sku" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label>Model</label>
                                    <input type="text" name="model" class="form-control" />
                                </div>

                                <div class="mb-3">
                                    <label>Item Description</label>
                                    <textarea name="itemdescription" class="form-control" rows="4"></textarea>

                                </div>
                                <div class="mb-3">
                                    <label>Quantity</label>
                                    <input type="text" name="quantity" class="form-control" />
                                </div>


                                <div class="mb-3">
                                    <label>UOM</label>
                                    <select name="uom" class="form-control">
                                        <option value="" selected disabled>Select UOM</option>
                                        <option value="Units">Units</option>
                                        <option value="Panels">Panels</option>
                                        <option value="Pcs">Pcs</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                    <option value="" selected disabled>Select status</option>
                                    <option value="Complete">Complete</option>
                                    <option value="Incomplete">Incomplete</option>
                                </select>

                                </div>
                                <div class="mb-3">
                                    <label>Remarks</label>
                                    <textarea type="text" name="remarks" class="form-control" rows="4"></textarea>

                                </div>
                            </div>


                        </div>
                        <div class="py-2 float-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
