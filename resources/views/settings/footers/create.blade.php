<x-default-layout>
    @section('title', $title)

    @include('partials.general._notifications')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('footers.store') }}" method="POST">
                @csrf
                <div class="mb-10">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Enter footer description"></textarea>
                </div>

                <div class="mb-10">
                    <label class="form-label">Socials (JSON format)</label>
                    <textarea name="socials" class="form-control" rows="4" placeholder='{"facebook": "...", "instagram": "..."}'></textarea>
                </div>

                <div class="text-end">
                    <a href="{{ route('footers.index') }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</x-default-layout>
