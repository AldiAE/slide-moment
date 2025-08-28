<div class="card-body" id="row-{{ $id ?? '__ID__' }}">
    {{-- Title --}}
    <div class="form-group row mb-5 div-title">
        <label class="col-lg-3 col-form-label required">Title</label>
        <div class="col-md-9">
            <input type="text" class="form-control" placeholder="Title" name="title[]" value="{{ $data['title'] ?? '' }}" required/>
        </div>
    </div>

    {{-- Section --}}
{{--    <div class="form-group row mb-5 div-section">--}}
{{--        <label class="col-lg-3 col-form-label required">Section</label>--}}
{{--        <div class="col-md-9">--}}
{{--            <select class="form-select" data-control="select2" name="section_id[]" required onchange="validationImage.load(this)">--}}
{{--                <option value="">Choose Section</option>--}}
{{--                @foreach($sections ?? [] as $section)--}}
{{--                    <option value="{{ $section['id'] }}" data-section_type_id="{{ $section['section_type_id'] ?? 0 }}">--}}
{{--                        {{ $section['title'] }}--}}
{{--                    </option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}

    {{-- Row Type --}}
    <div class="form-group row mb-5 div-row_type">
        <label class="col-lg-3 col-form-label required">Row Type</label>
        <div class="col-md-9">
            <select class="form-select" data-control="select2" name="row_type_id[]" required>
                <option value="">Choose Row Type</option>
                @foreach($row_types ?? [] as $row_type)
                    <option value="{{ $row_type['id'] }}" data-section_type_id="{{ $row_type['id'] }}">{{ $row_type['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Category Value --}}
    <div class="form-group row mb-5 div-category-value">
        <label class="col-lg-3 col-form-label">Category Value</label>
        <div class="col-md-9">
            <select class="form-select" data-control="select2" name="category_value[{{ $id ?? '__ID__' }}][]" multiple="multiple">
                <option></option>
                @foreach ($categories ?? [] as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Subtitle --}}
    <div class="form-group row mb-5 div-subtitle">
        <label class="col-lg-3 col-form-label">Subtitle</label>
        <div class="col-md-9">
            <input type="text" class="form-control" placeholder="Subtitle" name="subtitle[]" value="{{ $data['subtitle'] ?? '' }}"/>
        </div>
    </div>

    {{-- Description --}}
    <div class="form-group row mb-5 div-description">
        <label class="col-lg-3 col-form-label">Description</label>
        <div class="col-md-9">
            <textarea name="description[]" class="form-control summernote" rows="5" placeholder="Description">{{ $data['description'] ?? '' }}</textarea>
        </div>
    </div>

    {{-- Icon --}}
    <div class="form-group row mb-5 div-icon">
        <label class="col-lg-3 col-form-label">Icon</label>
        <div class="col-md-9">
            <select class="form-control" name="icon[]">
                <option value="">Choose Icon</option>
                <option value="icov-mobile" {{ ($data['icon'] ?? '') == 'icov-mobile' ? 'selected' : '' }}>icov-mobile</option>
                <option value="icov-website" {{ ($data['icon'] ?? '') == 'icov-website' ? 'selected' : '' }}>icov-website</option>
                <option value="icov-system" {{ ($data['icon'] ?? '') == 'icov-system' ? 'selected' : '' }}>icov-system</option>
            </select>
        </div>
    </div>
</div>
