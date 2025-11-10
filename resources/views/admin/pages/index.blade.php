<x-default-layout>
    @section('title', $title)

    @section('breadcrumbs')
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">{{ $title }}</li>
        </ul>
    @endsection

    @include('partials.general._notifications')

    <div class="card card-flush">
        <div class="card-header pt-6">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="card-toolbar">
                <a href="{{ route('pages.create') }}" class="btn btn-primary">+ Add Page</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                    @foreach ($pages as $page)
                        <tr>
                            <td>{{ $page->title }}</td>
                            <td>{{ $page->slug }}</td>
                            <td>
                                @if ($page->image)
                                    <img src="{{ asset('storage/' . $page->image) }}" width="70">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pages.edit', $page) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('pages.destroy', $page) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this page?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-default-layout>
