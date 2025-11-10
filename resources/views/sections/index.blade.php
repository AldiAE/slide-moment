<x-default-layout>
    @section('title', $title)

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
            <a href="{{ route('sections.create') }}" class="btn btn-primary">Add New Section</a>
        </div>
        <div class="card-body">
            <table class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Page</th>
                        <th>Title</th>
                        <th>Link Title</th>
                        <th>Link URL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $section)
                        <tr>
                            <td>{{ $section->id }}</td>
                            <td>{{ $section->page->title ?? '-' }}</td>
                            <td>{{ $section->title ?? '-' }}</td>
                            <td>{{ $section->link_title ?? '-' }}</td>
                            <td>{{ $section->link_url ?? '-' }}</td>
                            <td>
                                <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this section?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-default-layout>
