@extends('layouts.admin')


@section('content')


<link rel="icon" type="image/png" href="{{ asset('/uploads/logofinal.png') }}" />

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>



    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
        rel="stylesheet" />




</head>



<div class="py-12 w-full mr-6">


    <div class="max-w-screen-2xl mx-auto py-10 sm:px-6 lg:px-8">





<body>

        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="px-4 py-5 bg-white sm:p-6">

                        <div class="card-header">
                            <h3>EDIT STOCKOUT</h3>
                        </div>

                    <form action="{{ url('admin/orders/'.$order_item->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <ul>

                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>

                            </div>

                        @endif



                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">

                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                                <p>{{ Session::get('success') }}</p>

                            </div>
                        @endif




                        <div class="row">
                            <div class="col">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="location"
                                        class="block font-medium text-sm text-gray-700">Location</label>
                                    <select name="location" id="location"
                                        class="form-multiselect block rounded-md shadow-sm mt-1 block w-full">
                                        <option value="" selected disabled>Select Location</option>
                                        <option value="Ortigas">Ortigas</option>
                                        <option value="A Juan">A Juan</option>
                                        <option value="Marikina">Marikina</option>
                                    </select>
                                    @error('location')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>
                            <div class="col">

                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="checkoutdate" class="block font-medium text-sm text-gray-700">Checkout date</label>
                                    <input type="date" name="checkoutdate" id="checkoutdate"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full"
                                        value="{{ old('checkoutdate', '') }}" />
                                    @error('checkoutdate')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="client" class="block font-medium text-sm text-gray-700">Client</label>
                                    <input type="text" name="client" id="client"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full"
                                        value="{{ old('client', '') }}" />
                                    @error('client')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">

                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="stonumber" class="block font-medium text-sm text-gray-700">STO No.</label>
                                    <input type="text" name="stonumber" id="stonumber"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full"
                                        value="{{ old('stonumber', '') }}" />
                                    @error('stonumber')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="col">

                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="srfnumber" class="block font-medium text-sm text-gray-700">SRF No.</label>
                                    <input type="text" name="srfnumber" id="srfnumber"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full"
                                        value="{{ old('srfnumber', '') }}" />
                                    @error('srfnumber')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="sku" class="block font-medium text-sm text-gray-700">SKU</label>
                                    <input type="text" name="sku" id="sku"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full"
                                        value="{{ old('sku', '') }}" />
                                    @error('sku')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="productcode" class="block font-medium text-sm text-gray-700">Product Code</label>
                                    <input type="text" name="productcode" id="productcode"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full"
                                        value="{{ old('productcode', '') }}" />
                                    @error('productcode')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="model" class="block font-medium text-sm text-gray-700">Model</label>
                                    <input type="text" name="model" id="model"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full"
                                        value="{{ old('model', '') }}" />
                                    @error('model')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="uom" class="block font-medium text-sm text-gray-700">UOM</label>
                                    <input type="text" name="uom" id="uom"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full"
                                        value="{{ old('uom', '') }}" />
                                    @error('uom')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="itemdescription" class="block font-medium text-sm text-gray-700">Item Description</label>
                                    <input type="text" name="itemdescription" id="itemdescription"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full"
                                        value="{{ old('itemdescription', '') }}" />
                                    @error('itemdescription')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="serialnumber" class="block font-medium text-sm text-gray-700">Serial No.</label>
                                    <input type="text" name="serialnumber" id="serialnumber"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full"
                                        value="{{ old('serialnumber', '') }}" />
                                    @error('serialnumber')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <label for="quantity" class="block font-medium text-sm text-gray-700">Quantity</label>
                                    <input type="text" name="quantity" id="quantity"
                                        class="form-input rounded-md shadow-sm mt-1 block w-full"
                                        value="{{ old('quantity', '') }}" />
                                    @error('quantity')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                        </div>


                        <button type="submit" class="btn btn-success"
                            style="background-color:  #4D83FF; color: white; margin-top:15px; border-color: #4D83FF;">Save</button>
                    </form>


                </div>
            </div>
            </div>
        </div>

    </div>
</div>

{{---<td><input type="text" name="addmore['+i+'][stockout_id]" placeholder="StockoutID" class="form-control"/></td>---}}

<script type="text/javascript">
    var i = 0;



    $("#add").click(function() {
        ++i;

        $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][sku]" placeholder="SKU" class="form-control"/></td><td><input type="text" name="addmore['+i+'][productcode]" placeholder="Product Code" class="form-control"/></td><td><input type="text" name="addmore['+i+'][model]" placeholder="Model" class="form-control"/></td><td><input type="text" name="addmore['+i+'][quantity]" placeholder="Quantity" class="form-control"/></td><td><select name="addmore['+i+'][uom]" class="form-control"><option value="Units">Unit/s</option><option value="Panels">Panel/s</option><option value="Pcs">Pc/s</option></select></td><td><input type="text" name="addmore['+i+'][itemdescription]" placeholder="Item Description" class="form-control"/></td><td><input type="text" name="addmore['+i+'][serialnumber]" placeholder="Serial No." class="form-control"/></td><td><button type="button" class="btn btn-danger remove-tr" style="background-color: red; color: white;">-</button></td></tr>'
            );
    });



    $(document).on('click', '.remove-tr', function() {
        $(this).parents('tr').remove();
    });
</script>

</body>

@endsection



