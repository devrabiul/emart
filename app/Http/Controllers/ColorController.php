<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

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

        array_push($arrayOfCombination, $request->colors);

        if ($request->has('attr') && count($request->attr)>0) {
            for ($i=1; $i <= count($request->attr); $i++) {
                $option_name_make = 'choice_options_'.$i;
                if (count($request[$option_name_make]) > 0) {
                    $newArr = implode('', $request[$option_name_make]);
                    array_push($arrayOfCombination, explode(',', $newArr));
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

        if ($result != '') {

            foreach ($result as $key => $color) {
                $colorData = Color::where('code','=',$color[0])->first();
                $variant_name = $colorData->name.'';

                foreach ($color as $key => $part) {
                    if($key>0){
                        $variant_name .= '-'.$part;
                    }
                }

                $colors .= '<tr><td><label for="" class="control-label">'.$variant_name.'</label></td>'.
                        '<td><input type="number" name="" value="" min="0" step="0.01" class="form-control" required=""></td>'.
                        '<td><input type="text" name="" value="'.$p_gen_name.'-'.$variant_name.'" class="form-control" required=""></td>'.
                        '<td><input type="number" name="" value="1" min="1" max="1000000" step="1" class="form-control" '.
                        'required=""></td></tr>';
            }
        }

        $html = '<table class="table table-bordered physical_product_show">'.
                '<thead>'.'<tr><td class="text-center">'.
                '<label for="" class="control-label">Variant</label>'.
                '</td>'.
                '<td class="text-center">'.
                '<label for="" class="control-label">Variant Price</label>'.
                '</td><td class="text-center">'.
                '<label for="" class="control-label">SKU</label>'.
                '</td><td class="text-center">'.
                '<label for="" class="control-label">Quantity</label>'.
                '</td</tr></thead>'.
                '<tbody id="generateHtmlTable">'.$colors.'</tbody></table>';

        // dd($html);
        // dd($result);


        return response()->json([
            // 'data'=>$request->all(),
            // 'arrayOfCombination'=>$arrayOfCombination,
            'html'=>$html,
        ]);
    }



}
