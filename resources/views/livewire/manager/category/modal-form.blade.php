 <!-- Add Category Modal -->
 <div wire:ignore.self class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h3 class="modal-title" id="exampleModalLabel">Add Category</h3>
                 <a wire:click="closeModal" class="btn" data-dismiss="modal" aria-label="Close"><i
                         class="bi bi-x-circle"></i></a>
             </div>
             <form wire:submit.prevent="storeCategory">
                 <div class="modal-body">
                     <div class="mb-3">
                         <label>Category Name</label>
                         <input type="text" wire:model.defer="name" class="form-control"
                             placeholder="Enter category name">
                         @error('name')
                             <small class="text-danger"> {{ $message }} </small>
                         @enderror
                     </div>
                 </div>

             </form>
         </div>
     </div>
 </div>

 <!-- Update Category Modal -->
 <div wire:ignore.self class="modal fade" id="updateCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h3 class="modal-title" id="exampleModalLabel">Update Category</h3>
                 <a wire:click="closeModal" class="btn" data-dismiss="modal" aria-label="Close"><i
                         class="bi bi-x-circle"></i></a>
             </div>
             <form wire:submit.prevent="updateCategory">
                 <div class="modal-body">
                     <div class="mb-3">
                         <label>Category Name</label>
                         <input type="text" wire:model.defer="name" class="form-control"
                             placeholder="Enter category name">
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

 {{-- Delete Modal --}}
 <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h3 class="modal-title fs-5" id="exampleModalLabel">Category Delete</h3>
                 <a class="btn-close" class="btn" data-dismiss="modal" aria-label="Close"></a>
             </div>
             <form wire:submit.prevent="destroyCategory">
                 <div class="modal-body">
                     <strong class="text-danger mb-2">Warning!</strong> This action is irreversible.
                     <h6>Are you sure you want to delete this cateogory?</h5>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-sm btn-primary">Yes. Delete</button>
                 </div>
             </form>

         </div>
     </div>
 </div>
