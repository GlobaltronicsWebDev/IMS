<div>
    @include('livewire.admin.category.modal-form')
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
                    <h3>Categories
                        <a href="#" class="btn btn-primary btn-sm shadow-none float-right" data-toggle="modal"
                            data-target="#addCategoryModal">Add Category</a>
                        {{-- <a href="{{ url('admin/category/create') }}"
                            class="btn btn-primary btn-sm shadow-none float-right">Add Category</a> --}}
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="#" wire:click="editCategory({{ $category->id }})"
                                            data-toggle="modal" data-target="#updateCategoryModal"
                                            class="btn btn-sm btn-warning" title="Edit category">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <a href="#" wire:click="deleteCategory({{ $category->id }})"
                                            data-toggle="modal" data-target="#deleteModal"
                                            class="btn btn-danger shadow-none btn-sm" title="Delete category"><i class="bi bi-trash3-fill"></i></a>
                                        {{-- <a href="{{ url('admin/category/' . $category->id . '/delete') }}"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"
                                            class="btn btn-danger shadow-none btn-sm"
                                            onclick="return confirm('Are you sure, you want to delete this Category?')"
                                            class="btn  btn-sm btn-danger">
                                            Delete</a> --}}
                                        {{-- <button data-toggle="modal" data-target="#deleteCategoryModal" class="btn btn-danger shadow-none btn-sm">Delete</button> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No Categories Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" tabindex="-1" role="dialog" id="deleteCategoryModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this category? This action is irreversible.</p>
            </div>
            <div class="modal-footer">
                {{-- <a href="{{ url('admin/category/' . $category->id . '/delete') }}" class="btn btn-danger">Delete</a> --}}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('close-modal', event => {

            $('#addCategoryModal').modal('hide');
            $('#updateCategoryModal').modal('hide');
            $('#deleteModal').modal('hide');

        });
    </script>
@endpush
