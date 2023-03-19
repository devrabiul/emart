<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
        //
    }

    public function getcolorname(Request $request)
    {
        // dd($request->colors);
        // dd(count($request->colors));

        $colornames = Color::whereIn('code', $request->colors)->pluck('name');
        return response()->json([
            'colornames'=>$colornames,
        ]);
    }


    public function updateFromController(Request $request)
    {

        $arrayOfCombination = [];
        $colors = '';
        $p_gen_name = '';

        if($request->product_name != '')
        {
            foreach (explode(' ', $request->product_name) as $word) {
                $p_gen_name .= substr($word, 0, 1);
            }
        }

        if ($request->has('colors')) {
            if (count($request->colors)>0) {
                array_push($arrayOfCombination, $request->colors);
            }
        }

        // if ($request->has('colors') && $request->has('attr')) {
        //     dd('Both Combination');
        // }

        // if (!$request->has('attr')) {
        //     dd('Only Color Combination');
        // }

        // if (!$request->has('colors')) {
        //     dd('Only Attr Combination');
        // }

        if ($request->has('attr') && count($request->attr)>0) {
            for ($i=0; $i <= count($request->attr); $i++) {
                $option_name_make = 'choice_options_'.$i;
                if ($request->has($option_name_make)) {
                    if (count($request[$option_name_make]) > 0) {
                        $newArr = implode('', $request[$option_name_make]);
                        array_push($arrayOfCombination, explode(',', $newArr));
                    }
                }
            }
        }

        $result = [[]];
        foreach ($arrayOfCombination as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, [$property => $property_value]);
                }
            }
            $result = $tmp;
        }

        // dd($request->colors);
        // dd($request->attr);
        $all_variant_price = [];
        $all_variant_quantity = [];
        if($request->has('all_variant_price'))
        {
            if($request->all_variant_price != '')
            {
                $all_variant_price = explode(',', $request->all_variant_price);
            }
            // dd($all_variant_price);
        }

        if($request->has('all_variant_quantity'))
        {
            if($request->all_variant_quantity != '')
            {
                $all_variant_quantity = explode(',', $request->all_variant_quantity);
            }
            // dd($all_variant_quantity);
        }


        foreach ($result as $key => $value) {

            $valueLenght = count($value);

            $variant_name = '';

            if ($value[0] != '') {
                $colorData = Color::where('code','=',$value[0])->first();
                if ($colorData) {
                    $variant_name_gen =  $colorData->name;
                    for ($i=1; $i < $valueLenght; $i++) {
                        $variant_name_gen .= ($value[$i] != ''?'-'.$value[$i]:'');
                    }
                    $variant_name = $colorData->name.$variant_name_gen;
                    $variant_color_code = $colorData->code;
                } else {
                    $variant_name_gen = '';
                    for ($i=0; $i < $valueLenght; $i++) {
                        $variant_name_gen .= ($value[$i] == $value[0]?$value[$i]:'-'.$value[$i]);
                    }
                    $variant_color_code = "mile na";
                }
            }

            if (isset($all_variant_price[$key])) {
                $price_gen = $all_variant_price[$key];
            } else {
                $price_gen = $request->selling_price;
            }
            if (isset($all_variant_quantity[$key])) {
                $quantity_gen = $all_variant_quantity[$key];
            } else {
                $quantity_gen = 1;
            }

            // dd($result);
            // dd($variant_name_gen);

            $colors .= '<tr><td><label for="" class="control-label">'.$variant_name_gen.'</label>'.
                            '<input type="hidden" value="'.$variant_name_gen.'" name="variant_name[]">'.
                            '<input type="hidden" value="'.$variant_color_code.'" name="variant_color[]"></td>'.
                        '<td><input type="number" name="variant_price[]" value="'.$price_gen.'" min="0" step="0.01" class="form-control" required=""></td>'.
                        '<td><input type="text" name="variant_sku[]" value="'.Str::upper($p_gen_name.$variant_name_gen).'" class="form-control" required=""></td>'.
                        '<td><input type="number" name="variant_quantity[]" value="'.$quantity_gen.'" min="1" max="1000000" step="1" class="form-control variants_quantity" '.
                        'required="" onchange="updateVariants_quantity()"></td>'.
                        '<td><input type="file" name="variant_img[]" class="form-control" ></td></tr>';
        }


        $combinationDiv = '<input type="hidden" value="'.count($result).'" name="variant_quantity">'.
                '<h5>Variants Table</h5>'.
                '<table class="table table-bordered physical_product_show">'.
                '<thead>'.'<tr><td class="text-center">'.
                '<label for="" class="control-label">Variant</label>'.
                '</td>'.
                '<td class="text-center">'.
                '<label for="" class="control-label">Variant Price</label>'.
                '</td><td class="text-center">'.
                '<label for="" class="control-label">SKU</label>'.
                '</td><td class="text-center">'.
                '<label for="" class="control-label">Quantity</label>'.
                '</td><td class="text-center">'.
                '<label for="" class="control-label">Image</label>'.
                '</td></tr></thead>'.
                '<tbody id="generateHtmlTable">'.$colors.'</tbody></table>';

        return response()->json([
            'html'=>$combinationDiv,
        ]);


        dd($colors);
        dd($result);


        $combinationDiv = '';

        $arrayOfCombination = [];
        $colors = '';



        $result = [[]];
        foreach ($arrayOfCombination as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, [$property => $property_value]);
                }
            }
            $result = $tmp;
        }

        if ($result != '') {
            foreach ($result as $key => $color) {
                // dd($result);
                $colorData = Color::where('code','=',$color[0])->first();

                $variant_name = $colorData->name;

                dd($color);
                foreach ($color as $key => $part) {
                    if($key>0){
                        $variant_name .= '-'.$part;
                    }
                }

                $colors .= '<tr><td><label for="" class="control-label">'.$variant_name.'</label>'.
                            '<input type="hidden" value="'.$variant_name.'" name="variant_name[]">'.
                            '<input type="hidden" value="'.$colorData->code.'" name="variant_color[]"></td>'.
                        '<td><input type="number" name="variant_price[]" value="" min="0" step="0.01" class="form-control" required=""></td>'.
                        '<td><input type="text" name="variant_sku[]" value="'.$p_gen_name.'-'.$variant_name.'" class="form-control" required=""></td>'.
                        '<td><input type="number" name="variant_quantity[]" value="1" min="1" max="1000000" step="1" class="form-control" '.
                        'required=""></td>'.
                        '<td><input type="file" name="variant_img[]" class="form-control" required=""></td></tr>';
            }
        }

        $combinationDiv = '<input type="hidden" value="'.count($result).'" name="variant_quantity">'.
                '<h5>Variants Table</h5>'.
                '<table class="table table-bordered physical_product_show">'.
                '<thead>'.'<tr><td class="text-center">'.
                '<label for="" class="control-label">Variant</label>'.
                '</td>'.
                '<td class="text-center">'.
                '<label for="" class="control-label">Variant Price</label>'.
                '</td><td class="text-center">'.
                '<label for="" class="control-label">SKU</label>'.
                '</td><td class="text-center">'.
                '<label for="" class="control-label">Quantity</label>'.
                '</td><td class="text-center">'.
                '<label for="" class="control-label">Image</label>'.
                '</td></tr></thead>'.
                '<tbody id="generateHtmlTable">'.$colors.'</tbody></table>';

        // dd($html);
        // dd($result);


        return response()->json([
            // 'data'=>$request->all(),
            // 'arrayOfCombination'=>$arrayOfCombination,
            'html'=>$combinationDiv,
        ]);
    }


}
