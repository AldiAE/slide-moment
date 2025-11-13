<x-default-layout>
    @section('title', $title)

    @section('breadcrumbs')
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{ route('categories.index') }}" class="text-muted text-hover-primary">categories</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark">Create</li>
        </ul>
    @endsection

    @include('partials.general._notifications')

    <div class="card card-flush">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>

        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <div class="card-body p-9">
                <div class="mb-10 fv-row">
                    <label class="required form-label">Title</label>
                    <input type="text" name="title" class="form-control form-control-solid" placeholder="Enter category title" value="{{ old('title') }}" required />
                    @error('title')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('categories.index') }}" class="btn btn-light me-3">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Category</button>
            </div>
        </form>
    </div>
</x-default-layout>
