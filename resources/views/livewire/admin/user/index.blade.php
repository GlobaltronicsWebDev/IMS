<div>
    @include('livewire.admin.user.modal-form')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
            @endif
            <div class="card mb-5">
                <div class="card-header">
                    <h3>Users
                        <a href="#" class="btn btn-primary btn-sm shadow-none float-right" data-toggle="modal"
                            data-target="#addUserModal">Add User</a>
                        {{-- <a href="{{ url('admin/users/create') }}" class="btn btn-primary btn-sm float-right">
                            Add User
                        </a> --}}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <form action="{{ route('users.search') }}" method="GET" role="search">
                            <div class="form-row float-right mb-2 mr-1">
                                <div class="input-group" style="max-width:18rem;">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary" type="submit" title="Search users"
                                            id="button-addon1"><i class="fas fa-search"></i></button>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Search users" name="term"
                                        id="term" aria-label="Search field" aria-describedby="button-addon1">
                                    <div class="input-group-append">
                                        <a class="btn btn-danger" type="button" title="Refresh page"
                                            href="{{ url('admin/users') }}"><i class="fas fa-sync-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table  table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->role_as == '0')
                                                <label class="badge rounded btn-primary"> User</label>
                                            @elseif ($user->role_as == '1')
                                                <label class="badge rounded btn-warning"> Admin</label>
                                            @elseif ($user->role_as == '3')
                                                <label class="badge rounded btn-info"> Manager</label>
                                            @else
                                                <label class="badge btn-secondary">None</label>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" wire:click="editUser({{ $user->id }})"
                                                data-toggle="modal" data-target="#updateUserModal"
                                                class="btn btn-sm btn-warning" title="Edit user">
                                                <i class="bi bi-pencil-square"></i></a>
                                            @php
                                                $currentUserId = Auth::user()->id;
                                            @endphp
                                            <button href="#" wire:click="deleteUser({{ $user->id }})"
                                                data-toggle="modal" data-target="#deleteModal"
                                                class="btn btn-sm btn-danger" title="Delete user"
                                                @if ($user->id === $currentUserId) disabled @endif><i
                                                    class="bi bi-trash3-fill"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No Users Available</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>

                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('close-modal', event => {

            $('#addUserModal').modal('hide');
            $('#updateUserModal').modal('hide');
            $('#deleteModal').modal('hide');

        });
    </script>
@endpush
