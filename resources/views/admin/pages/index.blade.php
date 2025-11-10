<x-default-layout>
    @section('title', $title)

    @section('breadcrumbs')
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">{{ $title }}</li>
        </ul>
    @endsection

    @include('partials.general._notifications')

    <div class="card card-flush">
        <div class="card-header pt-6 d-flex justify-content-between align-items-center">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="card-toolbar">
                <a href="{{ route('pages.create') }}" class="btn btn-primary">+ Add Page</a>
            </div>
        </div>

        <div class="card-body">
            {{-- Search Form --}}
            <form method="GET" action="{{ route('pages.index') }}" class="mb-5 d-flex justify-content-end" role="search">
                <div class="input-group" style="max-width: 350px;">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Search pages..."
                    >
                    <button class="btn btn-outline btn-outline-primary" type="submit">Search</button>
                    @if(request('search'))
                        <a href="{{ route('pages.index') }}" class="btn btn-outline btn-outline-info ms-2">Reset</a>
                    @endif
                </div>
            </form>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th width="150">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                    @forelse ($pages as $page)
                        <tr>
                            <td>{{ $page->title }}</td>
                            <td>{{ $page->slug }}</td>
                            <td>
                                @if ($page->image)
                                    <img src="{{ asset('storage/' . $page->image) }}" width="70" class="rounded">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pages.edit', $page) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                <form action="{{ route('pages.destroy', $page) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this page?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No pages found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        Showing {{ $pages->firstItem() ?? 0 }} to {{ $pages->lastItem() ?? 0 }} of {{ $pages->total() }} entries
                    </small>
                </div>
                <div>
                    {{-- Force pagination buttons always visible --}}
                    <nav>
                        <ul class="pagination mb-0">
                            {{-- Previous --}}
                            <li class="page-item {{ $pages->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $pages->previousPageUrl() ?? '#' }}" tabindex="-1">Previous</a>
                            </li>

                            {{-- Page numbers --}}
                            @for ($i = 1; $i <= $pages->lastPage(); $i++)
                                <li class="page-item {{ $i == $pages->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $pages->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Next --}}
                            <li class="page-item {{ $pages->currentPage() == $pages->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $pages->nextPageUrl() ?? '#' }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</x-default-layout>
