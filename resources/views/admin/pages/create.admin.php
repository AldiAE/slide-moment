<x-default-layout>
    @section('title', $title)

    @section('breadcrumbs')
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{ route('pages.index') }}" class="text-muted text-hover-primary">Pages</a>
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

        <form action="{{ route('pages.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <div class="card-body p-9">
                <div class="mb-10 fv-row">
                    <label class="required form-label">Title</label>
                    <input type="text" name="title" class="form-control form-control-solid" placeholder="Enter page title" value="{{ old('title') }}" required />
                    @error('title')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-10 fv-row">
                    <label class="required form-label">Slug</label>
                    <input type="text" name="slug" class="form-control form-control-solid" placeholder="e.g. home" value="{{ old('slug') }}" required />
                    @error('slug')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-10 fv-row">
                    <label class="form-label">Banner Image (optional)</label>
                    <input type="file" name="image" class="form-control form-control-solid" accept="image/*" />
                    @error('image')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('pages.index') }}" class="btn btn-light me-3">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Page</button>
            </div>
        </form>
    </div>
</x-default-layout>
