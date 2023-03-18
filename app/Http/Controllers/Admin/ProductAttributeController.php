<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ProductAttribute::all();
        return view('backend.product-attribute.index',[
            'data'=>$data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);
        ProductAttribute::insert([
            'name'=>Str::title($request->name),
            'slug'=>Str::slug($request->name),
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = ProductAttribute::where('id', '=', $id)->first();
        return view('backend.product-attribute.edit',[
            'data'=>$data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        ProductAttribute::where('id', '=', $request->id)->update([
            'name'=>Str::title($request->name),
            'slug'=>Str::slug($request->name),
        ]);
        return redirect()->route('admin.attribute.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProductAttribute::findOrFail($id)->delete();
        return back();
    }


    public function attributes_box(Request $request)
    {
        $attributesHtml = '';
        if ($request->has('attributesValues') && count($request->attributesValues)>0) {
            foreach ($request->attributesValues as $key => $value) {
                $attr_name = ProductAttribute::where('id', '=',$value)->first();
                $a_serial = $key++;
                $attributesHtml .= '<div class="row my-2">'.
                                    '<div class="col-md-3 mb-2">'.
                                    '<input type="hidden" name="choice_no[]" value="'.$a_serial.'">'.
                                    '<input type="text" class="form-control" name="choice[]" value="'.$attr_name->name.'" readonly>'.
                                    '</div><div class="col-lg-9 mb-2">'.
                                    '<input type="text" class="form-control input_tagsinput" value="'.$request->choice_options.'" name="choice_options_'.$a_serial.'[]" '.
                                    'placeholder="Enter choice values" data-role="tagsinput" onchange="updateFromController()"></div></div>';
            }
        }
        return response()->json([
            'attributesHtml'=>$attributesHtml,
        ]);
    }


}
