<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JewelleryType;


class JewelleryTypeController extends Controller
{
    public function index(Request $request)
    {
        $sort_search =null;
        $jewellery_types = JewelleryType::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $jewellery_types = $jewellery_types->where('name', 'like', '%'.$sort_search.'%');
        }
        $jewellery_types = $jewellery_types->paginate(15);
        return view('jewellery_type.index', compact('jewellery_types', 'sort_search'));
    }

    public function create()
    {
        return view('jewellery_type.create');
    }

    public function store(Request $request)
    {
        $jewellery_type = new JewelleryType;
        $jewellery_type->name = $request->name;

        if($jewellery_type->save()){
            flash(__('Jewellery Type has been inserted successfully'))->success();
            return redirect()->route('jewellery_types.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function edit($id)
    {
        $jewellery_type = JewelleryType::findOrFail(decrypt($id));
        return view('jewellery_type.edit', compact('jewellery_type'));
    }

    public function update(Request $request, $id)
    {
        $jewellery_type = JewelleryType::findOrFail($id);
        $jewellery_type->name = $request->name;
        if($jewellery_type->save()){
            flash(__('Jewellery Type has been updated successfully'))->success();
            return redirect()->route('jewellery_types.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function destroy($id)
    {
        $jewellery_type = JewelleryType::findOrFail($id);
        if(JewelleryType::destroy($id)){
            flash(__('Jewellery Type has been deleted successfully'))->success();
            return redirect()->route('jewellery_types.index');
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
        $jewellery_type = JewelleryType::findOrFail($request->id);
        $jewellery_type->status = $request->status;
        if($jewellery_type->save()){
            return 1;
        }
        return 0;
    }

}