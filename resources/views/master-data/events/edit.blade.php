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
            <li class="breadcrumb-item text-dark">Edit</li>
        </ul>
    @endsection

    @include('partials.general._notifications')

    <div class="card card-flush">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
        </div>

        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            @method('PUT')

            <div class="card-body p-9">
                {{-- Categories --}}
                <div class="mb-10 fv-row">
                    <label class="form-label required">Categories</label>
                    <select
                        name="category_ids[]"
                        id="category_ids"
                        class="form-select"
                        data-control="select2"
                        data-placeholder="Select Categories"
                        multiple
                        required
                    >
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ in_array($category->id, old('category_ids', $event->categories->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_ids')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Title --}}
                <div class="mb-10 fv-row">
                    <label class="required form-label">Title</label>
                    <input type="text" name="title" class="form-control form-control-solid" placeholder="Enter title"
                           value="{{ old('title', $event->title) }}" required />
                    @error('title')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Subtitle --}}
                <div class="mb-10 fv-row">
                    <label class="required form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control form-control-solid" placeholder="Enter subtitle"
                           value="{{ old('subtitle', $event->subtitle) }}" required />
                    @error('subtitle')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Thumbnail --}}
                <div class="mb-10 fv-row">
                    <label class="form-label required">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control form-control-solid" accept="image/*" />
                    @if ($event->thumbnail)
                        <div class="mt-3">
                            <img src="{{ asset('storage/'.$event->thumbnail) }}" alt="Thumbnail" width="120" class="rounded border">
                        </div>
                    @endif
                    @error('thumbnail')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Background --}}
                <div class="mb-10 fv-row">
                    <label class="form-label required">Background Image</label>
                    <input type="file" name="background" class="form-control form-control-solid" accept="image/*" />
                    @if ($event->background)
                        <div class="mt-3">
                            <img src="{{ asset('storage/'.$event->background) }}" alt="Background" width="120" class="rounded border">
                        </div>
                    @endif
                    @error('background')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Slug --}}
                <div class="mb-10 fv-row">
                    <label class="required form-label">Slug</label>
                    <input type="text" name="slug" class="form-control form-control-solid" placeholder="Enter slug"
                           value="{{ old('slug', $event->slug) }}" required />
                    @error('slug')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Date --}}
                <div class="mb-10 fv-row">
                    <label class="required form-label">Date</label>
                    <input type="date" name="date" class="form-control form-control-solid"
                           value="{{ old('date', $event->date) }}" required />
                    @error('date')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Footer --}}
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('events.index') }}" class="btn btn-light me-3">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Event</button>
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
