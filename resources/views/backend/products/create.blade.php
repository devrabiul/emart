@extends('layouts.backend.app')

@section('page_title', 'Add Product')

@section('custom_css')
<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/css/bootstrap-tagsinput.css">
<link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/css/select2-custom.min.css">
<style>
    .select2-container--default .color-preview {
        height: 12px;
        width: 12px;
        display: inline-block;
        margin-right: 5px;
        margin-left: 3px;
        margin-top: 2px;
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




<!-- Main Container Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.sub-sub-category.store')}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="title-color" for="">Product Name</label>
                                <input type="text" name="name" class="form-control" name="Product Name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="title-color" for="">Product SKU</label>
                                <input type="text" name="name" class="form-control" placeholder="Product SKU">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="">Description :</label>
                                <div class="description-sm">
                                    <textarea id="editor1" name="editor1" cols="10" rows="4"></textarea>
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
                                    name="colors[]" multiple="multiple" id="color_box" required>
                                    @foreach ($color as $item)
                                    <option value="{{$item->code}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="title-color" for="">Attributes</label>
                                <select class="form-control js-example-basic-multiple js-states select2-custom-multiple"
                                    name="attr[]" multiple="multiple" id="" required>

                                    <option value="size">Size</option>
                                    <option value="type">Type</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="col-12 form-group sku_combination" id="sku_combination">
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
                                            </tr>
                                        </thead>
                                        <tbody id="generateHtmlTable">

                                        </tbody>
                                    </table>
                                </div>
                            </div>




                        </div>
                    </div>
                    </form>
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

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="title-color" for="product_type">Product type</label>
                                <select class="form-select" name="" id="product_type" required>
                                    <option disabled="" selected="">Select A Type</option>
                                    <option value="physical">Physical</option>
                                    <option value="digital">Digital</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="title-color" for="brand_id">Brand</label>
                                <select class="form-select" name="" id="brand_id" required>
                                    <option disabled="" selected="">Select A Brand</option>
                                    @foreach ($category as $item)
                                    <option value="{{$item->id}}"><span class="color-preview"
                                            style="background-color:#9966CC;"></span> {{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="title-color" for="">Category</label>
                                <select class="form-select" name="" id="category_id" required>
                                    <option disabled="" selected="">Select A Category</option>
                                    @foreach ($category as $item)
                                    <option value="{{$item->id}}"><span class="color-preview"
                                            style="background-color:#9966CC;"></span> {{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="title-color" for="parent_id">Sub Category</label>

                                <select class="form-select" name="parent_id" id="parent_id" required>
                                    <option disabled="" selected="">Select Sub Category</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="title-color">Sub Sub Category Name<span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="sub_parent_id" id="sub_parent_id" required>
                                    <option disabled="" selected="">Select Sub Sub Category</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="title-color" for="priority">Priority</label>

                                <select class="form-select" name="priority" id="" required="">
                                    <option disabled="" selected="">Set Priority</option>
                                    @for ($i = 0; $i <= 10; $i++) <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="title-color">Sub Category Logo</label>
                                <span class=""><span class="text-danger">*</span> ( Ratio 1:1 )</span>
                                <div class="custom-file text-left">
                                    <input type="file" name="image" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-end">
                                <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Container End -->

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row product-adding">

                        <div class="col-xl-12">
                            <form class="needs-validation add-product-form" novalidate="">
                                <div class="form-group row">

                                    <div class="offset-xl-3 offset-sm-4 mt-4">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-light">Discard</button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Container-fluid Ends-->


@endsection

@section('custom_js')
<!-- ckeditor js-->
<script src="{{asset('public/assets/backend')}}/js/editor/ckeditor/ckeditor.js"></script>
<script src="{{asset('public/assets/backend')}}/js/editor/ckeditor/ckeditor.custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!--script admin-->
<script src="{{asset('public/assets/backend')}}/js/bootstrap-tagsinput.js"></script>

<script>
    $('#category_id').on('change', function () {
        let category = $('#category_id').val();

        $.ajax({
            url: `{{route('admin.sub-sub-category.getcategory')}}`,
            method: "POST",
            type: "",
            data: {
                'category': category,
            },
            success: function (data) {
                $('#parent_id').html(data.subCategory);
            },
        });
    });

</script>

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
    $('#color_box').on('change', function () {
        var selectedValues = $(this).val();
        if (selectedValues != null) {

        } else {
            $('#generateHtmlTable').html("");
        }
        console.log(selectedValues);
        // let p_root_html = `<tr><td><label for="" class="control-label"></label></td>` +
        //     `<td><input type="number" name="" value="" min="0" step="0.01" class="form-control" required="">` +
        //     `</td><td><input type="text" name="" value="" class="form-control" required=""></td>` +
        //     `<td><input type="number" name="" value="1" min="1" ` +
        //     `max="1000000" step="1" class="form-control" required=""></td></tr>`;

        let generateHtml = '';
        $.each(selectedValues, function (index, value) {
            generateHtml += `<tr><td><label for="" class="control-label">`+value+`</label></td>` +
            `<td><input type="number" name="" value="" min="0" step="0.01" class="form-control" required="">` +
            `</td><td><input type="text" name="" value="" class="form-control" required=""></td>` +
            `<td><input type="number" name="" value="1" min="1" ` +
            `max="1000000" step="1" class="form-control" required=""></td></tr>`;
        });

        $('#generateHtmlTable').html(generateHtml);
    });

</script>
@endsection
