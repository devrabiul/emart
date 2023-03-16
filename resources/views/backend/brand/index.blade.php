@extends('layouts.backend.app')

@section('page_title', 'Brand')

@section('content')

<!-- Breadcrumb starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Brand
                        <small>Brand Setup</small>
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
                    <li class="breadcrumb-item active">Brand</li>
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
                <div class="card-header pt-4 pb-1">
                    <h4>Add Brand</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.brand.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="title-color">Brand Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter a name"
                                    required="">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="title-color">Brand Logo<span class="text-danger">*</span></label>
                                <input type="file" name="image" class="form-control">
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
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pt-5 pb-1">
                    <h4>Attribute list</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive table-desi">
                        <table class="table all-package table-category " id="datatableTable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $key=>$item)

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->slug}}</td>
                                    <td>
                                        <a class="px-1" href="{{route('admin.brand.edit', $item->id)}}">
                                            <i class="fa fa-edit" title="Edit"></i>
                                        </a>

                                        <a class="px-1 text-danger" href="{{route('admin.brand.destroy', $item->id)}}">
                                            <i class="fa fa-trash" title="Delete"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>
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
    $('#datatableTable').DataTable();

</script>
@endsection
