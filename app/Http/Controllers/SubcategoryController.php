<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
use Session;
use Validator;
use Response;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_categories = Subcategory::all();
        return view('admin.sub.list',compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.sub.add_edit',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();

        if (($request->category_id) == "") {
            Session::flash('flash_message','Please Select Category');
                return redirect()->back()->with('status_color','danger');
        } else {
            $validator = Validator::make($request->all(),[

             'subcategory_name'=>'required',
        ]);

        if ($validator->fails()) {    
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(),true);
            foreach($errorMessage as $value){
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message',$plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }
        $input = $request->all();
        $input['category_id'] = $request->category_id;
        $input['subcategory_name'] = $request->subcategory_name;
        

        try {
                $bug = 0;
                $insert = Subcategory::create($input);
                
            } catch (\Exception $e) {
                $bug = $e->errorInfo[1];
            }
            if ($bug==0) {
                Session::flash('flash_message','Sub Category Added Successfully.');
                return redirect('admin/subcategory')->with('status_color','success');
            } else {
                Session::flash('flash_message','Something Error Found');
                return redirect('admin/subcategory')->with('status_color','danger');
            }
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
    public function edit($id)
    {
        $id = \Crypt::decrypt($id);
        $single_subcategory = Subcategory::findOrFail($id);
        $categories = Category::all();
        return view('admin.sub.add_edit',compact('categories','single_subcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (($request->category_id) == "") {
            Session::flash('flash_message','Please Select Category');
                return redirect()->back()->with('status_color','danger');
        } else {
            $validator = Validator::make($request->all(),[

             'subcategory_name'=>'required',
        ]);

        if ($validator->fails()) {    
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(),true);
            foreach($errorMessage as $value){
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message',$plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }
        $update = Subcategory::findOrFail($id);
        $input = $request->all();
        $input['category_id'] = $request->category_id;
        $input['subcategory_name'] = $request->subcategory_name;
        

        try {
                $bug = 0;
                $update->update($input);
                
            } catch (\Exception $e) {
                $bug = $e->errorInfo[1];
            }
            if ($bug==0) {
                Session::flash('flash_message','Sub Category Added Successfully.');
                return redirect('admin/subcategory')->with('status_color','success');
            } else {
                Session::flash('flash_message','Something Error Found');
                return redirect('admin/subcategory')->with('status_color','danger');
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
