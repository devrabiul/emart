@extends('layouts.backend.app')

@section('page_title', 'Category')

@section('content')

<!-- Breadcrumb starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Category
                        <small>Category Setup</small>
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
                    <li class="breadcrumb-item active">Category</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Ends-->


<!-- Main Container Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header pt-4 pb-1">
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data"
                        id="ajaxFormStore">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="title-color">Category Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="New Category"
                                    required="">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="title-color" for="priority">Priority</label>

                                <select class="form-select" name="priority" id="">
                                    <option value="">Set Priority</option>
                                    @for ($i = 0; $i <= 10; $i++) <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="title-color">Category Logo</label>
                                <span class=""><span class="text-danger">*</span> ( Ratio 1:1 )</span>
                                <div class="custom-file text-left">
                                    <input type="file" name="picture" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-end">
                                <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header pt-5 pb-1">
                    <h4>Category list</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-desi">
                        <table class="table all-package table-category " id="datatableTable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Container End -->



@endsection


@section('custom_js')

<script>
    $('#datatableTable').DataTable({
        ajax: {
            type: "get",
            url: `{{route('admin.category.auto_data_in_json')}}`,
            dataSrc: ''
        },
        columns: [{
                data: null,
                render: function (data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {
                "data": function (data, type) {
                    return `<img class="img-thumbnail w-50" src="` + data.picture +
                        `" alt="` + data.picture + `">`;
                }
            },
            {
                data: 'name'
            },
            {
                data: 'priority'
            },
            {
                data: function (data) {
                    return `<button name="status" class="home_status" onclick="status_change(` +
                        data.id + `)">` +
                        (data.home_status == 1 ? '<i class="fa fa-toggle-on"></i>' :
                            '<i class="fa fa-toggle-off"></i>') +
                        `</button>`;
                }
            },
            // {
            //     "data": function (data, type) {
            //         return `<a class="pswp" href="../application/upload/products/` + data.picture + `" itemprop="contentUrl" data-size="1600x950">
            //             <img class="img-thumbnail" src="../application/upload/products/` + data.picture +
            //             `" itemprop="thumbnail" alt="Image description"></a>`;
            //     }
            // },
            {
                "data": null, // (data, type, row)
                className: "text-center",
                render: function (data) {
                    return `<button class="border-0 btn-sm btn-info me-2" onclick="cat_edit('` +
                        data.id + `','` + data.name + `','` + data.category_id +
                        `')"><i class="fa fa-edit"></i></button>` +
                        `<button class="border-0 btn-sm btn-danger me-2" onclick="data_destroy('` +
                        data.id + `')"><i class="fa fa-trash"></i></button>`;
                },
            },
        ]
    });

</script>

<script>
    /* Data Destroy || Start */
    $('#ajaxFormStore').on('submit', function (e) {
        e.preventDefault();
        // alert('Ho');
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            dataType: 'json',
            processData: false,
            contentType: false,
            beforeSend: function () {

            },
            success: function (data) {
                $('input, select, textarea').val('');
                $('#datatableTable').DataTable().ajax.reload();
                notyf.success('Add successfully.');
            },
            error: function (request, status, error) {
                notyf.error(request.responseJSON.message);
            }
        });
    });
    /* Data Destroy || End */

</script>

<script>
    /* Data Destroy || Start */
    function data_destroy(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: `{{route('admin.category.destroy')}}`,
                    data: {
                        "id": id,
                    },
                    success: function (data) {
                        $('#datatableTable').DataTable().ajax.reload();
                        notyf.success('Delete successfully.');
                    },
                    error: function (request, status, error) {
                        notyf.error('Delete Unsuccessful.');
                    }
                });
            }
        })
    }
    /* Data Destroy || End */

</script>

<script>
    function status_change(id) {
        $.ajax({
            type: "POST",
            url: `{{route('admin.category.status-change')}}`,
            data: {
                "id": id,
            },
            success: function (data) {
                $('#datatableTable').DataTable().ajax.reload();
                notyf.success('Update successfully.');
            },
            error: function (request, status, error) {
                notyf.error('Update Unsuccessful.');
            }
        });
    }

    /* Data Destroy || End */

</script>

@endsection
