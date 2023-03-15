@extends('layouts.backend.app')

@section('page_title', 'Update Attribute')

@section('content')

<!-- Breadcrumb starts-->
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Attribute
                        <small>Update Attribute</small>
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
                    <li class="breadcrumb-item active">
                        <a href="{{route('admin.attribute.index')}}">
                            Attribute
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
                    <h4>Update Attribute</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.attribute.update')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="title-color">Attribute Name<span class="text-danger">*</span></label>
                                <input type="hidden" name="id" value="{{$data->id}}" required>
                                <input type="text" name="name" value="{{$data->name}}" class="form-control" placeholder="Attribute"
                                    required="">
                            </div>

                            <div class="col-md-12 mb-3 text-end">
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
