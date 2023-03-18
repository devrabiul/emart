@extends('layouts.backend.app')

@section('page_title', 'Edit Product')

@section('custom_css')
<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/css/bootstrap-tagsinput.css">
{{-- <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/css/select2-custom.min.css"> --}}
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
<style>
    .select2-container--default .color-preview {
        height: 12px;
        width: 12px;
        display: inline-block;
        margin-right: 5px;
        margin-left: 3px;
        margin-top: 2px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #fff !important;
        border-color: #cbcbcb !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #cbcbcb;
        cursor: pointer;
        display: inline-block;
        font-weight: bold;
        margin-right: 3px;
        padding-right: 5px;
        border-right: 1px solid #cbcbcb;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border: solid #cbcbcb 1px;
        outline: 0;
    }

    .bootstrap-tagsinput {
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, 0.09);
        border-radius: 3px;
        color: #4d627b;
        cursor: text;
        display: inline-block;
        line-height: 22px;
        margin-bottom: 0;
        max-width: 100%;
        min-width: 100%;
        padding: 4px 6px 0;
        vertical-align: middle;
        height: 100%;
    }

    .bootstrap-tagsinput .tag {
        border-radius: 2px;
        background: #00a36c;
        color: #000;
        display: inline-block;
        font-size: 12px;
        font-weight: normal;
        margin: 0 2px 5px 0;
        padding: 5px;
        border: 1px solid #00a36c;
    }

</style>
@endsection

@section('content')

<!-- Breadcrumb starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Edit Product
                        <small>Edit Product with information</small>
                    </h3>
                </div>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb pull-right">
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.dashboard')}}">
                            <i data-feather="home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('admin.product.index')}}">
                            Product
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Edit Product</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Ends-->



<form action="{{route('admin.product.update')}}" method="post" enctype="multipart/form-data" id="product_create_form">
    @csrf
    <!-- Main Container Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <label class="title-color" for="">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="product_name"
                                    value="{{$data->name}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="title-color" for="">Product SKU <span class="generateSKU"
                                        onclick="generateSKU()">Generate SKU</span> </label>
                                <input type="text" name="product_sku" class="form-control" id="product_sku"
                                    placeholder="Product SKU" value="{{$data->product_sku}}">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="">Description :</label>
                                <div class="description-sm">
                                    <textarea id="editor1" name="description" cols="10"
                                        rows="4">{{$data->description}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <h4>Variations</h4>
                            <hr>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="title-color" for="">Color</label>
                                    <select class="form-control js-example-basic-multiple js-states color-var-select"
                                        name="colors[]" multiple="multiple" id="color_box">
                                        @foreach ($color as $item)
                                        <option value="{{$item->code}}"
                                            {{in_array($item->code, json_decode($data->colors, true))?'selected':''}}>
                                            {{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="title-color" for="">Attributes</label>
                                    <select
                                        class="form-control js-example-basic-multiple js-states select2-custom-multiple"
                                        name="attr[]" multiple="multiple" id="attributes_box">
                                        @foreach ($productAttribute as $item)
                                        <option value="{{$item->id}}"
                                            {{in_array($item->id, json_decode($data->attribute, true))?'selected':''}}>
                                            {{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- {{$data->choice_options}} --}}
                                @foreach (json_decode($data->choice_options) as $item)
                                    @foreach ($item->choice_options as $value)
                                        <input type="text" class="form-control input_tagsinput" value="{{$value}}" name="" placeholder="Enter choice values" data-role="tagsinput" onchange="updateFromController()">
                                    @endforeach
                                @endforeach

                                <div class="col-md-12 mb-3">
                                    {{-- <input type="text" value="'.count($result).'" name="variant_quantity"> --}}
                                    <h5>Variants Table</h5>
                                    <table class="table table-bordered physical_product_show">
                                        <thead>
                                            <tr>
                                                <td class="text-center">
                                                    <label for="" class="control-label">Variant</label>
                                                </td>
                                                <td class="text-center">
                                                    <label for="" class="control-label">Variant Price</label>
                                                </td>
                                                <td class="text-center">
                                                    <label for="" class="control-label">SKU</label>
                                                </td>
                                                <td class="text-center">
                                                    <label for="" class="control-label">Quantity</label>
                                                </td>
                                                <td class="text-center">
                                                    <label for="" class="control-label">Image</label>
                                                </td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody id="generateHtmlTable">
                                            @foreach (json_decode($data['variation']) as $item)
                                            <tr>
                                                <td>
                                                    <label for="" class="control-label">{{$item->variant_name}}</label>
                                                    <input type="hidden" value="{{$item->variant_name}}"
                                                        name="variant_name[]">
                                                    <input type="hidden" value="{{$item->variant_color}}"
                                                        name="variant_color[]">
                                                </td>
                                                <td>
                                                    <input type="number" name="variant_price[]" value="{{$item->variant_price}}" min="0"
                                                        step="0.01" class="form-control" required="">
                                                </td>
                                                <td>
                                                    <input type="text" name="variant_sku[]"
                                                        value="{{$item->variant_sku}}" class="form-control"
                                                        required="">
                                                </td>
                                                <td>
                                                    <input type="number" name="variant_quantity[]" value="{{$item->variant_quantity}}" min="1"
                                                        max="1000000" step="1" class="form-control" required="">
                                                </td>
                                                <td>
                                                    <input type="file" name="variant_img[]" class="form-control"
                                                        required="">
                                                        <div>
                                                            <img src="{{url($item->variant_img)}}" alt="" width="25">
                                                        </div>
                                                </td>
                                                <td>
                                                    <span class="btn"><i class="fa fa-trash"></i></span>
                                                </td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="attributes_area" id="attributes_area"></div>

                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="col-12 form-group sku_comb_result" id="sku_comb_result">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            <h4>General Info</h4>
                            <hr>
                            {{-- @php
                              $valuer = json_decode($data->category_id)[2]->id;
                            //   dd($valuer->id)
                              dd($valuer)
                            //   dd(gettype(json_decode($data['category_id'])))
                            @endphp --}}

                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label class="title-color" for="">Category</label>
                                    <select class="form-select" name="category_id[]" id="category_id" required>
                                        <option value="">Select A Category</option>
                                        @foreach ($category as $item)
                                        <option value="{{$item->id}}"
                                            {{(json_decode($data->category_id)[0]->id == $item->id?'selected':'')}}>
                                            {{$item->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="title-color" for="parent_id">Sub Category</label>

                                    <select class="form-select" name="category_id[]" id="category_sub_id">
                                        <option value="">Select Sub Category</option>
                                        @foreach ($category_sub as $item)
                                        <option value="{{$item->id}}"
                                            {{(isset(json_decode($data->category_id)[1]) && json_decode($data->category_id)[1]->id == $item->id) ? 'selected' : '' }}>
                                            {{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="title-color">Sub Sub Category Name<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select" name="category_id[]" id="category_sub_sub_id">
                                        <option value="">Select Sub Sub Category</option>
                                        @foreach ($category_sub_sub as $item)
                                        <option value="{{$item->id}}"
                                            {{(isset(json_decode($data->category_id)[2]) && json_decode($data->category_id)[2]->id == $item->id) ? 'selected' : '' }}>
                                            {{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="title-color" for="product_type">Product type</label>
                                    <select class="form-select" name="product_type" id="product_type" required>
                                        <option value="">Select A Type</option>
                                        <option value="physical" {{($data->type == 'physical'?'selected':'')}}>Physical
                                        </option>
                                        <option value="digital" {{($data->type == 'digital'?'selected':'')}}>Digital
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="title-color" for="brand_id">Brand</label>
                                    <select class="form-select" name="brand_id" id="brand_id">
                                        <option value="">Select A Brand</option>
                                        @foreach ($brand as $item)
                                        <option value="{{$item->id}}" {{($item->id == $data->brand_id?'selected':'')}}>
                                            {{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="title-color" for="total_quantity">Total Quantity</label>
                                    <input class="form-control" name="total_quantity" id="total_quantity" type="number"
                                        placeholder="Ex. 50" value="{{$data->total_quantity}}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="title-color" for="purchase_price">Purchase Price</label>
                                    <input class="form-control" name="purchase_price" id="purchase_price" type="number"
                                        placeholder="Ex. 50" value="{{$data->purchase_price}}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="title-color" for="selling_price">Selling Price</label>
                                    <input class="form-control" name="selling_price" id="selling_price" type="number"
                                        placeholder="Ex. 50" value="{{$data->selling_price}}">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="title-color" for="tax">Tax</label>
                                    <input class="form-control" name="tax" id="tax" type="number" placeholder="Ex. 50"
                                        value="{{$data->tax}}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="title-color" for="discount">Discount</label>
                                    <input class="form-control" name="discount" id="discount" type="number"
                                        placeholder="Enter Discount" value="{{$data->discount}}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="title-color" for="discount_type">Discount Type</label>
                                    <select class="form-select" name="discount_type" id="discount_type">
                                        <option value="">Select A Type</option>
                                        <option value="flat" {{($data->discount_type == "flat"?'selected':'')}}>Flat
                                        </option>
                                        <option value="percent" {{($data->discount_type == "percent"?'selected':'')}}>
                                            Percent</option>
                                    </select>
                                </div>


                                <div class="col-md-4 mb-3">
                                    <label class="title-color">Product Thumbnail</label>
                                    <span class=""><span class="text-danger">*</span> ( Ratio 1:1 )</span>
                                    <div class="custom-file text-left">
                                        <input type="file" name="thumbnail" class="form-control">

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 text-end">
                                    <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</form>
</div>
<!-- Main Container End -->


@endsection

@section('custom_js')
<!-- ckeditor js-->
<script src="{{asset('public/assets/backend')}}/js/editor/ckeditor/ckeditor.js"></script>
<script src="{{asset('public/assets/backend')}}/js/editor/ckeditor/ckeditor.custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<!--script admin-->
<script src="{{asset('public/assets/backend')}}/js/bootstrap-tagsinput.js"></script>

<!-- Sub Category Data || Start-->
<script>
    $('#category_id').on('change', function () {
        let category = $('#category_id').val();
        $('#category_sub_sub_id').html('<option value="">Select Sub Sub Category</option>');

        $.ajax({
            url: `{{route('admin.sub-category.getSubCategory')}}`,
            method: "POST",
            type: "",
            data: {
                'category': category,
            },
            success: function (data) {
                $('#category_sub_id').html(data.subCategory);
            },
        });
    });

</script>
<!-- Sub Category Data || End-->

<!-- Sub Sub Category Data || Start-->
<script>
    $('#category_sub_id').on('change', function () {
        let category = $('#category_sub_id').val();
        $.ajax({
            url: `{{route('admin.sub-sub-category.getSubSubCategory')}}`,
            method: "POST",
            type: "",
            data: {
                'category': category,
            },
            success: function (data) {
                $('#category_sub_sub_id').html(data.subCategory);
            },
        });
    });

</script>
<!-- Sub Sub Category Data || End-->
<script>
    $('.select2-custom-multiple').select2({
        width: 'resolve'
    });

    $(".js-example-responsive").select2({
        // dir: "rtl",
        width: 'resolve'
    });

    $('.color-var-select').select2({
        templateResult: colorCodeSelect,
        templateSelection: colorCodeSelect,
        escapeMarkup: function (m) {
            return m;
        }
    });

    function colorCodeSelect(state) {
        var colorCode = $(state.element).val();
        if (!colorCode) return state.text;
        return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state
            .text;
    };

</script>

<script>
    function attributes_boxCode()
    {
        let attributesValues = $('#attributes_box').val();
        if (attributesValues == null) {
            $('#attributes_area').html("");
        }else{
            $.ajax({
                type: "POST",
                url: `{{ route('admin.attribute.attributes_box') }}`,
                data: {
                    'attributesValues':attributesValues,
                },
                success: function (data) {
                    $('#attributes_area').html(data.attributesHtml);
                    $("input[data-role=tagsinput]").tagsinput();
                    updateFromController();
                }
            });
        }
    }

    $('#attributes_box').on('change', function () {
        attributes_boxCode();
    });

    $('#color_box, #product_name').on('change', function () {
        updateFromController();
    });


    function updateFromController() {
        $.ajax({
            type: "POST",
            url: `{{ route('admin.product.updateFromController') }}`,
            data: $('#product_create_form').serialize(),
            success: function (data) {
                $('#sku_comb_result').html(data.html);
                $('#attributes_area').html(data.attributesHtml);
            }
        });
    }

    function updateFromController() {
        colorAndtypenull();
        $.ajax({
            type: "POST",
            url: `{{ route('admin.product.updateFromController') }}`,
            data: $('#product_create_form').serialize(),
            success: function (data) {
                $('#sku_comb_result').html(data.html);
                $('#attributes_area').html(data.attributesHtml);
            }
        });
    }

</script>

<script>
    // Color And Type Status || Start
    function colorAndtypenull()
    {
        if ($('#color_box').val() == null && $('#attributes_box').val() == null) {
            $('#sku_comb_result').html("");
            $('#attributes_area').html("");
        }
    }
    // Color And Type Status || End
</script>

<script>
    // Generate SKU Code || Start
    function generateSKU() {
        let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let gencode = '';
        for (let i = 0; i < 12; i++) {
            gencode += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        $('#product_sku').val(gencode);
    }
    // Generate SKU Code || End
</script>

<script>
    jQuery(window).load(function(event) {
        attributes_boxCode();
        updateFromController();
    });
</script>

@endsection
