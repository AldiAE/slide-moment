<x-default-layout>
    @section('title', $title)

    @section('breadcrumbs')
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">
                <a href="#" class="text-muted text-hover-primary">Settings</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark">Add Header</li>
        </ul>
    @endsection

    @include('partials.general._notifications')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('headers.store') }}" method="POST">
                @csrf
                <div class="mb-10">
                    <label class="form-label">Parent Header</label>
                    <select name="parent_id" class="form-select">
                        <option value="">— None —</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-10">
                    <label class="form-label required">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter header title" required>
                </div>

                <div class="text-end">
                    <a href="{{ route('headers.index') }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-default-layout>
