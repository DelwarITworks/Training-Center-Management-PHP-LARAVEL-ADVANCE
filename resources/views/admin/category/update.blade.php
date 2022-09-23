@extends('layouts.adminpanel')
@section('admin_content')
	<div class="sl-mainpanel">
		<div class="sl-pagebody">
			<div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">UPDATE CATEGORY</h6>
		 <form action="{{ route('admin.update.category',$category->id) }}" method="POST">
		 @csrf
		 @if($errors->any())
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">{{$error}}</div>
			@endforeach
		  @endif
          <div class="row">
            <div class="col-lg">
              <input class="form-control" value="{{ $category->category_name }}" name="category_name" type="text">
            </div><!-- col -->
          </div><!-- row -->
		  <div class="row mt-2">
			<div class="col-lg">
				<button type="submit" class="btn btn-primary">UPDATE</button>
			</div>
		  </div>
		  </form>
        </div><!-- card -->
		</div>
	</div>
@endsection