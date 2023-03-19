@extends('layouts.backend.app')

@section('page_title', 'Add Product')

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
                    <h3>Add Product
                        <small>Add Product with information</small>
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
                    <li class="breadcrumb-item active">Add Product</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Ends-->



<form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data" id="product_create_form">
    @csrf
    <!-- Main Container Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="title-color" for="">Product Name</label>
                                <input type="text" class="form-control" name="product_name" id="product_name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="title-color" for="">Product SKU <span class="generateSKU"
                                        onclick="generateSKU()">Generate SKU</span> </label>
                                <input type="text" name="product_sku" class="form-control" id="product_sku"
                                    placeholder="Product SKU" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="">Description :</label>
                                <div class="description-sm">
                                    <textarea id="editor1" name="description" cols="10" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('backend.products.variant')
        @include('backend.products.general_info')
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
        // let attributesValues = $('#attributes_box').val();
        // if (attributesValues != null) {
        //     // Attributes Html Generator
        //     let let_gen_html_for_Attr = '<h4>Attributes</h4>';
        //     $.each(attributesValues, function (att_index, att_value) {
        //         let_gen_html_for_Attr += `<div class="row"><div class="col-md-3 mb-2">` +
        //             `<input type="hidden" name="choice_no[]" value="` + (att_index + 1) + `">` +
        //             `<input type="text" class="form-control" name="choice[]" value="${att_value}" placeholder="Choice Title" readonly>` +
        //             `</div><div class="col-lg-9 mb-2">` +
        //             `<input type="text" class="form-control input_tagsinput" name="choice_options_${att_index+1}[]" placeholder="Enter choice values" data-role="tagsinput" onchange="updateFromController()">` +
        //             `</div></div>`;
        //     });
        //     $('#attributes_area').html(let_gen_html_for_Attr);
            // $("input[data-role=tagsinput]").tagsinput();
        // } else {
        //     $('#attributes_area').html("");
        // }
    });

    $('#color_box, #product_name').on('change', function () {
        updateFromController();
    });

    function updateFromController() {
        colorAndtypenull();
        $.ajax({
            type: "POST",
            url: `{{ route('admin.product.updateFromController') }}`,
            data: $('#product_create_form').serialize(),
            success: function (data) {
                $('#sku_comb_result').html(data.html);
                $('#attributes_area').html(data.attributesHtml);
                updateVariants_quantity();
            }
        });
    }

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
    // Generate SKU Code || Start
    function updateVariants_quantity() {
        var variants_quantity = 0;
        $('.variants_quantity').each(function(){
            variants_quantity += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
        });
        $('#total_quantity').val(variants_quantity);
    }
    // Generate SKU Code || End
</script>
@endsection
