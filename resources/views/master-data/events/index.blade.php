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
                <a href="{{ route('events.create') }}" class="btn btn-primary">+ Add Event</a>
            </div>
        </div>

        <div class="card-body">
            {{-- Search Form --}}
            <form method="GET" action="{{ route('events.index') }}" class="mb-5 d-flex justify-content-end" role="search">
                <div class="input-group" style="max-width: 350px;">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Search events..."
                    >
                    <button class="btn btn-outline btn-outline-primary" type="submit">Search</button>
                    @if(request('search'))
                        <a href="{{ route('events.index') }}" class="btn btn-outline btn-outline-info ms-2">Reset</a>
                    @endif
                </div>
            </form>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Thumbnail</th>
                        <th>Slug</th>
                        <th>Date</th>
                        <th width="150">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-semibold">
                    @forelse ($events as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->subtitle }}</td>
                            <td><img src="{{ asset('storage/'.$event->thumbnail) }}" width="70" class="rounded" /></td>
                            <td>{{ $event->slug }}</td>
                            <td>{{ $event->date }}</td>
                            <td>
                                <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('events.gallery', $event) }}" class="btn btn-sm btn-info">Gallery</a>
                                <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger mt-2" onclick="return confirm('Delete this event?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No events found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        Showing {{ $events->firstItem() ?? 0 }} to {{ $events->lastItem() ?? 0 }} of {{ $events->total() }} entries
                    </small>
                </div>
                <div>
                    {{-- Force pagination buttons always visible --}}
                    <nav>
                        <ul class="pagination mb-0">
                            {{-- Previous --}}
                            <li class="page-item {{ $events->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $events->previousPageUrl() ?? '#' }}" tabindex="-1">Previous</a>
                            </li>

                            {{-- Page numbers --}}
                            @for ($i = 1; $i <= $events->lastPage(); $i++)
                                <li class="page-item {{ $i == $events->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $events->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            {{-- Next --}}
                            <li class="page-item {{ $events->currentPage() == $events->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $events->nextPageUrl() ?? '#' }}">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</x-default-layout>
