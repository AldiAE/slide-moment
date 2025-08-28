<!--begin::Head-->
<head>
    <meta charset="utf-8" />
    <title>{{env('TITLE', 'Slide Moment')}} | {{$title}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Website CMS Slide Moment" name="description" />
    <meta content="" name="author" />
    <meta name="keywords" content=""/>

    <link rel="shortcut icon" href="#" />

    <!--begin::Fonts-->
    {{-- <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" rel="stylesheet" type="text/css" /> --}}
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ env('STORAGE_URL_VIEW') }}{{ ('assets/metronic-8/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ env('STORAGE_URL_VIEW') }}{{ ('assets/metronic-8/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <!--begin::Vendor Stylesheets(used by this page)-->

    <!--end::Vendor Stylesheets-->

    <!--begin::Custom Stylesheets(optional)-->

    <!--end::Custom Stylesheets-->

    @yield('page-style')
</head>
<!--end::Head-->
