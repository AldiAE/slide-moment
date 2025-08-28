@push('page-style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('page-script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="{{ url('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            var KTSummernoteDemo = function() {
                // Private functions
                var demos = function() {
                    $('.summernote').summernote({
                        height: 150,

                        toolbar: [
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['font', ['strikethrough', 'superscript', 'subscript']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['style', 'ul', 'ol', 'paragraph', 'height']],
                            ['table', ['table']],
                            // ['insert', [ 'picture']],//,'link', 'video','hr', 'grid'
                            ['view', ['fullscreen', 'codeview', 'undo', 'redo', 'help']],
                        ],
                    });
                }

                return {
                    // public functions
                    init: function() {
                        demos();
                    }
                };
            }();

            // Initialization
            jQuery(document).ready(function() {
                KTSummernoteDemo.init();
            });

            // Sync content before form submission
            $('form').on('submit', function(e) {
                $('.summernote').each(function() {
                    var content = $(this).summernote('code');
                    $(this).val(content);
                });
            });
        })

        function redirectTo(url) {
            window.location.href = url;
        }

    </script>

    <script>
        window.rowType = window.rowType || {
            loadDb: function(value){
                this.hidden();
                value = parseInt(value, 10);
                this.process(value);
            },
            load: function(that){
                this.hidden();
                let value = $(that).find(':selected').data('section_type_id');
                value = parseInt(value, 10);
                this.process(value);
            },
            process: function(value) {
                let showDefault = [
                    'div-row_type_id',
                    'div-title'
                ];
                let showArr = [];
                switch (value) {
                    case 1:
                        showArr = [
                            'div-subtitle',
                            'div-background_image',
                        ];
                        break;
                    case 2:
                        showArr = [
                            'div-subtitle',
                            'div-background_image',
                            'div-logo',
                            'div-description',
                            'div-custom_html',
                        ]
                        break;
                    case 3:
                        showArr = [
                            'div-description',
                            'div-icon',
                        ];
                        break
                    case 4:
                        showArr = [
                            'div-description',
                            'div-icon',
                        ];
                        break;
                    case 5:
                        showArr = [
                            'div-description',
                            'div-link_url'
                        ];
                        break;
                    case 6:
                        showArr = [
                            'div-description'
                        ];
                        break;
                    case 7:
                        showArr = [
                            'div-image',
                        ];
                        break;
                    case 8:
                        showArr = [
                            'div-subtitle',
                            'div-description',
                            'div-image',
                        ];
                        break;
                    case 9:
                        showArr = [
                            'div-category-value',
                            'div-subtitle',
                            'div-image',
                            'div-link_url',
                            // 'div-description'
                        ];
                        break;
                    case 10:
                        showArr = [
                            'div-category-value',
                            'div-subtitle',
                            // 'div-description',
                            'div-image',
                            'div-link_url'
                        ];
                        break;
                    case 11:
                        showArr = [
                            'div-image',
                            'div-description',
                        ];
                        break;
                    case 12:
                        showArr = [
                            'div-icon',
                            'div-description'
                        ];
                        break;
                    case 13:
                        showArr = [
                            'div-name',
                            'div-jobdesk',
                            'div-info',//dipake untuk link
                            'div-description',
                            'div-image',
                        ];
                        break;
                    case 14:
                        showArr = [
                            'div-description',
                            'div-image',
                            'div-link_url',
                        ];
                        break;
                    case 15:
                        showArr = [
                            'div-image',
                            'div-link_url',
                        ];
                        break;
                    case 16:
                        showArr = [
                            'div-image',
                            'div-link_url',
                        ];
                        break;
                    case 17:
                        showArr = [
                            'div-image',
                            'div-description'
                        ];
                        break;
                    case 18:
                        showArr = [
                            'div-image',
                        ];
                        break;
                    case 19:
                        showArr = [
                            'div-category-value',
                            'div-subtitle',
                            'div-info',//dipake untuk link
                            // 'div-description',
                            'div-image',
                            'div-link_url'
                        ];
                        break;
                    case 20:
                        showArr = [
                            'div-subtitle',
                            'div-image',
                            'div-link_url'
                        ];
                        break;
                    case 21:
                        showArr = [
                            'div-description',
                            'div-image'
                        ];
                        break;
                    case 22:
                        showArr = [
                            'div-description',
                            'div-image'
                        ];
                        break;
                    case 23:
                        showArr = [
                            'div-subtitle',
                            'div-description',
                            'div-image'
                        ];
                        break;
                    case 24:
                        showArr = [
                            'div-description',
                            'div-image'
                        ];
                        break;
                    default:
                        console.log("Default case executed");
                        break;
                }

                let allToShow = [...showDefault, ...showArr];

                allToShow.forEach(function(id) {
                    $(`.${id}`).show();
                });
            },
            hidden: function(containerId = null){
                let hiddenArr = [
                    'div-category-value',
                    'div-subtitle',
                    'div-description',
                    'div-icon',
                    'div-name',
                    'div-jobdesk',
                    'div-info',//dipake untuk link
                    'div-logo',
                    'div-image',
                    'div-background_image',
                    'div-link_url',
                    'div-custom_html',
                    'div-custom_css',
                    'div-custom_js',
                ];
                hiddenArr.forEach(function(id) {
                    $(`.${id}`).hide();
                });
            }
        };

        @isset($data['row_type_id'])
            rowType.loadDb({{ $data['row_type_id'] }})
        @endisset


        window.validationImage = window.validationImage || {
            load: function(that) {
                let section_type_id = $(that).find(':selected').data('section_type_id');
                // console.log('section_type_id ' + section_type_id);
                this.nulled();
                this.validationCenter(section_type_id)
            },
            loadDb: function(section_type_id){
                this.nulled();
                this.validationCenter(section_type_id);
            },
            validationCenter: function(section_type_id){
                // console.log(section_type_id);
                switch (section_type_id) {
                    case 1:
                        $('#message-div-background_image').html('<br>Please upload a valid format. Max size 2MB. Size requirement: 1488 x 992 px');
                        this.validationImage('#logo-input', 11, 4, null, null);
                        break;
                    case 6:
                        $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size ratio 85:41. Size requirement: 220px x 106 px');
                        this.validationImage('#image-input', 1, 1, null, null);
                        break;
                    case 7:
                        $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size ratio 1:1. Size requirement: 340 x 340 px');
                        this.validationImage('#image-input', 1, 1, null, null);
                        break;
                    case 8:
                        $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size ratio 1:1. Size requirement: 100 x 100 px');
                        this.validationImage('#image-input', 1, 1, null, null);
                        break;
                    case 14:
                        $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size requirement: 849 x 468 px');
                        this.validationImage('#image-input', null, null, 849, 468);
                        break;
                    case 20:
                        $('#message-div-background_image').html('<br>Please upload a valid format. Max size 2MB. Size requirement: 1710 x 617 px');
                        this.validationImage('#background-image-input', null, null, 1710, 617);
                        break;
                    case 23:
                        $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size ratio 1:1. Size requirement: 600 x 600 px');
                        this.validationImage('#background-image-input', 1, 1, null, null);
                        break;
                    case 24:
                        $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size ratio 1:1. Size requirement: 240 x 240 px');
                        this.validationImage('#background-image-input', 1, 1, null, null);
                        break;
                    case 25:
                        $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size ratio 1:1. Size requirement: 340 x 340 px');
                        this.validationImage('#background-image-input', 1, 1, null, null);
                        break;
                    case 26:
                        $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size ratio 1:1. Size requirement: 340 x 340 px');
                        this.validationImage('#image-input', 1, 1, null, null);
                    case 27:
                        $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size ratio 1:1. Size requirement: 640 x 640 px');
                        this.validationImage('#logo-input', 1, 1, null, null);
                        break;
                    // case 28:
                    //     $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size ratio 45:34. Size requirement: 450 x 340 px');
                    //     this.validationImage('#image-input', 45, 34, null, null);
                    //     break;
                    case 30:
                        $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size ratio 1:1. Size requirement: 600 x 600 px');
                        break;
                    case 34:
                        $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size ratio 1:1. Size requirement: 64 x 64 px');
                        break;
                    case 36:
                        $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size ratio 1:1. Size requirement: 64 x 64 px');
                        break;
                    case 37:
                        $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size requirement: 1554 x 659 px. Image can be landscape or portrait');
                        break;
                    case 37:
                        $('#message-div-image').html('<br>Please upload a valid format. Max size 2MB. Size ratio 1:1. Size requirement: 64 x 64 px');
                        break;
                    default:
                        console.log("Default case executed");
                        break;
                }
            },
            nulled: function() {
                $('#message-div-logo').html('');
                $('#message-div-image').html('');
                $('#message-div-background_image').html('');
            },
            validationImage: function(inputSelector, ratioW, ratioH, pixelW, pixelH) {
                // $(inputSelector).off('change').on('change', function () {
                //     let file = this.files[0];
                //     if (file) {
                //         let img = new Image();
                //         img.src = URL.createObjectURL(file);
                //         img.onload = function () {
                //             let width = img.width;
                //             let height = img.height;
                //             let isValid = true;
                //             let errorMsg = '';
                //             if (ratioW && ratioH) {
                //                 let expectedRatio = ratioW / ratioH;
                //                 let actualRatio = width / height;

                //                 if (Math.abs(actualRatio - expectedRatio) > 0.01) {
                //                     isValid = false;
                //                     errorMsg += `Image ratio must be ${ratioW}:${ratioH}`;
                //                 }
                //             }
                //             if (pixelW && pixelH) {
                //                 if (width !== pixelW || height !== pixelH) {
                //                     isValid = false;
                //                     errorMsg += `Image size must be ${pixelW} x ${pixelH} px`;
                //                 }
                //             }
                //             if (!isValid) {
                //                 Swal.fire({
                //                     title: "Error!",
                //                     text: errorMsg ?? "There was an issue with the request. Please try again later.",
                //                     icon: "error"
                //                 });
                //                 $(inputSelector).val('');
                //             }
                //         };
                //     }
                // });
            }
        };

        @isset($data['section'])
            validationImage.loadDb({{ optional($data['section'])->section_type_id ?? 'null' }})
        @endisset
    </script>
