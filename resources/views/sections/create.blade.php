<x-default-layout>
    @section('title', $title)

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Create Section</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('sections.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Page</label>
                    <select name="page_id" class="form-select" required>
                        <option value="">Select Page</option>
                        @foreach ($pages as $page)
                            <option value="{{ $page->id }}">{{ $page->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image URL</label>
                    <input type="text" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Link Title</label>
                    <input type="text" name="link_title" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Link URL</label>
                    <input type="text" name="link_url" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('sections.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</x-default-layout>
