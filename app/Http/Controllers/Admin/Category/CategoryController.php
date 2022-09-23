<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\Subcategory;
use DB;

class CategoryController extends Controller
{
    public function index(){
		$categories = Category::all();
		return view('admin.category.index',compact('categories'));
	}
	
	//save category
	public function saveCategory(Request $request){
		$validate = $request->validate([
			'category_name' => 'required',
		],[
			'category_name.required' => 'Category Name Is Required',
		]);
		
		$category = new Category();
		$category->category_name = $request->category_name;
		$category->save();
		
		if($category){
	    	$notification = array(
	    		'messege' => 'Category Added Successfully',
	    		'alert-type' => 'success'
	    	);
	    	return redirect()->back()->with($notification);
	    }
	    else{
	    	$notification = array(
	    		'messege' => 'Failed To Add Category',
	    		'alert-type' => 'error'
	    	);
	    	return redirect()->back()->with($notification);
	    }
	}
	
	//change category
	public function changeCategory($id){
		$category = Category::findorfail($id);
		return view('admin.category.update',compact('category'));
	}
	
	//update category
	public function updateCategory(Request $request,$id){
		$validate = $request->validate([
			'category_name' => 'required',
		],[
			'category_name.required' => 'Category Name Is Required',
		]);
		$category = Category::find($id);
		$category->category_name = $request->category_name;
		$category->save();
		
		if($category){
	    	$notification = array(
	    		'messege' => 'Category Updated Successfully',
	    		'alert-type' => 'success'
	    	);
	    	return redirect()->route('admin.category')->with($notification);
	    }
	    else{
	    	$notification = array(
	    		'messege' => 'Failed To Update Category',
	    		'alert-type' => 'error'
	    	);
	    	return redirect()->back()->with($notification);
	    }
		
	}
	
	//delete category
	
	public function deleteCategory($id){
		$category = Category::find($id);
		$category->delete();
		if($category){
	    	$notification = array(
	    		'messege' => 'Category Deleted Successfully',
	    		'alert-type' => 'success'
	    	);
	    	return redirect()->route('admin.category')->with($notification);
	    }
	    else{
	    	$notification = array(
	    		'messege' => 'Failed To Delete Category',
	    		'alert-type' => 'error'
	    	);
	    	return redirect()->back()->with($notification);
	    }
		
	}
	
	//sub category
	public function subCate(){
		$categories = Category::all();
		$subcates = DB::table('subcategories')
							->join('categories','subcategories.category_id','categories.id')
							->get();
		return view('admin.category.subcategory',compact('categories','subcates'));
	}
	
	public function saveSubcategory(Request $request){
		$validate = $request->validate([
			'category' => 'required',
			'subcategory_name' => 'required',
		]);
		$subcategory = new Subcategory();
		$subcategory->subcategory_name = $request->subcategory_name;
		$subcategory->category_id = $request->category;
		$subcategory->save();
		$notification = array(
	    		'messege' => 'Sub-Category Successfully Added',
	    		'alert-type' => 'success'
	    	);
	    return redirect()->back()->with($notification);
	}
}
