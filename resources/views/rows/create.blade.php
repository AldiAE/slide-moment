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
            <form action="{{ route('rows.store') }}" method="POST">
                @csrf

                <div class="mb-5">
                    <label class="form-label">Page</label>
                    <select name="page_id" class="form-select" required>
                        <option value="">-- Select Page --</option>
                        @foreach ($pages as $page)
                            <option value="{{ $page->id }}">{{ $page->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label class="form-label">Section</label>
                    <select name="section_id" class="form-select" required>
                        <option value="">-- Select Section --</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Row title">
                </div>

                <div class="mb-5">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Enter description"></textarea>
                </div>

                <div class="mb-5">
                    <label class="form-label">Order</label>
                    <input type="number" name="order" class="form-control" placeholder="0">
                </div>

                <div class="mb-5">
                    <label class="form-label">Image (URL or path)</label>
                    <input type="text" name="image" class="form-control" placeholder="image.jpg or uploads/row.jpg">
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('rows.index') }}" class="btn btn-light me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Row</button>
                </div>
            </form>
        </div>
    </div>
</x-default-layout>
