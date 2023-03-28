{{-- Create Modal --}}
<div class="modal fade" id="addCheckinModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Check-in Item/s</h3>
                <a class="btn" data-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ url('admin/checkins') }}" method="POST" enctype="multipart/form-data">
                    @csrf
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
                                <label for="checkindate">Checkin date</label>
                                <input type="date" required name="checkindate" id="checkindate"
                                    class="form-control" value="{{ old('checkindate', '') }}" />
                            </div>
                            <div class="col">
                                <label>PO No.</label>
                                <input type="text" name="ponumber" class="form-control" />
                            </div>
                            <div class="col">
                                <label>STR No.</label>
                                <input type="text" name="strnumber" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Category</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col">
                                <label>Brand</label>
                                <select name="brand"  class="form-control">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Product Code</label>
                                <input type="text" name="productcode" class="form-control" />
                            </div>

                            <div class="col">
                                <label>SKU</label>
                                <input type="text" name="sku" class="form-control" />
                            </div>

                            <div class="col">
                                <label>Model</label>
                                <input type="text" name="model" class="form-control" />
                            </div>
                            <div class="col">
                                <label>Serial No.</label>
                                <input type="text" name="serialnumber" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Item Description</label>
                                <textarea name="itemdescription" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Quantity</label>
                                <input type="number" name="quantity" class="form-control" />
                            </div>

                            <div class="col">
                                <label>UOM</label>
                                <select name="uom" class="form-control">
                                    <option value="" selected disabled>Select UOM</option>
                                    <option value="Units">Units</option>
                                    <option value="Panels">Panels</option>
                                    <option value="Pcs">Pcs</option>
                                </select>
                            </div>

                            <div class="col">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="" selected disabled>Select status</option>
                                    <option value="Complete">Complete</option>
                                    <option value="Incomplete">Incomplete</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-row">
                            <div class="col">
                                <label>Remarks</label>
                                <textarea type="text" name="remarks" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="py-2 float-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
