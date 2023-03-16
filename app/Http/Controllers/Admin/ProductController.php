<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttribute;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::all();
        return view('backend.products.index',[
            'data'=>$data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Product::all();
        $brand = Brand::all();
        $productAttribute = ProductAttribute::all();
        $color = Color::orderBy('name', 'ASC')->get();
        $category = Category::where('position','=', 0)->get();
        return view('backend.products.create',[
            'data'=>$data,
            'brand'=>$brand,
            'color'=>$color,
            'category'=>$category,
            'productAttribute'=>$productAttribute,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $variant_data = [];
        $category_id = [];

        if ($request->has('variant_quantity')) {
            foreach ($request->variant_quantity as $key => $value) {
                $v_index = $key;
                $variant_data[] = [
                    'variant_name'=>$request->variant_name[$v_index],
                    'variant_price'=>$request->variant_price[$v_index],
                    'variant_sku'=>$request->variant_sku[$v_index],
                    'variant_quantity'=>$request->variant_quantity[$v_index],
                ];
            }
        }

        if ($request->has('category_id')) {
            foreach ($request->category_id as $key => $value) {
                if ($value != '') {
                    $v_index = $key+1;
                    $category_id[] = [
                        'id'=>$value,
                        'position'=>$v_index,
                    ];
                }
            }
        }

        $data = [
            'name'=>$request->product_name,
            'slug'=>Str::slug($request->product_name),
            'category_id'=>$category_id,
            'type'=>$request->product_type,
            'colors'=>$request->colors,
            'product_sku'=>Str::replace(' ', '', $request->product_sku),
            // 'purchase_price'=>$request->
            // 'selling_price'=>$request->
            // 'subcategory_id'=>$request->
            'brand_id'=>$request->brand_id,
            // 'priority'=>$request->
            // 'home_status'=>$request->
            // 'image'=>$request->
            'variation'=>$variant_data,
            'description'=>$request->description,
            'created_at'=>Carbon::now(),
        ];

        // return $request->all();
        // return $data;


        Product::insert([
            'name'=>$request->product_name,
            'slug'=>Str::slug($request->product_name),
            'category_id'=>json_encode($category_id),
            'type'=>$request->product_type,
            'product_sku'=>Str::replace(' ', '', $request->product_sku),
            // 'colors'=>$request->colors,
            // 'purchase_price'=>$request->
            // 'selling_price'=>$request->
            // 'subcategory_id'=>$request->
            'brand_id'=>$request->brand_id,
            'home_status'=>1,
            // 'image'=>$request->
            'variation'=>json_encode($variant_data),
            'description'=>json_decode($request->description),
            'created_at'=>Carbon::now(),
        ]);


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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();
        return back();
    }
}
