@extends('layouts.backend.app')

@section('page_title', 'Sub Category')

@section('content')

<!-- Breadcrumb starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Sub Category
                        <small>Sub Category Edit</small>
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
                        <a href="{{route('admin.category.index')}}">
                            Category
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a href="{{route('admin.sub-category.index')}}">
                            Sub Category
                        </a>
                    </li>
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
                    <h4>Add Sub Category</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.sub-category.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <label class="title-color" for="priority">Parent Category</label>

                                <select class="form-select" name="parent_id" id="" required="">
                                    <option disabled="" selected="">Select A Category</option>
                                    @foreach ($category as $item)
                                        <option value="{{$item->id}}" {{($item->id == $data->parent_id? 'selected':'')}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="title-color">Sub Category Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Sub Category" value="{{$data->name}}"
                                    required="">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="title-color" for="priority">Priority</label>

                                <select class="form-select" name="priority" id="" required="">
                                    <option disabled="" selected="">Set Priority</option>
                                    @for ($i = 0; $i <= 10; $i++)
                                        <option value="{{$i}}" {{($data->priority ===  $i? 'selected':'')}} >{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="title-color">Sub Category Logo</label>
                                <span class=""><span class="text-danger">*</span> ( Ratio 1:1 )</span>
                                <div class="custom-file text-left">
                                    <input type="file" name="image" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-12 mb-3 text-end">
                                <a href="{{route('admin.sub-category.index')}}" class="btn btn-sm btn-danger">Back</a>
                                <button type="submit" class="btn btn-sm btn-success">Update</button>
                            </div>
                        </div>
                    </form>
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
