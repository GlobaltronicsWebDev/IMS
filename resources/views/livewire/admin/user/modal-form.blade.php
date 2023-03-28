 <!-- Add Category Modal -->
 <div wire:ignore.self class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h3 class="modal-title" id="exampleModalLabel">Add User</h3>
                 <a wire:click="closeModal" class="btn" data-dismiss="modal" aria-label="Close"><i
                         class="bi bi-x-circle"></i></a>
             </div>
             <form wire:submit.prevent="storeUser">
                 <div class="modal-body">
                     <div class="mb-3">
                         <label>Name</label>
                         <input type="text" wire:model.defer="name" class="form-control" placeholder="Enter name">
                         @error('name')
                             <small class="text-danger"> {{ $message }} </small>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label>Email</label>
                         <input type="email" wire:model.defer="email" class="form-control"
                             placeholder="email@globaltronics.net">
                         @error('email')
                             <small class="text-danger"> {{ $message }} </small>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label>Password</label>
                         <input type="password" wire:model.defer="password" class="form-control"
                             placeholder="Enter password">
                         @error('password')
                             <small class="text-danger"> {{ $message }} </small>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label>Select Role</label>
                         <select wire:model.defer="role_as" recquired class="form-control">
                             <option value="">--Select Role--</option>
                             <option value="0">User</option>
                             <option value="3">Manager</option>
                             <option value="1">Admin</option>
                         </select>
                         @error('role_as')
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
                 <h3 class="modal-title fs-5" id="exampleModalLabel">User Delete</h3>
                 <a class="btn-close" class="btn" data-dismiss="modal" aria-label="Close"></a>
             </div>
             <form wire:submit.prevent="destroyUser">
                 <div class="modal-body">
                     <strong class="text-danger mb-2">Warning!</strong> This action is irreversible.
                     <h6>Are you sure you want to delete this user?</h5>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-sm btn-primary">Yes. Delete</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <!-- Update Brand Modal -->
 <div wire:ignore.self class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h3 class="modal-title fs-5" id="exampleModalLabel">Update User</h3>
                 <a type="button" wire:click="closeModal" class="btn" data-dismiss="modal" aria-label="Close"><i
                         class="bi bi-x-circle"></i></a>
             </div>
             <form wire:submit.prevent="updateUser">
                 <div class="modal-body">

                     {{-- Name --}}
                     <div class="mb-3">
                         <label>Name</label>
                         <input type="text" wire:model.defer="name" class="form-control" placeholder="Enter name"
                             readonly>
                         @error('name')
                             <small class="text-danger"> {{ $message }} </small>
                         @enderror
                     </div>

                     {{-- Email --}}
                     <div class="mb-3">
                         <label>Email</label>
                         <input type="text" wire:model.defer="email" class="form-control"
                             placeholder="john.doe@globaltronics.net" readonly>
                         @error('email')
                             <small class="text-danger"> {{ $message }} </small>
                         @enderror
                     </div>

                     {{-- Password --}}
                     <div class="mb-3">
                         <label>Password</label>
                         <input type="password" wire:model.defer="password" class="form-control"
                             placeholder="Enter password name" readonly>
                         @error('password')
                             <small class="text-danger"> {{ $message }} </small>
                         @enderror
                     </div>

                     <div class="mb-3">
                         <label>Select Role</label>
                         <select wire:model.defer="role_as" recquired class="form-control">
                             <option value="">--Select Role--</option>
                             <option value="0">User</option>
                             <option value="1">Admin</option>
                         </select>
                         @error('role_as')
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
