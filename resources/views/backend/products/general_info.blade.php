<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    <h4>General Info</h4>
                    <hr>

                    <div class="row">
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

                        <div class="col-md-4 mb-3">
                            <label class="title-color" for="product_type">Product type</label>
                            <select class="form-select" name="product_type" id="product_type" required>
                                <option value="">Select A Type</option>
                                <option value="physical">Physical</option>
                                <option value="digital">Digital</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="title-color" for="brand_id">Brand</label>
                            <select class="form-select" name="brand_id" id="brand_id">
                                <option value="">Select A Brand</option>
                                @foreach ($brand as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="title-color" for="total_quantity">Total Quantity</label>
                            <input class="form-control" name="total_quantity" id="total_quantity" type="number" placeholder="Ex. 50" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="title-color" for="purchase_price">Purchase Price</label>
                            <input class="form-control" name="purchase_price" id="purchase_price" type="number" placeholder="Ex. 50">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="title-color" for="selling_price">Selling Price</label>
                            <input class="form-control" name="selling_price" id="selling_price" type="number" placeholder="Ex. 50">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="title-color" for="tax">Tax</label>
                            <input class="form-control" name="tax" id="tax" type="number" placeholder="Ex. 50">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="title-color" for="discount">Discount</label>
                            <input class="form-control" name="discount" id="discount" type="number" placeholder="Enter Discount">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="title-color" for="discount_type">Discount Type</label>
                            <select class="form-select" name="discount_type" id="discount_type">
                                <option value="">Select A Type</option>
                                <option value="flat">Flat</option>
                                <option value="percent">Percent</option>
                            </select>
                        </div>


                        <div class="col-md-4 mb-3">
                            <label class="title-color">Product Thumbnail</label>
                            <span class=""><span class="text-danger">*</span> ( Ratio 1:1 )</span>
                            <div class="custom-file text-left">
                                <input type="file" name="thumbnail" class="form-control" id="product_thumbnail" onchange="document.getElementById('thumbnail_view').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3 text-end">
                            <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="title-color">Thumbnail Preview</label>
                            <div class="img_box">
                                <img id="thumbnail_view" class="img-fluid"
                                    src="{{asset('storage/app/def.png')}}" alt="">
                                <div class="overly">
                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
