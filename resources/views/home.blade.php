<x-default-layout>
    @section('title')
        {{ $title }}
    @endsection

    @section('breadcrumbs')
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            @if (empty($sub_title))
                <li class="breadcrumb-item text-muted">
                    {{ $title }}
                </li>
            @else
                <li class="breadcrumb-item text-muted">
                    <a href="#" class="text-muted text-hover-primary">{{ $title }}</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <li class="breadcrumb-item text-dark">
                    {{ $sub_title }}
                </li>
            @endif
        </ul>
    @endsection

    @include('partials.general._notifications')

    <div class="col-12">
        <div class="card card-flush h-md-100">
            <div class="card-body d-flex flex-column justify-content-between mt-9 bgi-no-repeat bgi-size-cover bgi-position-x-center pb-0" style="background-position: 100% 50%; background-image:url('{{ asset("assets/metronic-8/media/stock/900x600/42.png") }}')">
                <div class="mb-10">
                    <!--begin::Title-->
                    <div class="fs-2hx fw-bold text-gray-800 text-center mb-13">
                        <span class="me-2">
                            Welcome Back!
                            <br>
                            <span class="position-relative d-inline-block text-danger">
                                {{Session::get('user_name')}}
                            </span>
                        </span>
                    </div>
                    <!--end::Title-->
                </div>
            </div>
        </div>
    </div>
</x-default-layout>
