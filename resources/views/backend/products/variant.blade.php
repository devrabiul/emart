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
                                name="colors[]" multiple="multiple" id="color_box">
                                @foreach ($color as $item)
                                <option value="{{$item->code}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="title-color" for="">Attributes</label>
                            <select class="form-control js-example-basic-multiple js-states select2-custom-multiple"
                                name="attr[]" multiple="multiple" id="attributes_box">
                                @foreach ($productAttribute as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="attributes_area" id="attributes_area"></div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="col-12 form-group sku_comb_result" id="sku_comb_result">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
