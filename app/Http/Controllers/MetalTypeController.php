<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MetalType;
use App\MetalPrice;


class MetalTypeController extends Controller
{
    public function index(Request $request)
    {
        $sort_search =null;
        $metal_types = MetalType::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $metal_types = $metal_types->where('name', 'like', '%'.$sort_search.'%');
        }
        $metal_types = $metal_types->paginate(15);
        return view('metaltype.index', compact('metal_types', 'sort_search'));
    }

    public function create()
    {
        return view('metaltype.create');
    }

    public function store(Request $request)
    {
        $metal_type = new MetalType;
        $metal_type->name = $request->name;

        if($metal_type->save()){
            flash(__('Metal has been inserted successfully'))->success();
            return redirect()->route('metaltypes.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function edit($id)
    {
        $metal_type = MetalType::findOrFail(decrypt($id));
        return view('metaltype.edit', compact('metal_type'));
    }

    public function update(Request $request, $id)
    {
        $metal_type = MetalType::findOrFail($id);
        $metal_type->name = $request->name;
        if($metal_type->save()){
            flash(__('Metal has been updated successfully'))->success();
            return redirect()->route('metaltypes.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function destroy($id)
    {
        $metal_type = MetalType::findOrFail($id);
        if(MetalType::destroy($id)){
            flash(__('Metal has been deleted successfully'))->success();
            return redirect()->route('metaltypes.index');
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
        $metal_type = MetalType::findOrFail($request->id);
        $metal_type->status = $request->status;
        if($metal_type->save()){
            return 1;
        }
        return 0;
    }

    public function getCaratName(Request $request)
    {
        $metal_name = MetalPrice::where('metal_id', $request->id)->get();
        return $metal_name;
    }

}