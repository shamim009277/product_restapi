<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Brand;
use App\Category;
use App\Subcategory;
use Session;
use Validator;
use Response;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $brands = Cache('brands' ,function(){
            return Brand::with('category','subcategory')->orderBy('id','desc')->get();
        });
        //$brands=Brand::with('category','subcategory')->get();
        return view('admin.brand.list',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.brand.add_edit',compact('categories','subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (($request->category_id) == "") {
            Session::flash('flash_message','Please Select Category');
                return redirect()->back()->with('status_color','danger');
        } elseif(($request->subcategory_id) == "") {
            Session::flash('flash_message','Please Select Sub Category');
                return redirect()->back()->with('status_color','danger');
        }else{

             $validator = Validator::make($request->all(),[

             'brand_name'=>'required',
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

        try {
                $bug = 0;
                $insert = Brand::create($input);
                
            } catch (\Exception $e) {
                $bug = $e->errorInfo[1];
            }
            if ($bug==0) {
                Session::flash('flash_message','Brand Added Successfully.');
                return redirect('admin/brand')->with('status_color','success');
            } else {
                Session::flash('flash_message','Something Error Found');
                return redirect('admin/brand')->with('status_color','danger');
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
        $single_brand = Brand::findOrFail($id);
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('admin.brand.add_edit',compact('single_brand','categories','subcategories'));
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
        } elseif(($request->subcategory_id) == "") {
            Session::flash('flash_message','Please Select Sub Category');
                return redirect()->back()->with('status_color','danger');
        }else{

             $validator = Validator::make($request->all(),[

             'brand_name'=>'required',
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
        $update = Brand::findOrFail($id);
        $input = $request->all();
        
        try {
                $bug = 0;
                $update->update($input);
                
            } catch (\Exception $e) {
                $bug = $e->errorInfo[1];
            }
            if ($bug==0) {
                Session::flash('flash_message','Brand Updated Successfully.');
                return redirect('admin/brand')->with('status_color','success');
            } else {
                Session::flash('flash_message','Something Error Found');
                return redirect('admin/brand')->with('status_color','danger');
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
