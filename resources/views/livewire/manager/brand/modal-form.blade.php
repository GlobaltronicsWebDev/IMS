
    <!-- Add Brand Modal -->
    <div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Add Brand</h3>
                    <a wire:click="closeModal" class="btn"  data-dismiss="modal"
                        aria-label="Close"><i class="bi bi-x-circle"></i></a>
                </div>
                <form wire:submit.prevent="storeBrand">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Select Category</label>
                            <select wire:model.defer="category_id" recquired class="form-control">
                                <option value="">--Select Category--</option>
                                @foreach ($categories as $cateItem)
                                <option value="{{ $cateItem->id }}">{{ $cateItem->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Brand Name</label>
                            <input type="text" wire:model.defer="name" class="form-control" placeholder="Enter brand name">
                            @error('name')
                                <small class="text-danger"> {{ $message }} </small>
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

    <!-- Update Brand Modal -->
    <div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Update Brand</h3>
                    <a type="button" wire:click="closeModal" class="btn" data-dismiss="modal"
                        aria-label="Close"><i class="bi bi-x-circle"></i></a>
                </div>


                    <form wire:submit.prevent="updateBrand">
                        <div class="modal-body">
                        <div class="mb-3">
                            <label>Select Category</label>
                            <select wire:model.defer="category_id" recquired class="form-control">
                                <option value="">--Select Category--</option>
                                @foreach ($categories as $cateItem)
                                <option value="{{ $cateItem->id }}">{{ $cateItem->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>
                            <div class="mb-3">
                                <label>Brand Name</label>
                                <input type="text" wire:model.defer="name" class="form-control" placeholder="Enter brand name">
                                @error('name')
                                    <small class="text-danger"> {{ $message }} </small>
                                @enderror
                            </div>




                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="closeModal" class="btn btn-sm btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Delete Brand Modal -->
    <div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Delete Brand</h3>
                    <a type="button" wire:click="closeModal" class="btn" data-dismiss="modal"
                        aria-label="Close"><i class="bi bi-x-circle"></i></a>
                </div>


                    <form wire:submit.prevent="destroyBrand">
                        <div class="modal-body">
                            <strong class="text-danger mb-2">Warning!</strong> This action is irreversible.
                            <h5>Are you sure you want to delete this brand?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" wire:click="closeModal" class="btn btn-sm btn-secondary"
                                data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-danger">Yes</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
