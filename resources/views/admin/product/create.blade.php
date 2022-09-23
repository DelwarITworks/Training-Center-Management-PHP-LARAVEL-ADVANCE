@extends('layouts.adminpanel')
@section('admin_content')
	<div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
        	<form action="{{ route('admin.new.product') }}" method="post" enctype="multipart/form-data">
        		@csrf
          <div class="row">
            <div class="col-lg">
            	<label>Product Name</label>
              <input class="form-control" placeholder="Product Name" name="product_name" type="text">
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Product Code</label>
              <input class="form-control" placeholder="Product Code" name="product_code" type="text">
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Product Quantity</label>
              <input class="form-control" placeholder="Product Quantity" name="product_quantity" type="text">
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Category</label>
              <select name="category_id" id="category_id" class="form-control">
              	@foreach($categories as $category)
              	<option value="{{$category->id}}">{{$category->category_name}}</option>
              	@endforeach
              </select>
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Sub Category</label>
              <select name="subcategory_id" class="form-control">

              </select>
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Brand</label>
              <select name="brand_id" class="form-control">
              	@foreach($brands as $brand)
              	<option value="{{$brand->id}}">{{$brand->brand_name}}</option>
              	@endforeach
              </select>
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Product Size</label>
              <input type="text" data-role="tagsinput" class="form-control" name="product_size">
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Product Color</label>
              <input type="text" data-role="tagsinput" class="form-control" name="product_color">
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Selling Price</label>
              <input type="text" class="form-control" name="selling_price">
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Product Details</label>
              <textarea id="summernote" name="product_details"></textarea>
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Video Price</label>
              <input type="text" class="form-control" placeholder="Video Link" name="video_link">
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg-4">
            	<label>Image One(Main Thumbnail)</label>
              <label class="custom-file">
				  <input type="file" id="file" name="image_one" class="custom-file-input">
				  <span class="custom-file-control"></span>
			  </label>
            </div><!-- col -->
            <div class="col-lg-4">
            	<label>Image Two</label>
              <label class="custom-file">
				  <input type="file" id="file" name="image_two" class="custom-file-input">
				  <span class="custom-file-control"></span>
			  </label>
            </div><!-- col -->
            <div class="col-lg-4">
            	<label>Image Three</label>
              <label class="custom-file">
				  <input type="file" id="file" name="image_three" class="custom-file-input">
				  <span class="custom-file-control"></span>
			  </label>
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg-4">
              	<label class="ckbox">
			  		<input type="checkbox" name="main_slider" value="1">
			  		<span>Main Slider</span>
				</label>
            </div><!-- col -->
            <div class="col-lg-4">
              	<label class="ckbox">
			  		<input type="checkbox" name="hot_deal" value="1">
			  		<span>Hot Deal</span>
				</label>
            </div><!-- col -->
            <div class="col-lg-4">
              	<label class="ckbox">
			  		<input type="checkbox" name="best_rated" value="1">
			  		<span>Best Rated</span>
				</label>
            </div><!-- col -->
          </div><!-- row -->
          <div class="row mg-t-20">
            <div class="col-lg-4">
              	<label class="ckbox">
			  		<input type="checkbox" name="trend_product" value="1">
			  		<span>Trend Product</span>
				</label>
            </div><!-- col -->
            <div class="col-lg-4">
              	<label class="ckbox">
			  		<input type="checkbox" name="mid_slider" value="1">
			  		<span>Mid Slider</span>
				</label>
            </div><!-- col -->
            <div class="col-lg-4">
              	<label class="ckbox">
			  		<input type="checkbox" name="hot_new" value="1">
			  		<span>Hot New</span>
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
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> --}}
	