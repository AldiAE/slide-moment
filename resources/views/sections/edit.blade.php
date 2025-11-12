<x-default-layout>
    @section('title')
        {{ $title ?? 'Edit Section' }}
    @endsection

    @include('partials.general._notifications')

    <div class="col-12">
        <div class="card card-flush h-md-100">
            <div class="card-header pt-8">
                <h3 class="card-title">{{ $title ?? 'Edit Section' }}</h3>
            </div>

            <div class="card-body pt-0">
                <form action="{{ route('sections.update', $section->id) }}" method="POST" class="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-10">
                        <label class="form-label required">Page</label>
                        <select name="page_id" class="form-select" required>
                            @foreach ($pages as $page)
                                <option value="{{ $page->id }}" {{ $page->id == $section->page_id ? 'selected' : '' }}>
                                    {{ $page->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" value="{{ $section->title }}" class="form-control" />
                    </div>

                    {{-- 🔽 Ubah bagian deskripsi menjadi Summernote (sama seperti Row Edit) --}}
                    <div class="mb-10">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="summernote" class="form-control" rows="6">{{ old('description', $section->description) }}</textarea>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Upload Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" />

                        @if ($section->image)
                            <div class="mt-3">
                                <p class="text-muted mb-1">Current Image:</p>
                                <img src="{{ asset('storage/' . $section->image) }}" width="120" class="rounded">
                            </div>
                        @endif
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Link Title</label>
                        <input type="text" name="link_title" value="{{ $section->link_title }}" class="form-control" />
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Link URL</label>
                        <input type="text" name="link_url" value="{{ $section->link_url }}" class="form-control" />
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('sections.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- Summernote CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#summernote').summernote({
                height: 200,
                placeholder: 'Enter detailed description...',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['fontsize', 'color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });
    </script>
    @endpush
</x-default-layout>
