<x-default-layout>
    @section('title', $title)

    @section('breadcrumbs')
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">{{ $title }}</li>
        </ul>
    @endsection

    @include('partials.general._notifications')

    <div class="card card-flush">
        <div class="card-header pt-6">
            <h3 class="card-title">{{ $title }}</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('sections.update', $section) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label class="form-label fw-semibold">Select Page</label>
                    <select name="page_id" class="form-select" required>
                        @foreach ($pages as $page)
                            <option value="{{ $page->id }}" {{ $section->page_id == $page->id ? 'selected' : '' }}>
                                {{ $page->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label class="form-label fw-semibold">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $section->title }}">
                </div>

                <div class="mb-5">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control summernote">{{ $section->description }}</textarea>
                </div>

                <div class="mb-5">
                    <label class="form-label fw-semibold">Link Title</label>
                    <input type="text" name="link_title" class="form-control" value="{{ $section->link_title }}">
                </div>

                <div class="mb-5">
                    <label class="form-label fw-semibold">Link URL</label>
                    <input type="text" name="link_url" class="form-control" value="{{ $section->link_url }}">
                </div>

                <div class="mb-5">
                    <label class="form-label fw-semibold">Image</label><br>
                    @if ($section->image)
                        <img src="{{ asset('storage/' . $section->image) }}" width="100" class="rounded mb-2"><br>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Update Section</button>
                <a href="{{ route('sections.index') }}" class="btn btn-light">Cancel</a>
            </form>
        </div>
    </div>
</x-default-layout>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
        });
    });
</script>
@endpush
