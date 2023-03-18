@extends('layouts.backend.app')

@section('page_title', 'Product List')

@section('content')

<!-- Breadcrumb starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Products
                        <small>Product List</small>
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
                    <div class="table-responsive table-desi">
                        <table class="table all-package table-category " id="datatableTable">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Type</th>
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

                                    <td class="text-left">
                                        Purchase Price : {{$item->purchase_price}}
                                        <br>
                                        Selling Price : {{$item->selling_price}}
                                    </td>

                                    <td>
                                        Physical
                                    </td>

                                    <td>
                                        <a class="px-1" href="{{route('admin.product.edit', $item->id)}}">
                                            <i class="fa fa-edit" title="Edit"></i>
                                        </a>

                                        <a class="px-1" href="{{route('admin.product.show', $item->id)}}">
                                            <i class="fa fa-eye" title="Edit"></i>
                                        </a>

                                        <a class="px-1 text-danger" href="{{route('admin.product.destroy', $item->id)}}">
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
