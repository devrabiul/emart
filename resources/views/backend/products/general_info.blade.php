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
                            <select class="form-select" name="product_type" id="product_type" required>
                                <option value="">Select A Type</option>
                                <option value="physical">Physical</option>
                                <option value="digital">Digital</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="title-color" for="brand_id">Brand</label>
                            <select class="form-select" name="brand_id" id="brand_id">
                                <option value="">Select A Brand</option>
                                @foreach ($brand as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="title-color" for="">Category</label>
                            <select class="form-select" name="category_id[]" id="category_id" required>
                                <option disabled="" selected="">Select A Category</option>
                                @foreach ($category as $item)
                                <option value="{{$item->id}}"><span class="color-preview"
                                        style="background-color:#9966CC;"></span> {{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="title-color" for="parent_id">Sub Category</label>

                            <select class="form-select" name="category_id[]" id="category_sub_id">
                                <option value="">Select Sub Category</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="title-color">Sub Sub Category Name<span
                                    class="text-danger">*</span></label>
                            <select class="form-select" name="category_id[]" id="category_sub_sub_id">
                                <option value="">Select Sub Sub Category</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="title-color">Product Thumbnail</label>
                            <span class=""><span class="text-danger">*</span> ( Ratio 1:1 )</span>
                            <div class="custom-file text-left">
                                <input type="file" name="product_thumbnail" class="form-control">

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
