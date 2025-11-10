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
                <form action="{{ route('sections.store') }}" method="POST" class="form">
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

                    <div class="mb-10">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter section description"></textarea>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Image URL</label>
                        <input type="text" name="image" class="form-control" placeholder="https://..." />
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
</x-default-layout>
