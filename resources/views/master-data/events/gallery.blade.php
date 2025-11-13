<x-default-layout>
    @section('title', $title)

    @section('breadcrumbs')
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{ route('events.index') }}" class="text-muted text-hover-primary">Events</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark">Gallery</li>
        </ul>
    @endsection

    @include('partials.general._notifications')

    <div class="card card-flush">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">{{ $title }}</h3>
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-sm btn-info me-2" data-bs-toggle="modal" data-bs-target="#ruleModal">
                    <i class="fa-solid fa-gavel fs-4 me-2"></i> Show Rule
                </button>

                <form action="{{ route('events.sync-gallery', $event->id) }}" method="POST" class="d-inline" id="sync-form" onsubmit="showLoading()">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-primary" id="sync-button">
                        <i class="fa-solid fa-refresh fs-4 me-2"></i> Sync Gallery
                    </button>

                    <button type="button" class="btn btn-sm btn-primary d-none" id="loading-button" disabled>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="ms-2">Syncing...</span>
                    </button>
                </form>
            </div>
        </div>

        <div class="card-body py-5">
            @if ($galleryGroups->isEmpty())
                <div class="text-center py-10">
                    <i class="ki-outline ki-image fs-2hx text-muted"></i>
                    <div class="fs-5 text-muted mt-3">No gallery groups found.</div>
                </div>
            @else
                {{-- === Gallery Group List === --}}
                <div class="row g-3">
                    @foreach ($galleryGroups as $group)
                        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                            <div class="card border-0 shadow-sm hover-elevate-up cursor-pointer text-center p-2"
                                 data-bs-toggle="modal"
                                 data-bs-target="#galleryModal{{ $group->id }}"
                                 style="transition: transform .15s ease;">
                                <div class="symbol mx-auto mb-2 overflow-hidden rounded"
                                     style="width: 120px; height: 120px;">
                                    @php
                                        $ext = strtolower(pathinfo($group->media_path, PATHINFO_EXTENSION));
                                    @endphp

                                    {{-- Gambar --}}
                                    @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                        <img src="{{ asset('storage/' . $group->media_path) }}"
                                             alt="{{ $group->name }}"
                                             class="object-fit-cover w-100 h-100 rounded"
                                             loading="lazy" />
                                        {{-- Video --}}
                                    @elseif (in_array($ext, ['mp4', 'mov', 'webm']))
                                        <video class="w-100 h-100 rounded" muted playsinline preload="metadata">
                                            <source src="{{ asset('storage/' . $group->media_path) }}" type="video/{{ $ext }}">
                                        </video>
                                        {{-- File lain --}}
                                    @else
                                        <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                            <i class="fa-solid fa-file fs-2x text-muted mb-1"></i>
                                            <span class="text-muted small">{{ strtoupper($ext) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="fw-semibold small text-truncate" title="{{ $group->name }}">
                                    {{ $group->name }}
                                </div>
                            </div>
                        </div>

                        {{-- === Modal Preview Group === --}}
                        {{-- Modal --}}
                        <div class="modal fade" id="galleryModal{{ $group->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header py-3">
                                        <h5 class="modal-title fw-bold">{{ $group->name }}</h5>
                                        <button type="button" class="btn btn-sm btn-icon" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="ki-outline ki-cross fs-2"></i>
                                        </button>
                                    </div>

                                    <div class="modal-body bg-light">
                                        @if ($group->galleries->isEmpty())
                                            <div class="text-center py-10 text-muted">No media in this group.</div>
                                        @else
                                            <div class="row g-3">
                                                @foreach ($group->galleries as $gallery)
                                                    @php
                                                        $ext = strtolower(pathinfo($gallery->media_path, PATHINFO_EXTENSION));
                                                    @endphp
                                                    <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                                        <div class="card border-0 shadow-sm hover-elevate-up overflow-hidden">
                                                            <div class="ratio ratio-1x1">
                                                                @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                                    <img src="{{ asset('storage/' . $gallery->media_path) }}"
                                                                         alt="{{ $gallery->name }}"
                                                                         class="w-100 h-100 object-fit-cover"
                                                                         loading="lazy">
                                                                @elseif (in_array($ext, ['mp4', 'mov', 'webm']))
                                                                    <video class="w-100 h-100 object-fit-cover" muted playsinline preload="metadata">
                                                                        <source src="{{ asset('storage/' . $gallery->media_path) }}" type="video/{{ $ext }}">
                                                                    </video>
                                                                @else
                                                                    <div class="d-flex flex-column align-items-center justify-content-center h-100 bg-white">
                                                                        <i class="fa-solid fa-file fs-2x text-muted mb-1"></i>
                                                                        <span class="text-muted small">{{ strtoupper($ext) }}</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="ruleModal" tabindex="-1" aria-labelledby="ruleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered"> <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ruleModalLabel">Event Rules</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <img src="{{ asset('assets/flow.png') }}" alt="Event Rules" class="img-fluid w-100">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function showLoading() {
                // Mendapatkan elemen tombol normal dan tombol loading
                const syncButton = document.getElementById('sync-button');
                const loadingButton = document.getElementById('loading-button');

                // Menyembunyikan tombol normal
                syncButton.classList.add('d-none');

                // Menampilkan tombol loading dan menonaktifkannya
                loadingButton.classList.remove('d-none');

                // Catatan: Karena form akan disubmit, halaman akan merefresh/redirect
                // setelah proses sync selesai, dan tombol akan kembali normal.
                // Jika Anda menggunakan AJAX untuk sync, Anda perlu menambahkan logika
                // untuk menyembunyikan loadingButton dan menampilkan kembali syncButton
                // di dalam callback sukses atau error AJAX Anda.
            }
        </script>
    @endpush
</x-default-layout>
