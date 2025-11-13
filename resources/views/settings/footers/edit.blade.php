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
                    <label class="form-label d-block mb-3">Socials</label>
                    <div id="socials-repeater">
                        @php $index = 0; @endphp
                        @if(is_array($footer->socials))
                            @foreach($footer->socials as $key => $value)
                                <div class="d-flex mb-3 social-item">
                                    <input type="text" name="socials[{{ $index }}][key]" class="form-control me-2" value="{{ $key }}" placeholder="Platform">
                                    <input type="text" name="socials[{{ $index }}][value]" class="form-control me-2" value="{{ $value }}" placeholder="URL">
                                    <button type="button" class="btn btn-danger btn-sm remove-social">×</button>
                                </div>
                                @php $index++; @endphp
                            @endforeach
                        @endif
                    </div>
                    <button type="button" id="add-social" class="btn btn-light-primary btn-sm mt-2">+ Add Social</button>
                </div>

                <div class="text-end mt-10">
                    <a href="{{ route('footers.index') }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let index = {{ $index ?? 0 }};
            document.getElementById("add-social").addEventListener("click", function () {
                const repeater = document.getElementById("socials-repeater");
                const item = document.createElement("div");
                item.classList.add("d-flex", "mb-3", "social-item");
                item.innerHTML = `
                    <input type="text" name="socials[${index}][key]" class="form-control me-2" placeholder="Platform">
                    <input type="text" name="socials[${index}][value]" class="form-control me-2" placeholder="URL">
                    <button type="button" class="btn btn-danger btn-sm remove-social">×</button>
                `;
                repeater.appendChild(item);
                index++;
            });

            document.getElementById("socials-repeater").addEventListener("click", function (e) {
                if (e.target.classList.contains("remove-social")) {
                    e.target.closest(".social-item").remove();
                }
            });
        });
    </script>
</x-default-layout>
