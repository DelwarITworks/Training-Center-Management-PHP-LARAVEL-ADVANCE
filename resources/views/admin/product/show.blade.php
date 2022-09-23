@extends('layouts.adminpanel')
@section('admin_content')
	<div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
          <div class="row">
            <div class="col-lg">
            	<label>Product Name</label>
              	<br><strong>{{ $product->product_name }}</strong>
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Product Code</label>
              <br><strong>{{ $product->product_code}}</strong>
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Product Quantity</label>
              <br><strong>{{ $product->product_quantity }}</strong>
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Category</label>
              <br><strong>{{ $product->category_name }}</strong>
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Sub Category</label>
	             <br><strong>{{ $product->subcategory_name }}</strong>
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Brand</label>
             	<br><strong>{{ $product->brand_name }}</strong>
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Product Size</label>
              <br><strong>{{ $product->product_size }}</strong>
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Product Color</label>
              <br><strong>{{ $product->product_color }}</strong>
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
            	<label>Selling Price</label>
              <br><strong>{{ $product->selling_price }}</strong>
            </div><!-- col -->
            <div class="col-lg mg-t-10 mg-lg-t-0">
              <label>Discount Price</label>
              <br><strong>{{ $product->discount_price }}</strong>
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg" style="padding:10px;border:1px solid black;">
              <label>Product Details</label>
              <br><strong>{!! $product->product_details !!}</strong>
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Video Link</label>
              <a href="{{ $product->video_link }}" target="_blank">Show Video</a>
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg-4">
            	<label>Image One(Main Thumbnail)</label>
              <label class="custom-file">
				  <img src="{{ asset($product->image_one) }}" height="50px" width="50px">
			  </label>
            </div><!-- col -->
            <div class="col-lg-4">
            	<label>Image Two</label>
              <label class="custom-file">
				  <img src="{{ asset($product->image_two) }}" height="50px" width="50px">
			  </label>
            </div><!-- col -->
            <div class="col-lg-4">
            	<label>Image Three</label>
              <label class="custom-file">
				  <img src="{{ asset($product->image_three) }}" height="50px" width="50px">
			  </label>
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg-4">
              	<label class="">
			  		<span>Main Slider |</span>
			  		@if($product->main_slider == 1)
			  			<span class="badge badge-success">Active</span> |
			  		@else
			  			<span class="badge badge-danger">Deative</span> |
			  		@endif
				</label>
            </div><!-- col -->
            <div class="col-lg-4">
              	<label class="">
			  		<span>Hot Deal |</span>
			  		@if($product->hot_deal == 1)
			  			<span class="badge badge-success">Active</span> |
			  		@else
			  			<span class="badge badge-danger">Deative</span> |
			  		@endif
				</label>
            </div><!-- col -->
            <div class="col-lg-4">
              	<label class="">
			  		<span>Best Rated |</span>
			  		@if($product->best_rated == 1)
			  			<span class="badge badge-success">Active</span> |
			  		@else
			  			<span class="badge badge-danger">Deative</span> |
			  		@endif
				</label>
            </div><!-- col -->
          </div><!-- row -->
          <div class="row mg-t-20">
            <div class="col-lg-4">
              	<label class="">
			  		<span>Trend Product |</span>
			  		@if($product->trend == 1)
			  			<span class="badge badge-success">Active</span> |
			  		@else
			  			<span class="badge badge-danger">Deative</span> |
			  		@endif
				</label>
            </div><!-- col -->
            <div class="col-lg-4">
              	<label class="">
			  		<span>Mid Slider |</span>
			  		@if($product->mid_slider == 1)
			  			<span class="badge badge-success">Active</span> |
			  		@else
			  			<span class="badge badge-danger">Deative</span> |
			  		@endif
				</label>
            </div><!-- col -->
            <div class="col-lg-4">
              	<label class="">
			  		<span>Hot New |</span>
			  		@if($product->hot_new == 1)
			  			<span class="badge badge-success">Active</span> |
			  		@else
			  			<span class="badge badge-danger">Deative</span> |
			  		@endif
				</label>
            </div><!-- col -->
            <div class="col-lg-4">
                <label class="">
            <span>Buy One Get One |</span>
            @if($product->buyone_getone == 1)
              <span class="badge badge-success">Active</span> |
            @else
              <span class="badge badge-danger">Deative</span> |
            @endif
        </label>
            </div><!-- col -->
            <div class="col-lg-4">
                <label class="">
            <span>Status |</span>
            @if($product->status == 1)
              <span class="badge badge-success">Active</span> |
            @else
              <span class="badge badge-danger">Deative</span> |
            @endif
        </label>
            </div><!-- col -->
          </div><!-- row -->
        </div><!-- card -->
      </div><!-- sl-pagebody -->
	</div>
	

	  
@endsection
