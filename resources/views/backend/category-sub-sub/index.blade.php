@extends('layouts.backend.app')

@section('page_title', 'Sub Category')

@section('content')

<!-- Breadcrumb starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Sub Sub Category
                        <small>Sub Sub Category Setup</small>
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
                    <li class="breadcrumb-item active">Sub Sub Category</li>
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
                    <h4>Add Sub Sub Category</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.sub-sub-category.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="title-color" for="">Parent Category</label>

                                <select class="form-select" name="" id="category_id" required>
                                    <option disabled="" selected="">Select A Category</option>
                                    @foreach ($category as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="title-color" for="parent_id">Sub Category</label>

                                <select class="form-select" name="parent_id" id="parent_id" required>
                                    <option disabled="" selected="">Select Sub Category</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="title-color">Sub Sub Category Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Sub Category"
                                    required="">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="title-color" for="priority">Priority</label>

                                <select class="form-select" name="priority" id="" required="">
                                    <option disabled="" selected="">Set Priority</option>
                                    @for ($i = 0; $i <= 10; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
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
                    <h4>Sub Category list</h4>
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
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Priority</th>
                                    <th>Parent Category</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data as $key=>$item)

                                <tr>
                                    <td>{{$key+1}}</td>

                                    <td>
                                        <img src="{{asset('public/assets/backend')}}/images/dashboard/product/1.jpg" data-field="image" alt="">
                                    </td>

                                    <td>{{$item->name}}</td>

                                    <td>{{$item->priority}}</td>
                                    <td>{{$item->parent_id}}</td>

                                    <td>
                                        @if ($item->home_status == 0)
                                            <a href="{{route('admin.category.home_status',['id'=>$item->id, 'status'=>1])}}" class="btn btn-sm btn-success p-2">Active</a>
                                        @else
                                            <a href="{{route('admin.category.home_status',['id'=>$item->id, 'status'=>0])}}" class="btn btn-sm btn-danger p-2">Deactive</a>
                                        @endif
                                    </td>

                                    <td>
                                        <a class="px-1" href="{{route('admin.sub-category.edit', $item->id)}}">
                                            <i class="fa fa-edit" title="Edit"></i>
                                        </a>

                                        <a class="px-1 text-danger" href="{{route('admin.category.destroy', $item->id)}}">
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

<script>
    $('#category_id').on('change', function(){
        let category = $('#category_id').val();

        $.ajax({
            url:`{{route('admin.sub-sub-category.getcategory')}}`,
            method:"POST",
            type:"",
            data:{
                'category':category,
            },
            success:function(data){
                $('#parent_id').html(data.subCategory);
            },
        });
    });
</script>
@endsection
