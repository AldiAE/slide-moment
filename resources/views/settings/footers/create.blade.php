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
                    <label class="form-label d-block mb-3">Socials</label>
                    <div id="socials-repeater">
                        <div class="d-flex mb-3 social-item">
                            <input type="text" name="socials[0][key]" class="form-control me-2" placeholder="Platform (e.g. facebook)">
                            <input type="text" name="socials[0][value]" class="form-control me-2" placeholder="URL (e.g. https://facebook.com)">
                            <button type="button" class="btn btn-danger btn-sm remove-social">×</button>
                        </div>
                    </div>
                    <button type="button" id="add-social" class="btn btn-light-primary btn-sm mt-2">+ Add Social</button>
                </div>

                <div class="text-end mt-10">
                    <a href="{{ route('footers.index') }}" class="btn btn-light me-3">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let index = 1;
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