@endpush
<div class="card-body" id="row-{{ $id ?? '__ID__' }}">
    <div class="form-group row mb-5 div-title">
        <label class="col-lg-3 col-form-label required">Title</label>
        <div class="col-md-9">
            <input type="text" class="form-control" placeholder="Title" name="title" value="{{ old('title') ?? $data['title'] ?? '' }}" required/>
        </div>
    </div>
{{--    <div class="form-group row mb-5 div-row_type_id">--}}
{{--        <label class="col-lg-3 col-form-label required">Section</label>--}}
{{--        <div class="col-md-9">--}}
{{--            <select class="form-select" data-control="select2" name="section_id" required  onchange="validationImage.load(this)">--}}
{{--                <option value="">Choose Section</option>--}}
{{--                @foreach($sections ?? [] as $key)--}}
{{--                    <option value="{{ $key['id'] }}" {{ (old('section_id') ?? $data['section_id'] ?? '') == $key['id'] ? 'selected' : '' }}  data-section_type_id="{{ $key['section_type_id'] ?? 0 }}" >{{ $key['title'] }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="form-group row mb-5 div-row_type_id">
        <label class="col-lg-3 col-form-label required">Row Type</label>
        <div class="col-md-9">
            <select class="form-select" data-control="select2" name="row_type_id" required onchange="rowType.load(this)">
                <option value="">Choose Row Type</option>
                @foreach($row_types?? [] as $key)
                    <option value="{{ $key['id'] }}" data-section_type_id="{{ $key['id'] }}" {{ (old('row_type_id') ?? $data['row_type_id'] ?? '') == $key['id'] ? 'selected' : '' }}>{{ $key['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row mb-5 div-category-value">
        <label class="col-lg-3 col-form-label">Category Value</label>
        <div class="col-md-9">
            <select class="form-select" data-control="select2" data-placeholder="Select an option"
                    id="category_value" name="category_value[]" multiple="multiple">
                <option></option>
                @php
                if (!empty($data['category_value'])) {
                    $selectedCategories = is_array($data['category_value'] ?? null)
                        ? $data['category_value']
                        : (json_decode($data['category_value'], true) ?? []);
                }
                @endphp

                @foreach ($categories ?? [] as $category)
                    <option value="{{ $category['id'] }}"
                        {{ in_array($category['id'], $selectedCategories ?? []) ? 'selected' : '' }}>
                        {{ $category['name'] }}
                    </option>
                @endforeach

            </select>
        </div>
    </div>
    <div class="form-group row mb-5 div-subtitle">
        <label class="col-lg-3 col-form-label">Subtitle</label>
        <div class="col-md-9">
            <input type="text" class="form-control" placeholder="Subtitle" name="subtitle" value="{{ old('subtitle') ?? $data['subtitle'] ?? '' }}"/>
        </div>
    </div>
    <div class="form-group row mb-5 div-description" >
        <label class="col-lg-3 col-form-label">Description</label>
        <div class="col-md-9">
            <textarea  name="description" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 summernote" rows="5" placeholder="Description">{{ old('description') ?? $data['description'] ?? '' }}</textarea>
        </div>
    </div>
    <div class="form-group row mb-5 div-icon">
        <label class="col-lg-3 col-form-label">Icon</label>
        <div class="col-md-9">
            <select class="form-control" name="icon">
                <option value="">Choose Icon</option>
                <option value="icov-mobile" {{ (old('icon') ?? $data['icon'] ?? '') == 'icov-mobile' ? 'selected' : '' }}>icov-mobile</option>
                <option value="icov-website" {{ (old('icon') ?? $data['icon'] ?? '') == 'icov-website' ? 'selected' : '' }}>icov-website</option>
                <option value="icov-system" {{ (old('icon') ?? $data['icon'] ?? '') == 'icov-system' ? 'selected' : '' }}>icov-system</option>
            </select>
        </div>
    </div>
    <div class="form-group row mb-5 div-name">
        <label class="col-lg-3 col-form-label">Name</label>
        <div class="col-md-9">
            <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') ?? $data['name'] ?? '' }}"/>
        </div>
    </div>
    <div class="form-group row mb-5 div-jobdesk">
        <label class="col-lg-3 col-form-label">Jobdesk</label>
        <div class="col-md-9">
            <input type="text" class="form-control" placeholder="Jobdesk" name="jobdesk" value="{{ old('jobdesk') ?? $data['jobdesk'] ?? '' }}"/>
        </div>
    </div>
    <div class="form-group row mb-5 div-info" > {{-- dipake untuk link --}}
        <label class="col-lg-3 col-form-label">Link</label>
        <div class="col-md-9">
            <input  name="info" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" rows="5" placeholder="Link">{{ old('info') ?? $data['info'] ?? '' }}</input>
        </div>
    </div>
    <div class="form-group row mb-5 div-logo" >
        <label class="col-lg-3 col-form-label">Logo</label>
        <div class="col-md-9">
            <div class="image-input image-input-empty image-input-outline image-input-placeholder" data-kt-image-input="true">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new w-150px h-150px thumbnail shadow">
                        <img class="previewImage" style="width:100% !important;" src="{{ env('STORAGE_URL_VIEW').'storage/'.($data['logo'] ?? '') ?? url('images/logo.png') }}" alt="" onerror="this.onerror=null; this.src='{{ url('images/logo.png') }}';">
                    </div>
                    <div class="fileinput-preview fileinput-exists w-150px h-150px thumbnail shadow"></div>
                    <div id="message-div-logo" class="text-danger fst-italic"></div>
                    <div class="btnImage py-3 hidden">
                                    <span class="btn btn-sm btn-secondary btn-file">
                                        <span class="fileinput-new"> Select image </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" accept="image/png, image/jpeg" class="file" id="logo-input" name="logo" >
                                    </span>
                        <span id="removeImage0" class="fileinput-exists btn btn-sm btn-danger btremove" data-dismiss="fileinput"> Remove </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row mb-5 div-image" >
        <label class="col-lg-3 col-form-label">Image</label>
        <div class="col-md-9">
            <div class="image-input image-input-empty image-input-outline image-input-placeholder" data-kt-image-input="true">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new w-150px h-150px thumbnail shadow">
                        <img class="previewImage" style="width:100% !important;" src="{{ env('STORAGE_URL_VIEW').'storage/'.($data['image'] ?? '') ?? url('images/logo.png') }}" alt="" onerror="this.onerror=null; this.src='{{ url('images/logo.png') }}';">
                    </div>
                    <div class="fileinput-preview fileinput-exists w-150px h-150px thumbnail shadow"></div>
                    <div id="message-div-image" class="text-danger fst-italic"></div>
                    <div class="btnImage py-3 hidden">
                                    <span class="btn btn-sm btn-secondary btn-file">
                                        <span class="fileinput-new"> Select image </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" accept="image/png, image/jpeg" id="image-input" class="file" name="image" >
                                    </span>
                        <span id="removeImage0" class="fileinput-exists btn btn-sm btn-danger btremove" data-dismiss="fileinput"> Remove </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row mb-5 div-background_image" >
        <label class="col-lg-3 col-form-label">Background Image</label>
        <div class="col-md-9">
            <div class="image-input image-input-empty image-input-outline image-input-placeholder" data-kt-image-input="true">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new w-150px h-150px thumbnail shadow">
                        <img class="previewImage" style="width:100% !important;" src="{{ env('STORAGE_URL_VIEW').'storage/'.($data['background_image'] ?? '') ?? url('images/logo.png') }}" alt="" onerror="this.onerror=null; this.src='{{ url('images/logo.png') }}';">
                    </div>
                    <div class="fileinput-preview fileinput-exists w-150px h-150px thumbnail shadow"></div>
                    <div id="message-div-background_image" class="text-danger fst-italic"></div>
                    <div class="btnImage py-3 hidden">
                                    <span class="btn btn-sm btn-secondary btn-file">
                                        <span class="fileinput-new"> Select image </span>
                                        <span class="fileinput-exists"> Change </span>
                                        <input type="file" accept="image/png, image/jpeg" class="file" id="background-image-input" name="background_image" >
                                    </span>
                        <span id="removeImage0" class="fileinput-exists btn btn-sm btn-danger btremove" data-dismiss="fileinput"> Remove </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row mb-5 div-link_url" >
        <label class="col-lg-3 col-form-label">Link URL</label>
        <div class="col-md-9">
            <input type="text" class="form-control" placeholder="Link URL" name="link_url" value="{{ old('link_url') ?? $data['link_url'] ?? '' }}"/>
        </div>
    </div>
    <div class="form-group row mb-5 div-custom_html" >
        <label class="col-lg-3 col-form-label">Custom HTML</label>
        <div class="col-md-9">
            <textarea  name="custom_html" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 summernote" rows="5" placeholder="Custom HTML">{{ old('custom_html') ?? $data['custom_html'] ?? '' }}</textarea>
        </div>
    </div>
    <div class="form-group row mb-5 div-custom_css" >
        <label class="col-lg-3 col-form-label">Custom CSS</label>
        <div class="col-md-9">
            <textarea  name="custom_css" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 summernote" rows="5" placeholder="Custom HTML">{{ old('custom_css')  ?? $data['custom_css'] ?? '' }}</textarea>
        </div>
    </div>
    <div class="form-group row mb-5 div-custom_js" >
        <label class="col-lg-3 col-form-label">Custom JS</label>
        <div class="col-md-9">
            <textarea  name="custom_js" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 summernote" rows="5" placeholder="Custom JS">{{ old('custom_js')  ?? $data['custom_css'] ?? ''}}</textarea>
        </div>
    </div>
</div>
