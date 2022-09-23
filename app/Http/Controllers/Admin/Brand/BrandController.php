<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Brand;

class BrandController extends Controller
{
    public function index(){
		$brands = Brand::all();
		return view('admin.brand.index',compact('brands'));
	}
	
	public function store(Request $request){
		$validate = $request->validate([
			'brand_name' => 'required',
			'brand_logo' => 'required',
		],[
			'brand_name.required' => 'Brand Name Is Required',
			'brand_logo.required' => 'Brand Logo Is Required',
			//'brand_logo.mimes' => 'Brand Logo Must In jpeg or png Format',
			//'brand_logo.size' => 'Brand Logo Must Max Size 1 MB',
		]);
		
		$image = $request->file('brand_logo');
		$name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = 'public/photos/brand/';
        $fullname = $destinationPath.$name;
        $upload = $image->move($destinationPath, $name);
		
		if($upload){
			$brand = new Brand();
			$brand->brand_name = $request->brand_name;
			$brand->brand_logo = $fullname;
			$brand->save();
			
			$notification = array(
        			'messege' => 'Brand Added Successfully',
        			'type' => 'success'
        		);
        	return redirect()->back()->with($notification);
		}else{
			$notification = array(
        			'messege' => 'Failed To Add New Brand',
        			'type' => 'error'
        		);
        		return redirect()->back()->with($notification);
		}
		
	}
}
