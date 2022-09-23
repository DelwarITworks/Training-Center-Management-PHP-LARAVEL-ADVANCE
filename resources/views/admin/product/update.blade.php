@extends('layouts.adminpanel')
@section('admin_content')
	<div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
        	<form action="{{ route('admin.update.withoutimage',$product->id) }}" method="post" enctype="multipart/form-data">
        		@csrf
          <div class="row">
            <div class="col-lg">
            	<label>Product Name</label>
              <input class="form-control" placeholder="Product Name" value="{{ $product->product_name }}" name="product_name" type="text">
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Product Code</label>
              <input class="form-control" placeholder="Product Code" name="product_code" type="text" value="{{ $product->product_code }}">
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Product Quantity</label>
              <input class="form-control" placeholder="Product Quantity" name="product_quantity" type="text" value="{{ $product->product_quantity }}">
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Category</label>
              <select name="category_id" id="category_id" class="form-control">
              	@foreach($categories as $category)
              	<option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif>{{$category->category_name}}</option>
              	@endforeach
              </select>
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Sub Category</label>
              <select name="subcategory_id" class="form-control">
                @php
                  $subcategories = DB::table('subcategories')->where('category_id',$product->category_id)->get();
                @endphp
                @foreach($subcategories as $subcategory)
                <option value="{{$subcategory->id}}" @if($subcategory->id == $product->subcategory_id) selected @endif>{{$subcategory->subcategory_name}}</option>
                @endforeach
              </select>
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Brand</label>
              <select name="brand_id" class="form-control">
              	@foreach($brands as $brand)
              	<option value="{{$brand->id}}"  @if($brand->id == $product->brand_id) selected @endif>{{$brand->brand_name}}</option>
              	@endforeach
              </select>
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Product Size</label>
              <input type="text" data-role="tagsinput" class="form-control" name="product_size" value="{{ $product->product_size }}">
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Product Color</label>
              <input type="text" data-role="tagsinput" class="form-control" name="product_color" value="{{ $product->product_color }}">
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Selling Price</label>
              <input type="text" class="form-control" name="selling_price" value="{{ $product->selling_price }}">
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Discount Price</label>
              <input type="text" class="form-control" placeholder="Discount Price" name="discount_price" value="{{ $product->discount_price }}">
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Product Details</label>
              <textarea id="summernote" name="product_details">{{ $product->product_details }}</textarea>
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Video Price</label>
              <input type="text" class="form-control" placeholder="Video Link" name="video_link" value="{{ $product->video_link }}">
            </div><!-- col -->
          </div><!-- row -->

          

          <div class="row mg-t-20">
            <div class="col-lg-4">
              	<label class="ckbox">
			  		<input type="checkbox" name="main_slider" value="1" @if($product->main_slider == 1) checked @endif>
			  		<span>Main Slider</span>
				</label>
            </div><!-- col -->
            <div class="col-lg-4">
              	<label class="ckbox">
			  		<input type="checkbox" name="hot_deal" value="1" @if($product->hot_deal == 1) checked @endif>
			  		<span>Hot Deal</span>
				</label>
            </div><!-- col -->
            <div class="col-lg-4">
              	<label class="ckbox">
			  		<input type="checkbox" name="best_rated" value="1" @if($product->best_rated == 1) checked @endif>
			  		<span>Best Rated</span>
				</label>
            </div><!-- col -->
          </div><!-- row -->
          <div class="row mg-t-20">
            <div class="col-lg-4">
              	<label class="ckbox">
			  		<input type="checkbox" name="trend_product" value="1" @if($product->trend == 1) checked @endif>
			  		<span>Trend Product</span>
				</label>
            </div><!-- col -->
            <div class="col-lg-4">
              	<label class="ckbox">
			  		<input type="checkbox" name="mid_slider" value="1" @if($product->mid_slider == 1) checked @endif>
			  		<span>Mid Slider</span>
				</label>
            </div><!-- col -->
            <div class="col-lg-4">
              	<label class="ckbox">
			  		<input type="checkbox" name="hot_new" value="1" @if($product->hot_new == 1) checked @endif>
			  		<span>Hot New</span>
				</label>
            </div><!-- col -->
            <div class="col-lg-4">
                <label class="ckbox">
            <input type="checkbox" name="buyone_getone" value="1" @if($product->buyone_getone == 1) checked @endif>
            <span>Buy One Get One Free</span>
        </label>
            </div><!-- col -->
            <div class="col-lg-4">
                <label class="ckbox">
            <input type="checkbox" name="status" value="@if($product->status == 1) 1 @else 0 @endif" @if($product->status == 1) checked @endif>
            <span>Status</span>
        </label>
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg-4">
              	<input type="submit" value="Submit" class="btn btn-primary">
            </div><!-- col -->
          </div><!-- row -->
      </form>
        </div><!-- card -->
      </div><!-- sl-pagebody -->
      <div class="sl-pagebody">
        <div class="card pd-20 pd-sm-40">
          <form action="{{ route('admin.update.withimage',$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="row mg-t-20">
          <div class="col-lg-4">
            <label>Image One(Main Thumbnail)</label><br>
            <img src="{{ asset($product->image_one) }}" height="80px" width="80px">
            <label class="custom-file">
          <input type="file" id="file" name="image_one" class="custom-file-input">
          <span class="custom-file-control"></span>
          </label>
          </div><!-- col -->
          <div class="col-lg-4">
            <label>Image Two</label><br>
            <img src="{{ asset($product->image_two) }}" height="80px" width="80px">
            <label class="custom-file">
          <input type="file" id="file" name="image_two" class="custom-file-input">
          <span class="custom-file-control"></span>
          </label>
          </div><!-- col -->
          <div class="col-lg-4">
            <label>Image Three</label>
            <img src="{{ asset($product->image_three) }}" height="80px" width="80px">
            <label class="custom-file">
          <input type="file" id="file" name="image_three" class="custom-file-input">
          <span class="custom-file-control"></span>
          </label>
          </div><!-- col -->
          </div><!-- row -->
          <div class="row mt-3">
            <div class="col-lg-4">
              <input type="hidden" name="old_first" value="{{ $product->image_one }}">
              <input type="hidden" name="old_second" value="{{ $product->image_two }}">
              <input type="hidden" name="old_third" value="{{ $product->image_three }}">
            <button class="btn btn-primary" type="submit">Submit</button>
          </div><!-- col -->
          </div>
          </form>
        </div><!-- card -->
      </div><!-- sl-pagebody -->
	</div>

  
      
  
	
	<script src="{{asset('public/backend/lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('public/backend/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('public/backend/lib/bootstrap/bootstrap.js')}}"></script>

	<script type="text/javascript">
	  $(document).ready(function() {
         $('select[name="category_id"]').on('change', function(){
             var category_id = $(this).val();
             if(category_id) {
                 $.ajax({
                     url: "{{  url('admin/get/subcategory/') }}/"+category_id,
                     type:"GET",
                     dataType:"json",
                     success:function(data) {
                        var d =$('select[name="subcategory_id"]').empty();
                           $.each(data, function(key, value){

                               $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name + '</option>');

                           });
  
                     },
                    
                 });
             } else {
                 alert('danger');
             }

         });
     });

	</script>
	  
@endsection
