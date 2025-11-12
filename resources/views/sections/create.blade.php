<x-default-layout>
    @section('title')
        {{ $title ?? 'Create Section' }}
    @endsection

    @include('partials.general._notifications')

    <div class="col-12">
        <div class="card card-flush h-md-100">
            <div class="card-header pt-8">
                <h3 class="card-title">{{ $title ?? 'Create Section' }}</h3>
            </div>

            <div class="card-body pt-0">
                <form action="{{ route('sections.store') }}" method="POST" class="form" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-10">
                        <label class="form-label required">Page</label>
                        <select name="page_id" class="form-select" required>
                            <option value="">Select Page</option>
                            @foreach ($pages as $page)
                                <option value="{{ $page->id }}">{{ $page->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter section title" />
                    </div>

                    {{-- 🔽 Ubah bagian deskripsi menjadi Summernote (sesuai Row Create) --}}
                    <div class="mb-10">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="summernote" class="form-control" rows="6" placeholder="Enter description"></textarea>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Upload Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" />
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Link Title</label>
                        <input type="text" name="link_title" class="form-control" placeholder="e.g., Learn More" />
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Link URL</label>
                        <input type="text" name="link_url" class="form-control" placeholder="https://..." />
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save</button>
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
