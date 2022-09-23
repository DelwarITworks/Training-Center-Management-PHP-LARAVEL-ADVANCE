<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\Brand;
use App\Model\Admin\Subcategory;
use App\Model\Admin\Product;
use DB;
use Image;

class ProductController extends Controller
{
    public function index(){
    	$categories = Category::all();
    	$brands = Brand::all();
    	return view('admin.product.create',compact('categories','brands'));
    }

    public function GetSubcat($cat_id){
    	$cat = DB::table('subcategories')->where('category_id',$cat_id)->get();
    	return json_encode($cat);

    }

    public function newProduct(Request $request){
    	$data = array();
    	$data['product_name'] = $request->product_name;
    	$data['product_code'] = $request->product_code;
    	$data['product_quantity'] = $request->product_quantity;
    	$data['category_id'] = $request->category_id;
    	$data['subcategory_id'] = $request->subcategory_id;
    	$data['brand_id'] = $request->brand_id;
    	$data['product_size'] = $request->product_size;
    	$data['product_color'] = $request->product_color;
    	$data['selling_price'] = $request->selling_price;
    	$data['product_details'] = $request->product_details;
    	$data['video_link'] = $request->video_link;
    	$data['main_slider'] = $request->main_slider;
    	$data['hot_deal'] = $request->hot_deal;
    	$data['best_rated'] = $request->best_rated;
    	$data['trend'] = $request->trend_product;
    	$data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
    	$data['buyone_getone'] = $request->buyone_getone;
    	$data['status'] = 1;

    	$image_one = $request->file('image_one');
    	$image_two = $request->file('image_two');
    	$image_three = $request->file('image_three');

    	if ($image_one && $image_two && $image_three) {
    		
    		$image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
    		Image::make($image_one)->resize(300,300)->save('public/photos/product/'.$image_one_name);
    		$data['image_one'] = 'public/photos/product/'.$image_one_name;

    		$image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
    		Image::make($image_two)->resize(300,300)->save('public/photos/product/'.$image_two_name);
    		$data['image_two'] = 'public/photos/product/'.$image_two_name;

    		$image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
    		Image::make($image_three)->resize(300,300)->save('public/photos/product/'.$image_three_name);
    		$data['image_three'] = 'public/photos/product/'.$image_three_name;
    	}
    	elseif ($image_one && $image_two) {
    		$image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
    		Image::make($image_one)->resize(300,300)->save('public/photos/product/'.$image_one_name);
    		$data['image_one'] = 'public/photos/product/'.$image_one_name;

    		$image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
    		Image::make($image_two)->resize(300,300)->save('public/photos/product/'.$image_two_name);
    		$data['image_two'] = 'public/photos/product/'.$image_two_name;
    	}
    	elseif ($image_one) {
    		$image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
    		Image::make($image_one)->resize(300,300)->save('public/photos/product/'.$image_one_name);
    		$data['image_one'] = 'public/photos/product/'.$image_one_name;
    	}
    	else{
    		$notification = array(
    			'messege' => 'Images Upload Failed',
    			'alert-type' => 'error',
    		);
    		return redirect()->back()->with($notification);
    	}

    	DB::table('products')->insert($data);
    	$notification = array(
    		'messege' => 'Product Added Successfully',
    		'alert-type' => 'success',
    	);
    	return redirect()->back()->with($notification);

    }

    public function allProduct(){
    	$products = DB::table('products')
    				->join('categories','products.category_id','categories.id')
    				->join('brands','products.brand_id','brands.id')
    				->select('products.*','categories.category_name','brands.brand_name')
    				->get();
    	return view('admin.product.view',compact('products'));
    }

    public function showProduct($id){
    	$product = DB::table('products')
    				->join('categories','products.category_id','categories.id')
    				->join('subcategories','products.subcategory_id','subcategories.id')
    				->join('brands','products.brand_id','brands.id')
    				->where('products.id',$id)
    				->first();
    	return view('admin.product.show',compact('product'));
    }

    public function deactiveProduct($id){
    	$deactive = DB::table('products')
    				->where('id',$id)
    				->update(['status' => 0]);
    	$notification = array(
    		'messege' => 'Product Deactive Successfully',
    		'alert-type' => 'success',
    	);
    	return redirect()->back()->with($notification);
    }

