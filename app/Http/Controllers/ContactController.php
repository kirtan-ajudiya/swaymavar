<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $contacts = Contact::orderBy('status', 'asc')->orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $contacts = $contacts->where('first_name', 'like', '%'.$sort_search.'%')->orWhere('phone', 'like', '%'.$sort_search.'%')->orWhere('email', 'like', '%'.$sort_search.'%');
        }
        $contacts = $contacts->paginate(15);
        Contact::where('view', '=', 1)->update(['view' => 0]);
        return view('contacts.index', compact('contacts', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('contacts.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'number' => 'required',
            'email' => 'required',
            'message' => 'required',

        ]);
        $contact = new Contact;
        $contact->name = $request->name;
        $contact->phone = $request->number;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->view = 1;
        if($contact->save()){
            flash(__('Thanks We will contact soon. '))->success();
            return back();
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $brand = Brand::findOrFail(decrypt($id));
    //     return view('brands.edit', compact('brand'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $brand = Brand::findOrFail($id);
    //     $brand->name = $request->name;
    //     $brand->meta_title = $request->meta_title;
    //     $brand->meta_description = $request->meta_description;
    //     if ($request->slug != null) {
    //         $brand->slug = str_replace(' ', '-', $request->slug);
    //     }
    //     else {
    //         $brand->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name)).'-'.str_random(5);
    //     }
    //     if($request->hasFile('logo')){
    //         $brand->logo = $request->file('logo')->store('uploads/brands');
    //     }

    //     if($brand->save()){
    //         flash(__('Brand has been updated successfully'))->success();
    //         return redirect()->route('brands.index');
    //     }
    //     else{
    //         flash(__('Something went wrong'))->error();
    //         return back();
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        if(Contact::destroy($id)){
            flash(__('Contact has been deleted successfully'))->success();
            return redirect()->route('contacts.index');
        }
        else{
            flash(__('Something went wrong'))->error();
            return back();
        }
    }

    public function update_status(Request $request)
    {
        $question = Contact::findOrFail($request->id);
        $question->status = $request->status;
        if($question->save()){
            return 1;
        }
        return 0;
    }
}
