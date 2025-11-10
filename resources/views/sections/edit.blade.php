<x-default-layout>
    @section('title', $title)

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Section</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('sections.update', $section->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Page</label>
                    <select name="page_id" class="form-select" required>
                        @foreach ($pages as $page)
                            <option value="{{ $page->id }}" {{ $page->id == $section->page_id ? 'selected' : '' }}>{{ $page->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" value="{{ $section->title }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control">{{ $section->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Image URL</label>
                    <input type="text" name="image" value="{{ $section->image }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Link Title</label>
                    <input type="text" name="link_title" value="{{ $section->link_title }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Link URL</label>
                    <input type="text" name="link_url" value="{{ $section->link_url }}" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('sections.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</x-default-layout>
