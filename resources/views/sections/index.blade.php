<x-default-layout>
    @section('title')
        {{ $title ?? 'Sections' }}
    @endsection

    @section('breadcrumbs')
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            @if (empty($sub_title))
                <li class="breadcrumb-item text-muted">{{ $title ?? 'Sections' }}</li>
            @else
                <li class="breadcrumb-item text-muted">
                    <a href="#" class="text-muted text-hover-primary">{{ $title ?? 'Sections' }}</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-dark">{{ $sub_title }}</li>
            @endif
        </ul>
    @endsection

    @include('partials.general._notifications')

    <div class="col-12">
        <div class="card card-flush h-md-100">
            <div class="card-header pt-8">
                <h3 class="card-title">{{ $title ?? 'Sections' }}</h3>
                <a href="{{ route('sections.create') }}" class="btn btn-primary">Add Section</a>
            </div>

            <div class="card-body pt-0">
                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th>Title</th>
                            <th>Page</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $section)
                            <tr>
                                <td>{{ $section->title }}</td>
                                <td>{{ $section->page->title ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('sections.destroy', $section->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-default-layout>
