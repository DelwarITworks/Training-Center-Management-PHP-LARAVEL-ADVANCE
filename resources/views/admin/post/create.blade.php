@extends('layouts.adminpanel')
@section('admin_content')
	<div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
        </div><!-- sl-page-title -->
        <div class="card pd-20 pd-sm-40">
        	<form action="{{ route('admin.new.post') }}" method="post" enctype="multipart/form-data">
        		@csrf
          <div class="row">
            <div class="col-lg">
            	<label>Post Title English</label>
              <input class="form-control" placeholder="Post Title English" name="post_title_en" type="text">
            </div><!-- col -->
          </div><!-- row -->
          <div class="row">
            <div class="col-lg">
              <label>Post Title Bangla</label>
              <input class="form-control" placeholder="Post Title Bangla" name="post_title_bn" type="text">
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Category</label>
              <select name="category_id" id="category_id" class="form-control">
              	@foreach($categories as $category)
              	<option value="{{$category->id}}">{{$category->category_name_en}}</option>
              	@endforeach
              </select>
            </div><!-- col -->
          </div><!-- row -->

          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Product Details English</label>
              <textarea id="summernote" name="product_details_en"></textarea>
            </div><!-- col -->
          </div><!-- row -->
          <div class="row mg-t-20">
            <div class="col-lg">
              <label>Product Details Bangla</label>
              <textarea id="summernote1" name="product_details_bn"></textarea>
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
	  
@endsection

	