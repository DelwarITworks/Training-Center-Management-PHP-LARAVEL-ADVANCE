<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Model\Admin\Postcategory;
use App\Model\Admin\Post;

class PostController extends Controller
{
    public function index(){
    	$posts = DB::table('postcategories')->get();
    	return view('admin.post.index',compact('posts'));
    }

    public function newPost(Request $request){
    	$data = array();
    	$data['category_name_en'] = $request->category_name_en;
    	$data['category_name_bn'] = $request->category_name_bn;
    	$category = DB::table('postcategories')->insert($data);

    	$notification = array(
    		'messege' => 'Post Category Added Successfully',
    		'alert-type' => 'success',
    	);
    	return redirect()->back()->with($notification);
    }

    public function changePostCat($id){
    	$category = DB::table('postcategories')->where('id',$id)->first();
    	return view('admin.post.edit',compact('category'));
    }

    public function updatePostCat(Request $request, $id){
    	$data = array();
    	$data['category_name_en'] = $request->category_name_en;
    	$data['category_name_bn'] = $request->category_name_bn;

    	$update = DB::table('postcategories')->where('id',$id)->update($data);
    	$notification = array(
    		'messege' => 'Post Category Updated Successfully',
    		'alert-type' => 'success',
    	);
    	return redirect()->route('admin.post.category')->with($notification);
    }

    public function AllPost(){
        $posts = DB::table('posts')->join('postcategories','posts.category_id','postcategories.id')->get();
        return view('admin.post.all',compact('posts'));
    }

    public function CreatePost(){
        $categories = Postcategory::all();
        return view('admin.post.create',compact('categories'));
    }
    
    public function SavePost(Request $request){
        $data = array();
        $data['post_title_en'] = $request->post_title_en;
        $data['post_title_bn'] = $request->post_title_bn;
        $data['post_description_en'] = $request->product_details_en;
        $data['post_description_bn'] = $request->product_details_bn;
        $data['category_id'] = $request->category_id;
        DB::table('posts')->insert($data);
        $notification = array(
            'messege' => 'Post Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.post')->with($notification);
    }
}
