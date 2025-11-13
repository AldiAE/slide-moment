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
            <li class="breadcrumb-item text-dark">Headers</li>
        </ul>
    @endsection

    @include('partials.general._notifications')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title fw-bold text-dark">Header</h3>
            <a href="{{ route('headers.create') }}" class="btn btn-primary">+ Add New Header</a>
        </div>

        <div class="card-body">
            {{-- Search Form --}}
            <form method="GET" action="{{ route('headers.index') }}" class="mb-5 d-flex justify-content-end" role="search">
                <div class="input-group" style="max-width: 350px;">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Search headers..."
                    >
                    <button class="btn btn-outline btn-outline-primary" type="submit">Search</button>
                    @if(request('search'))
                        <a href="{{ route('headers.index') }}" class="btn btn-outline btn-outline-info ms-2">Reset</a>
                    @endif
                </div>
            </form>

            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Parent</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @forelse ($headers as $header)
                        <tr>
                            <td>{{ $header->parent?->title ?? '-' }}</td>
                            <td>{{ $header->title }}</td>
                            <td>{{ $header->slug }}</td>
                            <td class="text-end">
    <a href="{{ route('headers.edit', $header->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
    <form action="{{ route('headers.destroy', $header->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this header?')">
            Delete
        </button>
    </form>
</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No headers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        Showing {{ $headers->firstItem() ?? 0 }} to {{ $headers->lastItem() ?? 0 }} of {{ $headers->total() }} entries
                    </small>
                </div>
                <div>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item {{ $headers->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $headers->previousPageUrl() ?? '#' }}" tabindex="-1">Previous</a>
                            </li>
                            @for ($i = 1; $i <= $headers->lastPage(); $i++)
                                <li class="page-item {{ $i == $headers->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $headers->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ $headers->currentPage() == $headers->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $headers->nextPageUrl() ?? '#' }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</x-default-layout>
