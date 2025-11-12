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
            <li class="breadcrumb-item text-dark">Create</li>
        </ul>
    @endsection

    @include('partials.general._notifications')

    <div class="card card-flush">
        <div class="card-header">
            <h3 class="card-title">Add New Row</h3>
        </div>

        <div class="card-body">
            {{-- ✅ Tambahkan enctype untuk upload --}}
            <form action="{{ route('rows.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-5">
                    <label class="form-label">Page</label>
                    <select name="page_id" id="page_id" class="form-select" required>
                        <option value="">-- Select Page --</option>
                        @foreach ($pages as $page)
                            <option value="{{ $page->id }}">{{ $page->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label class="form-label">Section</label>
                    <select name="section_id" id="section_id" class="form-select" required>
                        <option value="">-- Select Section --</option>

                    </select>
                </div>

                <div class="mb-5">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Row title">
                </div>

                <div class="mb-5">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="summernote" class="form-control" rows="6" placeholder="Enter description"></textarea>
                </div>

                <div class="mb-5">
                    <label class="form-label">Order</label>
                    <input type="number" name="order" class="form-control" placeholder="0">
                </div>

                {{-- ✅ Ubah bagian image menjadi upload seperti di Section --}}
                <div class="mb-5">
                    <label class="form-label">Upload Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*" />
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('rows.index') }}" class="btn btn-light me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Row</button>
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
        const pages = @json($pages); // kirim semua page+section ke JS
        const pageSelect = document.getElementById('page_id');
        const sectionSelect = document.getElementById('section_id');

        pageSelect.addEventListener('change', function () {
            const selectedPageId = parseInt(this.value);
            const page = pages.find(p => p.id === selectedPageId);

            sectionSelect.innerHTML = '<option value="">-- Select Section --</option>';

            if (page && page.sections.length > 0) {
                page.sections.forEach(section => {
                    const option = document.createElement('option');
                    option.value = section.id;
                    option.textContent = section.title;
                    sectionSelect.appendChild(option);
                });
            }
        });
    </script>
    @endpush
</x-default-layout>
