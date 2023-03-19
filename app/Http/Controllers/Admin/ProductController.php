<?php

namespace App\Http\Controllers\Admin;

use App\CustomClass\ImageUploadCustom;
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
        // $data = Product::all();
        $brand = Brand::all();
        $productAttribute = ProductAttribute::all();
        $color = Color::orderBy('name', 'ASC')->get();
        $category = Category::where('position','=', 0)->get();
        return view('backend.products.create',[
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


        $attrArr = [];
        if ($request->has('choice')) {
            foreach($request->choice as $key=>$item)
            {
                $i = $key;
                $choice_options_name = $request['choice_options_'.$i];
                $attrArr[] = [
                    'id'=>$request->attr[$i],
                    'name'=>$request->choice[$i],
                    'choice_options'=>$choice_options_name,
                ];
            }
        }


        $variant_data = [];
        $category_id = [];

        if ($request->has('variant_quantity')) {
            foreach ($request->variant_quantity as $key => $value) {
                $v_index = $key;

                if($request->variant_img[$v_index] != ''){
                    $variant_img_name = Str::slug($request->product_name) ."-img-".$v_index."-".Str::slug($request->variant_name[$v_index]).".".$request->variant_img[$v_index]->getClientOriginalExtension();
                    ImageUploadCustom::upload('product', $variant_img_name , $request->variant_img[$v_index]);
                    $location_v = 'storage/app/public/product/'.$variant_img_name;
                }else{
                    $location_v = 'storage/app/def.png';
                }

                $variant_data[] = [
                    'variant_name'=>$request->variant_name[$v_index],
                    'variant_color'=>$request->variant_color[$v_index],
                    'variant_price'=>$request->variant_price[$v_index],
                    'variant_sku'=>$request->variant_sku[$v_index],
                    'variant_quantity'=>$request->variant_quantity[$v_index],
                    'variant_img'=>$location_v,
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
        if($request->thumbnail != '')
        {
            $imageName = Str::slug($request->product_name).'-thumbnail-'.time().'.'.$request->thumbnail->extension();
            ImageUploadCustom::upload('product', $imageName , $request->thumbnail, 200);
            $location = 'product/'.$imageName;
        }else{
            $location = 'product/def.png';
        }

        $data = [
            'name'=>$request->product_name,
            'slug'=>Str::slug($request->product_name),
            'category_id'=>json_encode($category_id),
            'type'=>$request->product_type,
            'product_sku'=>Str::replace(' ', '', $request->product_sku),
            'colors'=>json_encode($request->colors),
            'attribute'=>json_encode($request->attr),
            'purchase_price'=>$request->purchase_price,
            'selling_price'=>$request->selling_price,
            'brand_id'=>$request->brand_id,
            'total_quantity'=>$request->total_quantity,
            'discount'=>$request->discount,
            'discount_type'=>$request->discount_type,
            'tax'=>$request->tax,
            'home_status'=>1,
            'thumbnail'=>$location,
            'variation'=>json_encode($variant_data),
            'choice_options'=>json_encode($attrArr),
            'description'=>$request->description,
            'created_at'=>Carbon::now(),
        ];

        Product::insert([
            'name'=>$request->product_name,
            'slug'=>Str::slug($request->product_name),
            'category_id'=>json_encode($category_id),
            'type'=>$request->product_type,
            'product_sku'=>Str::replace(' ', '', $request->product_sku),
            'colors'=>json_encode($request->colors),
            'attribute'=>json_encode($request->attr),
            'purchase_price'=>$request->purchase_price,
            'selling_price'=>$request->selling_price,
            'brand_id'=>$request->brand_id,
            'total_quantity'=>$request->total_quantity,
            'discount'=>$request->discount,
            'discount_type'=>$request->discount_type,
            'tax'=>$request->tax,
            'home_status'=>1,
            'thumbnail'=>$location,
            'variation'=>json_encode($variant_data),
            'choice_options'=>json_encode($attrArr),
            'description'=>$request->description,
            'created_at'=>Carbon::now(),
        ]);

        return $data;
        return $request->all();


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Product::where('id', $id)->first();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Product::where('id', $id)->first();
        // return $data;

        $brand = Brand::all();
        $productAttribute = ProductAttribute::all();
        $color = Color::orderBy('name', 'ASC')->get();
        $category = Category::where('position','=', 0)->get();
        $category_sub = Category::where('position','=', 1)->get();
        $category_sub_sub = Category::where('position','=', 2)->get();
        return view('backend.products.edit',[
            'data'=>$data,
            'brand'=>$brand,
            'color'=>$color,
            'category'=>$category,
            'category_sub'=>$category_sub,
            'category_sub_sub'=>$category_sub_sub,
            'productAttribute'=>$productAttribute,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $variant_data = [];
        $category_id = [];

        // if ($request->has('variant_quantity')) {
        //     foreach ($request->variant_quantity as $key => $value) {
        //         $v_index = $key;
        //         $variant_img_name = Str::slug($request->product_name) ."-img-".$v_index."-".Str::slug($request->variant_name[$v_index]).".".$request->variant_img[$v_index]->getClientOriginalExtension();
        //         ImageUploadCustom::upload('product', $variant_img_name , $request->variant_img[$v_index]);
        //         $location = 'storage/app/public/product/'.$variant_img_name;

        //         $variant_data[] = [
        //             'variant_name'=>$request->variant_name[$v_index],
        //             'variant_color'=>$request->variant_color[$v_index],
        //             'variant_price'=>$request->variant_price[$v_index],
        //             'variant_sku'=>$request->variant_sku[$v_index],
        //             'variant_quantity'=>$request->variant_quantity[$v_index],
        //             'variant_img'=>$location,
        //         ];
        //     }
        // }

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

        if($request->thumbnail != '')
        {
            $imageName = Str::slug($request->product_name).'-thumbnail-'.time().'.'.$request->thumbnail->extension();
            ImageUploadCustom::upload('product', $imageName , $request->thumbnail, 200);
            $location = 'product/'.$imageName;
        }else{
            $location = 'product/def.png';
        }

        Product::where('id', '=', $request->id)->update([
            'name'=>$request->product_name,
            'slug'=>Str::slug($request->product_name),
            'category_id'=>json_encode($category_id),
            'type'=>$request->product_type,
            'product_sku'=>Str::replace(' ', '', $request->product_sku),
            // 'colors'=>json_encode($request->colors),
            // 'attribute'=>json_encode($request->attr),
            'purchase_price'=>$request->purchase_price,
            'selling_price'=>$request->selling_price,
            'brand_id'=>$request->brand_id,
            'total_quantity'=>$request->total_quantity,
            'discount'=>$request->discount,
            'discount_type'=>$request->discount_type,
            'tax'=>$request->tax,
            // 'thumbnail'=>$location,
            // 'variation'=>json_encode($variant_data),
            'description'=>$request->description,
        ]);
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
