<x-default-layout>
    @section('title', $title)

    @section('breadcrumbs')
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{ route('rows.index') }}" class="text-muted text-hover-primary">Rows</a>
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
            <h3 class="card-title">Edit Row</h3>
        </div>

        <div class="card-body">
            {{-- ✅ Tambahkan enctype untuk upload file --}}
            <form action="{{ route('rows.update', $row->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-5">
                    <label class="form-label">Page</label>
                    <select name="page_id" id="page_id" class="form-select" required>
                        <option value="">-- Select Page --</option>
                        @foreach ($pages as $page)
                            <option value="{{ $page->id }}" {{ $page->id == $row->page_id ? 'selected' : '' }}>
                                {{ $page->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label class="form-label">Section</label>
                    <select name="section_id" id="section_id" class="form-select" required>

                    </select>
                </div>

                <div class="mb-5">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $row->title) }}">
                </div>

                <div class="mb-5">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="summernote" class="form-control" rows="6">{{ old('description', $row->description) }}</textarea>
                </div>

                <div class="mb-5">
                    <label class="form-label">Order</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $row->order) }}">
                </div>

                {{-- ✅ Ganti bagian image jadi upload file + preview seperti Section --}}
                <div class="mb-5">
                    <label class="form-label">Upload Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*" />

                    @if ($row->image)
                        <div class="mt-3">
                            <p class="text-muted mb-1">Current Image:</p>
                            <img src="{{ asset('storage/' . $row->image) }}" width="120" class="rounded">
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('rows.index') }}" class="btn btn-light me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Row</button>
                </div>
            </form>
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

        const pages = @json($pages);
        const pageSelect = document.getElementById('page_id');
        const sectionSelect = document.getElementById('section_id');
        const selectedPageId = parseInt("{{ $row->page_id }}");
        const selectedSectionId = parseInt("{{ $row->section_id }}");

        function populateSections(pageId, selectedSection = null) {
            const page = pages.find(p => p.id === pageId);
            sectionSelect.innerHTML = '<option value="">-- Select Section --</option>';

            if (page && page.sections.length > 0) {
                page.sections.forEach(section => {
                    const option = document.createElement('option');
                    option.value = section.id;
                    option.textContent = section.title;
                    if (selectedSection && section.id === selectedSection) {
                        option.selected = true;
                    }
                    sectionSelect.appendChild(option);
                });
            }
        }

        if (selectedPageId) {
            populateSections(selectedPageId, selectedSectionId);
        }

        pageSelect.addEventListener('change', function () {
            populateSections(parseInt(this.value));
        });
    </script>
    @endpush

</x-default-layout>
