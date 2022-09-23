<?php

namespace App\Http\Controllers\Admin\Cupon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Cupon;

class CuponController extends Controller
{
    public function cupons(){
		$cupons = Cupon::all();
		return view('admin.cupon.cupons',compact('cupons'));
	}
	
	public function saveCupon(Request $request){
		
		$add = new Cupon();
		$add->cupon = $request->cupon;
		$add->discount = $request->discount;
		$add->save();
		$notification = array(
			'messege' => 'Cupon Added Successfully',
			'alert-type' => 'success'
		);
		return redirect()->back()->with($notification);
	}
	
	public function deleteCupon($id){
		$delete = Cupon::find($id);
		$delete->delete();
		$notification = array(
			'messege' => 'Cupon Deleted Successfully',
			'alert-type' => 'success'
		);
		return redirect()->back()->with($notification);
		
	}
}
