<div>
    @section('title', 'Brands')

    @include('livewire.admin.brand.modal-form')
    {{-- <div id="loader" class="center"></div> --}}
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
                    <h3>
                        Brands
                        <a class="btn btn-primary shadow-none btn-sm float-right" data-toggle="modal"
                            data-target="#addBrandModal">Add Brands</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)
                                <tr>
                                    <td>{{ $brand->id }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td>
                                        @if ($brand->category)
                                            {{ $brand->category->name }}
                                        @else
                                            No Category
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" wire:click="editBrand({{ $brand->id }})"
                                            data-toggle="modal" data-target="#updateBrandModal"
                                            class="btn btn-sm btn-warning" title="Edit brand"> <i class="bi bi-pencil-square"></i></a>
                                        <a href="#" wire:click="deleteBrand({{ $brand->id }})"
                                            data-toggle="modal" data-target="#deleteBrandModal"
                                            class="btn btn-sm btn-danger" title="Delete brand"><i class="bi bi-trash3-fill"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No Brands Found</td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <div>
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        window.addEventListener('close-modal', event => {

            $('#addBrandModal').modal('hide');
            $('#updateBrandModal').modal('hide');
            $('#deleteBrandModal').modal('hide');

        });
    </script>
@endpush