    public function activeProduct($id){
    	$deactive = DB::table('products')
    				->where('id',$id)
    				->update(['status' => 1]);
    	$notification = array(
    		'messege' => 'Product Active Successfully',
    		'alert-type' => 'success',
    	);
    	return redirect()->back()->with($notification);
    }

    public function deleteProduct($id){
    	$product = DB::table('products')
    				->where('id',$id)
    				->first();
    	if ($product->image_one && $product->image_two && $product->image_three) {
    		unlink($product->image_one);
    		unlink($product->image_two);
    		unlink($product->image_three);
    	}
    	elseif ($product->image_one && $product->image_two) {
    		unlink($product->image_one);
    		unlink($product->image_two);
    	}
    	else{
    		unlink($product->image_one);
    	}
    	DB::table('products')->where('id',$id)->delete();
    	$notification = array(
    		'messege' => 'Product Deleted Successfully',
    		'alert-type' => 'success',
    	);
    	return redirect()->back()->with($notification);
    }

    //change product
    public function updateProduct($id){
        $categories = Category::all();
        $brands = Brand::all();
        $product = DB::table('products')->where('id',$id)->first();
        return view('admin.product.update',compact('product','categories','brands'));
    }

    //save without image
    public function updateWithoutImage(Request $request,$id){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['selling_price'] = $request->selling_price;
        $data['product_details'] = $request->product_details;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend'] = $request->trend_product;
        $data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
        $data['buyone_getone'] = $request->buyone_getone;
        $data['status'] = $request->status;
        $data['discount_price'] = $request->discount_price;

        $product = DB::table('products')->where('id',$id)->update($data);
        $notification = array(
            'messege' => 'Product Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.all.product')->with($notification);
        
    }

    //update with image
    public function updateWithImage(Request $request,$id){
        $data = array();
        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');

        $oldone = $request->old_first;
        $oldtwo = $request->old_second;
        $oldthree = $request->old_third;

        if ($image_one && $image_two && $image_three) {
            
            unlink($oldone);
            unlink($oldtwo);
            unlink($oldthree);

            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('public/photos/product/'.$image_one_name);
            $data['image_one'] = 'public/photos/product/'.$image_one_name;

            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save('public/photos/product/'.$image_two_name);
            $data['image_two'] = 'public/photos/product/'.$image_two_name;

            $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save('public/photos/product/'.$image_three_name);
            $data['image_three'] = 'public/photos/product/'.$image_three_name;

            DB::table('products')->where('id',$id)->update($data);
            $notification = array(
                'messege' => 'Images Update Success',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
        elseif ($image_one && $image_two) {
            unlink($oldone);
            unlink($oldtwo);

            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('public/photos/product/'.$image_one_name);
            $data['image_one'] = 'public/photos/product/'.$image_one_name;

            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save('public/photos/product/'.$image_two_name);
            $data['image_two'] = 'public/photos/product/'.$image_two_name;

            DB::table('products')->where('id',$id)->update($data);
            $notification = array(
                'messege' => 'Images Update Success',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);

        }
        elseif ($image_one) {
            if ($oldone) {
                unlink($oldone);
            }
            
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('public/photos/product/'.$image_one_name);
            $data['image_one'] = 'public/photos/product/'.$image_one_name;

            DB::table('products')->where('id',$id)->update($data);
            $notification = array(
                'messege' => 'Images Update Success',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
        elseif ($image_two) {
            if ($oldtwo) {
               unlink($oldtwo);
            }

            $image_two_name = hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300,300)->save('public/photos/product/'.$image_two_name);
            $data['image_two'] = 'public/photos/product/'.$image_two_name;

            DB::table('products')->where('id',$id)->update($data);
            $notification = array(
                'messege' => 'Images Update Success',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);

        }
        elseif ($image_three) {
            if ($oldthree) {
                unlink($oldthree);
            }
            
            $image_three_name = hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300,300)->save('public/photos/product/'.$image_three_name);
            $data['image_three'] = 'public/photos/product/'.$image_three_name;

            DB::table('products')->where('id',$id)->update($data);
            $notification = array(
                'messege' => 'Images Update Success',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);

        }
        else{
            $notification = array(
                'messege' => 'Images Update Failed',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        

    }
}
