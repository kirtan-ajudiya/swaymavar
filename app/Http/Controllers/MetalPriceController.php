<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MetalPrice;
use App\MetalType;


class MetalPriceController extends Controller
{
    public function index(Request $request)
    {
        $sort_search =null;
        $metal_prices = MetalPrice::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $metal_prices = $metal_prices->where('name', 'like', '%'.$sort_search.'%');
        }
        $metal_prices = $metal_prices->paginate(15);
        return view('metalprice.index', compact('metal_prices', 'sort_search'));
    }

    public function create()
    {
        $metal_type = MetalType::all();
        return view('metalprice.create', compact('metal_type'));
    }

    public function store(Request $request)
    {
        $metal_price = new MetalPrice;
        $metal_price->name = $request->name;
        $metal_price->metal_id = $request->metal_id;
        $metal_price->metal_price = $request->price;

        if($metal_price->save()){
            flash(__('Metal Price has been inserted successfully'))->success();
            return redirect()->route('metalprices.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function edit($id)
    {

        $metal_type = MetalType::all();
        $metal_prices = MetalPrice::findOrFail(decrypt($id));
        return view('metalprice.edit', compact('metal_prices','metal_type' ));
    }

    public function update(Request $request, $id)
    {
        $metal_price = MetalPrice::findOrFail($id);
        $metal_price->name = $request->name;
        $metal_price->metal_id = $request->metal_id;
        $metal_price->metal_price = $request->price;
        if($metal_price->save()){
            flash(__('Metal Price has been updated successfully'))->success();
            return redirect()->route('metalprices.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function destroy($id)
    {
        $metal_type = MetalPrice::findOrFail($id);
        if(MetalPrice::destroy($id)){
            flash(__('Metal Price has been deleted successfully'))->success();
            return redirect()->route('metalprices.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function show($id)
    {
        //
    }

    public function updateFeatured(Request $request)
    {
        $metal_price = MetalPrice::findOrFail($request->id);
        $metal_price->status = $request->status;
        if($metal_price->save()){
            return 1;
        }
        return 0;
    }

}