@extends('layouts.adminpanel')
@section('admin_content')
	<div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">ALL CATEGORY 
			<a href="{{ route('admin.create.post') }}" class="btn btn-primary float-right">ADD NEW</a>
		  </h6>

          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Sl</th>
                  <th class="wd-15p">Title English</th>
                  <th class="wd-15p">Title Bangla</th>
                  <th class="wd-15p">Category</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
			         @php
                $sl = 1;
               @endphp
               @foreach($posts as $post)
                <tr>
                  <td>{{ $sl++ }}</td>
                  <td>{{ $post->post_title_en }}</td>
                  <td>{{ $post->post_title_bn }}</td>
                  <td>{{ $post->category_name_en }}</td>
                  <td>
                    <a href="#" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
               @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

      </div><!-- sl-pagebody -->
@endsection