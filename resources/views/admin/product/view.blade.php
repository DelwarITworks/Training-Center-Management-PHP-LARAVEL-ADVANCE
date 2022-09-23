@extends('layouts.adminpanel')
@section('admin_content')
  <div class="sl-mainpanel">
      <div class="sl-pagebody">
        <div class="sl-page-title">
        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">ALL PRODUCTS</h6>
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Product Code</th>
                  <th class="wd-15p">Name</th>
                  <th class="wd-15p">Image</th>
                  <th class="wd-15p">Category</th>
                  <th class="wd-15p">Brand</th>
                  <th class="wd-15p">Qty.</th>
                  <th class="wd-15p">Selling Price</th>
                  <th class="wd-20p">Action</th>
                </tr>
              </thead>
              <tbody>
        @foreach($products as $product)
                <tr>
                  <td>{{ $product->product_code }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td><img src="{{ url($product->image_one) }}" height="50px" width="50px"></td>
                  <td>{{ $product->category_name }}</td>
                  <td>{{ $product->brand_name }}</td>
                  <td>{{ $product->product_quantity }}</td>
                  <td>{{ $product->selling_price }}</td>
                  <td>
          <a href="{{ route('admin.change.product',$product->id) }}" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
          <a href="{{ route('admin.show.product',$product->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
          <a id="delete" href="{{ route('admin.delete.product',$product->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-facebook"></i></a>
          @if($product->status == 0)
          <a href="{{ route('admin.active.product',$product->id) }}" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up"></i></a>
          </td>
          @else
          <a href="{{ route('admin.deactive.product',$product->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></a>
          </td>
          @endif
                </tr>
       @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

      </div><!-- sl-pagebody -->
    
   
@endsection