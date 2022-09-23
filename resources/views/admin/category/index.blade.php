@extends('layouts.adminpanel')
@section('admin_content')
	<div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">ALL CATEGORY 
			<button data-toggle="modal" data-target="#addCategory" class="btn btn-primary float-right">ADD NEW</button>
		  </h6>

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Sl</th>
                  <th class="wd-15p">Category Name</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
			  @php 
				$sl = 1;
			  @endphp
			  @foreach($categories as $category)
                <tr>
                  <td>{{ $sl++ }}</td>
                  <td>{{ $category->category_name }}</td>
                  <td>
					<a href="{{ route('admin.change.category',$category->id) }}" class="btn btn-info">Edit</a>
					<a id="delete" href="{{ route('admin.delete.category',$category->id) }}" class="btn btn-danger">Delete</a>
				  </td>
                </tr>
			 @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

      </div><!-- sl-pagebody -->
	  
	  <div id="addCategory" class="modal fade">
      <div class="modal-dialog modal-dialog-vertical-center" role="document">
	  <form action="{{ route('admin.save.category') }}" method="POST">
	  @csrf
        <div class="modal-content bd-0 tx-14">
          <div class="modal-header pd-y-20 pd-x-25">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Message Preview</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pd-25">
		  @if($errors->any())
			@foreach($errors->all() as $error)
				<div class="alert alert-danger">{{$error}}</div>
			@endforeach
		  @endif
			<div class="form-group"> 
				<label>CATEGORY NAME</label>
				<input type="text" class="form-control" name="category_name" placeholder="Enter Category Name" required />
			</div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-info pd-x-20">Save changes</button>
            <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
          </div>
        </div>
		</form>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
@endsection