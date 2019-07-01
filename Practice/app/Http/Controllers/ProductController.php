<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Image;

class ProductController extends Controller
{
    function addproductview(){
    	//return view('product/view');

    	$products= Product::paginate(5);
        $deleted_products=Product::onlyTrashed()->get();
    	return view('product/view',compact('products','deleted_products'));
    }

    function addproductinsert(Request $request){

        


        $request->validate([
            'product_name'=>'required|',
            'product_description'=>'required',
            'product_price'=>'required|numeric',
            'product_quantity'=>'required|numeric',
            'alert_quantity'=>'required|numeric',

        ]);
    
    	$last_inserted_id = Product::insertGetId([
    			'product_name'=>$request->product_name,
    			'product_description'=>$request->product_description,
    			'product_price'=>$request->product_price,
    			'product_quantity'=>$request->product_quantity,
    			'alert_quantity'=>$request->alert_quantity,
    	]);


        if($request->hasFile('product_image')){

            $photo_to_upload=$request->product_image;
            //  print_r($photo_to_upload->getClientOriginalExtension()); //printing the file extention
             $filename=$last_inserted_id.".".$photo_to_upload->getClientOriginalExtension();
             //echo $filename;
             Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$filename));

             Product::find($last_inserted_id)->update([

                    'product_image'=>$filename
             ]);

        }

    				return back()->with('status','Product Inserted Successfully');
    }

    function deleteproduct($product_id){
        //echo $product_id;
        Product::where('id',$product_id)->delete();
        return back()->with('deletestatus','Product Deleted Successfully');
    }

    function editproduct($product_id){
       // return view('product/edit');
        $single_product_info= Product::findOrFail($product_id);
        return view('product/edit',compact('single_product_info'));
    }

    function editproductinsert(Request $request){

        $request->validate([
            'product_name'=>'required|',
            'product_description'=>'required',
            'product_price'=>'required|numeric',
            'product_quantity'=>'required|numeric',
            'alert_quantity'=>'required|numeric',

        ]);


        Product::find($request->product_id)->update([
                'product_name'=>$request->product_name,
                'product_description'=>$request->product_description,
                'product_price'=>$request->product_price,
                'product_quantity'=>$request->product_quantity,
                'alert_quantity'=>$request->alert_quantity
        ]);

        return back()->with('editstatus','Product Edited Successfully');
    }

    function productdetails($product_id){

    //echo "$product_id";
        $single_product_info=Product::find($product_id);
        $related_products=Product::where('id','!=',$product_id)->get();
        return view('frontend/productdetails',compact('single_product_info','related_products'));

  }

  function restoreproduct($product_id){
    //echo "string";
    Product::onlyTrashed()->where('id',$product_id)->restore();
    return back()->with('restorestatus','Product Restored Successfully');

  } 

  function forcedeleteproduct($product_id){
   // echo "string";
    Product::onlyTrashed()->find($product_id)->forceDelete();
    return back()->with('forcedeletestatus','Product Deleted Successfully');
  }
}