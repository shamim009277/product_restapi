<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Brand;
use App\Category;
use App\Subcategory;
use Session;
use Validator;
use Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.list');
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
        $brands = Brand::all();
        return view('admin.product.add_edit',compact('categories','subcategories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->all();


        /*$validator = Validator::make($request->all(),[

             'name'=>'required|min:3',
             'details'=>'required',
             'base_price'=>'required|regex:/^[0-9]/',
             'image'=>'required',
             'category_id'=>'required',
             'subcategory_id'=>'required',
             'brand_id'=>'required',
            
        ],
        [
            'category_id.required' => 'Please select A Product Brand',
            'subcategory_id.required' => 'Please select A Product Brand',
            'brand_id.required' => 'Please select A Product Brand',
        ]
    );

        if ($validator->fails()) {    
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(),true);
            foreach($errorMessage as $value){
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message',$plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }
*/
        $input = $request->all();
        $input['name'] = $request->name;
        $input['category_id'] = $request->category_id;
        $input['subcategory_id'] = $request->subcategory_id;
        $input['brand_id'] = $request->brand_id;
        $input['details'] = $request->details;
        $input['base_price'] = $request->base_price;

        $image = $request->file('image');
        if ($image) {
            $ext = strtolower($image->getClientOriginalExtension());
            $imageName = uniqid().".".$ext;
            $path = 'images/products/';
            $image_url = $path.$imageName;
            $success = $image->move($path,$imageName);
            if ($success) {
                $input['image'] = $imageName;
            } else {
                $input['image'] = 'default.png';
            }         
        
            try {
                $bug = 0;
                $id = Product::create($input)->id;

            if (!empty($id)) {

                $price = $request->extended_price;
                foreach ($price as $key=>$price) {
                  $data = array();
                  $data['product_id'] = $id;
                  $data['size'] = $request->size[$key];      
                  $data['extended_price'] =$price;

                  DB::table('variations')->insert($data);
                }
            }
     
            } catch (\Exception $e) {
                $bug = $e->errorInfo[1];
            }
            if ($bug==0) {
                Session::flash('flash_message','Brand Added Successfully.');
                return redirect('admin/products')->with('status_color','success');
            } else {
                Session::flash('flash_message','Something Error Found');
                return redirect('admin/products')->with('status_color','danger');
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
        //
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
        //
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
