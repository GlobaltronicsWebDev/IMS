@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-2">Edit Check-in Item
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

                    <form action="{{ url('admin/checkins/'.$checkin->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

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
                                            <select name="location" class="form-control" value="{{old('location', $checkin->location)}}">
                                                <option value="" selected disabled>Select Location</option>
                                                <option value="Ortigas">Ortigas</option>
                                                <option value="A Juan">A Juan</option>
                                                <option value="Marikina">Marikina</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label>Check-in date</label>
                                            <input type="date" name="checkindate" class="form-control" value="{{old('checkindate', $checkin->checkindate)}}"/>
                                        </div>



                                <div class="mb-3">
                                    <label>Category</label>
                                    <input type="text" name="category" class="form-control" value="{{old('category', $checkin->category)}}"/>
                                </div>
                                <div class="mb-3">
                                    <label>Brand</label>
                                    <input type="text" name="brand" class="form-control" value="{{old('brand', $checkin->brand)}}" />
                                </div>

                                <div class="mb-3">
                                    <label>Product Code</label>
                                    <input type="text" name="productcode" class="form-control" value="{{old('productcode', $checkin->productcode)}}"/>
                                </div>

                                <div class="mb-3">
                                    <label>SKU</label>
                                    <input type="text" name="sku" class="form-control" value="{{old('sku', $checkin->sku)}}"/>
                                </div>
                                <div class="mb-3">
                                    <label>Model</label>
                                    <input type="text" name="model" class="form-control" value="{{old('model', $checkin->model)}}"/>
                                </div>

                                <div class="mb-3">
                                    <label>Item Description</label>
                                    <textarea name="itemdescription" class="form-control" rows="4" value="{{old('itemdescription', $checkin->itemdescription)}}"></textarea>

                                </div>
                                <div class="mb-3">
                                    <label>Quantity</label>
                                    <input type="text" name="quantity" class="form-control" value="{{old('quantity', $checkin->quantity)}}"/>
                                </div>


                                <div class="mb-3">
                                    <label>UOM</label>
                                    <select name="uom" class="form-control" value="{{old('uom', $checkin->uom)}}">
                                        <option value="" selected disabled>Select UOM</option>
                                        <option value="Units">Units</option>
                                        <option value="Panels">Panels</option>
                                        <option value="Pcs">Pcs</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control" >
                                    <option value="" selected disabled>Select status</option>
                                    <option value="Complete">Complete</option>
                                    <option value="Incomplete">Incomplete</option>
                                    <option value="{{old('status', $checkin->status)}}"></option>
                                </select>

                                </div>
                                <div class="mb-3">
                                    <label>Remarks</label>
                                    <textarea type="text" name="remarks" class="form-control" rows="4" value="{{old('remarks', $checkin->remarks)}}"></textarea>

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
