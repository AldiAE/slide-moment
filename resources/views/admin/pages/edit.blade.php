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
            <li class="breadcrumb-item text-dark">Edit: {{ $page->title }}</li>
        </ul>
    @endsection

    @include('partials.general._notifications')

    <div class="card card-flush">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>

        <form action="{{ route('pages.update', $page->id) }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            @method('PUT')

            <div class="card-body p-9">
                <div class="mb-10 fv-row">
                    <label class="required form-label">Title</label>
                    <input type="text" name="title" class="form-control form-control-solid" value="{{ old('title', $page->title) }}" required />
                    @error('title')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-10 fv-row">
                    <label class="required form-label">Slug</label>
                    <input type="text" name="slug" class="form-control form-control-solid" value="{{ old('slug', $page->slug) }}" required />
                    @error('slug')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-10 fv-row">
                    <label class="form-label">Banner Image (optional)</label>
                    <div class="d-flex align-items-center mb-3">
                        @if ($page->image)
                            <img src="{{ asset('storage/' . $page->image) }}" alt="Banner" width="120" class="rounded me-4">
                        @else
                            <span class="text-muted">No image uploaded</span>
                        @endif
                    </div>
                    <input type="file" name="image" class="form-control form-control-solid" accept="image/*" />
                    @error('image')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('pages.index') }}" class="btn btn-light me-3">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Page</button>
            </div>
        </form>
    </div>
</x-default-layout>
