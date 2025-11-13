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
                <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Add Category</a>
            </div>
        </div>

        <div class="card-body">
            {{-- Search Form --}}
            <form method="GET" action="{{ route('categories.index') }}" class="mb-5 d-flex justify-content-end" role="search">
                <div class="input-group" style="max-width: 350px;">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Search categories..."
                    >
                    <button class="btn btn-outline btn-outline-primary" type="submit">Search</button>
                    @if(request('search'))
                        <a href="{{ route('categories.index') }}" class="btn btn-outline btn-outline-info ms-2">Reset</a>
                    @endif
                </div>
            </form>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Title</th>
                        <th width="150">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                    @forelse ($categories as $category)
                        <tr>
                            <td>{{ $category->title }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No categories found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} entries
                    </small>
                </div>
                <div>
                    {{-- Force pagination buttons always visible --}}
                    <nav>
                        <ul class="pagination mb-0">
                            {{-- Previous --}}
                            <li class="page-item {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $categories->previousPageUrl() ?? '#' }}" tabindex="-1">Previous</a>
                            </li>

                            {{-- Page numbers --}}
                            @for ($i = 1; $i <= $categories->lastPage(); $i++)
                                <li class="page-item {{ $i == $categories->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Next --}}
                            <li class="page-item {{ $categories->currentPage() == $categories->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $categories->nextPageUrl() ?? '#' }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</x-default-layout>
