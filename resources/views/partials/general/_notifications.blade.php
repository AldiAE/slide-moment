@if($errors->any())
<div class="alert alert-dismissible bg-light-danger d-flex flex-column flex-sm-row p-5 mb-10">
    <i class="ki-duotone ki-information-5 fs-2hx text-danger me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
    <div class="d-flex flex-column pe-0 pe-sm-10">
        <h4 class="fw-semibold">Error!</h4>
        @foreach($errors->all() as $e)
            <span>- {{$e}}</span>
        @endforeach
    </div>
    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
        <i class="ki-duotone ki-cross fs-1 text-danger"><span class="path1"></span><span class="path2"></span></i>
    </button>
</div>
@endif

@if(Session::has('success'))
<div class="alert alert-dismissible bg-light-success d-flex flex-column flex-sm-row p-5 mb-10">
    <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
    <div class="d-flex flex-column pe-0 pe-sm-10">
        <h4 class="fw-semibold">Success!</h4>
        @foreach(Session::get('success') as $s)
            <span>{{$s}}</span>
        @endforeach
    </div>
    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
        <i class="ki-duotone ki-cross fs-1 text-success"><span class="path1"></span><span class="path2"></span></i>
    </button>
</div>
 <?php Session::forget('success'); ?>
@endif

@if(Session::has('warning'))
<div class="alert alert-dismissible bg-light-warning d-flex flex-column flex-sm-row p-5 mb-10">
    <i class="ki-duotone ki-notification-bing fs-2hx text-warning me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
    <div class="d-flex flex-column pe-0 pe-sm-10">
        <h4 class="fw-semibold">Warning!</h4>
        @foreach(Session::get('warning') as $w)
            <span>- {{$w}}</span>
        @endforeach
    </div>
    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
        <i class="ki-duotone ki-cross fs-1 text-warning"><span class="path1"></span><span class="path2"></span></i>
    </button>
</div>
 <?php Session::forget('warning'); ?>
@endif

@php
    \View::share([
        'title' => $title ?? null,
        'menu_active' => $menu_active ?? null,
        'submenu_active' => $submenu_active ?? null,
        'child_active' => $child_active ?? null,
    ]);
@endphp
