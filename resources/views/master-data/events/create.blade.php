<x-default-layout>
    @section('title', $title)

    @section('breadcrumbs')
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{ route('events.index') }}" class="text-muted text-hover-primary">Pages</a>
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

        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <div class="card-body p-9">
                <div class="mb-10 fv-row">
                    <label class="form-label required">Categories</label>
                    <select name="category_ids[]" id="category_ids" class="form-select" multiple required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Tekan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu.</small>
                </div>

                <div class="mb-10 fv-row">
                    <label class="required form-label">Title</label>
                    <input type="text" name="title" class="form-control form-control-solid" placeholder="Enter title" value="{{ old('title') }}" required />
                    @error('title')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-10 fv-row">
                    <label class="required form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control form-control-solid" placeholder="Enter subtitle" value="{{ old('subtitle') }}" required />
                    @error('subtitle')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-10 fv-row">
                    <label class="form-label required">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control form-control-solid" accept="image/*" required/>
                    @error('thumbnail')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-10 fv-row">
                    <label class="form-label required">Background Image</label>
                    <input type="file" name="background" class="form-control form-control-solid" accept="image/*" required/>
                    @error('background')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-10 fv-row">
                    <label class="required form-label">Slug</label>
                    <input type="text" name="slug" class="form-control form-control-solid" placeholder="Enter slug" value="{{ old('slug') }}" required />
                    @error('slug')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-10 fv-row">
                    <label class="required form-label">Date</label>
                    <input type="date" name="date" class="form-control form-control-solid" placeholder="Enter date" value="{{ old('date') }}" required />
                    @error('date')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('events.index') }}" class="btn btn-light me-3">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Event</button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            KTUtil.onDOMContentLoaded(function() {
                $('#category_ids').select2({
                    placeholder: "Select Categories"
                });
            });
        </script>
    @endpush
</x-default-layout>
