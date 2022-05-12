<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MetalColor;


class MetalColorController extends Controller
{
    public function index(Request $request)
    {
        $sort_search =null;
        $metal_colors = MetalColor::orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $metal_colors = $metal_colors->where('color', 'like', '%'.$sort_search.'%');
        }
        $metal_colors = $metal_colors->paginate(15);
        return view('metalcolor.index', compact('metal_colors', 'sort_search'));
    }

    public function create()
    {
        return view('metalcolor.create');
    }

    public function store(Request $request)
    {
        $metal_color = new MetalColor;
        $metal_color->color = $request->color;
        $metal_color->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->color));
        if($metal_color->save()){
            flash(__('Metal Color has been inserted successfully'))->success();
            return redirect()->route('metalcolors.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function edit($id)
    {
        $metal_color = MetalColor::findOrFail(decrypt($id));
        return view('metalcolor.edit', compact('metal_color'));
    }

    public function update(Request $request, $id)
    {
        $metal_color = MetalColor::findOrFail($id);
        $metal_color->color = $request->color;
        $metal_color->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->color));
        if($metal_color->save()){
            flash(__('Metal Color has been updated successfully'))->success();
            return redirect()->route('metalcolors.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function destroy($id)
    {
        $metal_color = MetalColor::findOrFail($id);
        if(MetalColor::destroy($id)){
            flash(__('Metal Color has been deleted successfully'))->success();
            return redirect()->route('metalcolors.index');
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
        $metal_color = MetalColor::findOrFail($request->id);
        $metal_color->status = $request->status;
        if($metal_color->save()){
            return 1;
        }
        return 0;
    }

}