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
            <li class="breadcrumb-item text-dark">Footers</li>
        </ul>
    @endsection

    @include('partials.general._notifications')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title fw-bold text-dark">Footer</h3>
            <a href="{{ route('footers.create') }}" class="btn btn-primary">+ Add Footer</a>
        </div>

        <div class="card-body">
            {{-- Search Form --}}
            <form method="GET" action="{{ route('footers.index') }}" class="mb-5 d-flex justify-content-end" role="search">
                <div class="input-group" style="max-width: 350px;">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Search footers..."
                    >
                    <button class="btn btn-outline btn-outline-primary" type="submit">Search</button>
                    @if(request('search'))
                        <a href="{{ route('footers.index') }}" class="btn btn-outline btn-outline-info ms-2">Reset</a>
                    @endif
                </div>
            </form>

            {{-- Table --}}
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Description</th>
                        <th>Socials</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @forelse ($footers as $footer)
                        <tr>
                            <td>{{ Str::limit($footer->description, 80) }}</td>
                            <td>
    @if($footer->socials)
        @foreach($footer->socials as $key => $value)
            <a href="{{ $value }}" target="_blank">{{ $key }}</a>@if(!$loop->last), @endif
        @endforeach
    @else
        <span class="text-muted">No socials</span>
    @endif
</td>

                            <<td class="text-end">
    <a href="{{ route('footers.edit', $footer->id) }}" class="btn btn-sm btn-warning me-1">Edit</a>
    <form action="{{ route('footers.destroy', $footer->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this footer?')">
            Delete
        </button>
    </form>
</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No footers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        Showing {{ $footers->firstItem() ?? 0 }} to {{ $footers->lastItem() ?? 0 }} of {{ $footers->total() }} entries
                    </small>
                </div>
                <div>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item {{ $footers->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $footers->previousPageUrl() ?? '#' }}" tabindex="-1">Previous</a>
                            </li>

                            @for ($i = 1; $i <= $footers->lastPage(); $i++)
                                <li class="page-item {{ $i == $footers->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $footers->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            <li class="page-item {{ $footers->currentPage() == $footers->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $footers->nextPageUrl() ?? '#' }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>
