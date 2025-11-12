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
                <a href="{{ route('sections.create') }}" class="btn btn-primary">+ Add Section</a>
            </div>
        </div>

        <div class="card-body">
            <form method="GET" action="{{ route('sections.index') }}" class="mb-5 d-flex justify-content-end" role="search">
                <div class="input-group" style="max-width: 350px;">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Search sections..."
                    >
                    <button class="btn btn-outline btn-outline-primary" type="submit">Search</button>
                    @if(request('search'))
                        <a href="{{ route('sections.index') }}" class="btn btn-outline btn-outline-info ms-2">Reset</a>
                    @endif
                </div>
            </form>

            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Page</th>
                        <th>Title</th>
                        <th>Link Title</th>
                        <th>Image</th>
                        <th width="150">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                    @forelse ($sections as $section)
                        <tr>
                            <td>{{ $section->page->title ?? '-' }}</td>
                            <td>{{ $section->title }}</td>
                            <td>{{ $section->link_title ?? '-' }}</td>
                            <td>
                                @if ($section->image)
                                    <img src="{{ asset('storage/' . $section->image) }}" width="70" class="rounded">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('sections.edit', $section) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                <form action="{{ route('sections.destroy', $section) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this section?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No sections found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        Showing {{ $sections->firstItem() ?? 0 }} to {{ $sections->lastItem() ?? 0 }} of {{ $sections->total() }} entries
                    </small>
                </div>
                <div>
                    <nav>
                        <ul class="pagination mb-0">
                            {{-- Previous --}}
                            <li class="page-item {{ $sections->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $sections->onFirstPage() ? '#' : $sections->previousPageUrl() }}" tabindex="-1">Previous</a>
                            </li>

                            {{-- Page numbers --}}
                            @for ($i = 1; $i <= $sections->lastPage(); $i++)
                                <li class="page-item {{ $i == $sections->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $sections->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Next --}}
                            <li class="page-item {{ $sections->currentPage() == $sections->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $sections->currentPage() == $sections->lastPage() ? '#' : $sections->nextPageUrl() }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</x-default-layout>
