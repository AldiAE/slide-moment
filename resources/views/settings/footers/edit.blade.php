<x-default-layout>
    @section('title', $title)

    @include('partials.general._notifications')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('footers.update', $footer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-10">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ $footer->description }}</textarea>
                </div>

                <div class="mb-10">
                    <label class="form-label">Socials (JSON format)</label>
                    <textarea name="socials" class="form-control" rows="4">{{ json_encode($footer->socials, JSON_PRETTY_PRINT) }}</textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('footers.index') }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</x-default-layout>
