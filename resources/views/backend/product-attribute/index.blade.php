@extends('layouts.backend.app')

@section('page_title', 'Products Attribute')

@section('content')

<!-- Breadcrumb starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Products Attribute
                        <small>Products Attribute Setup</small>
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
                    <li class="breadcrumb-item active">Products Attribute</li>
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
                    <h4>Add Products Attribute</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.attribute.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="title-color">Attribute Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Attribute"
                                    required="">
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
                    <h4>Total : </h4>
                    {{-- <a class="btn btn-success mt-md-0 mt-2">Add
                        Category</a> --}}
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
                                        <a class="px-1" href="{{route('admin.attribute.edit', $item->id)}}">
                                            <i class="fa fa-edit" title="Edit"></i>
                                        </a>

                                        <a class="px-1 text-danger" href="{{route('admin.attribute.destroy', $item->id)}}">
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
