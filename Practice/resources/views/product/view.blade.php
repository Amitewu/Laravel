@extends('layouts/app')

@section('content')
<div class="container">

	<div class="row">
		<div class="col-8">
			<div class="card mb-3">
				<div class="card-header bg-success">
					List of Products
				</div>
				<div class="card-body">
					@if(session('deletestatus'))
					<div class="alert alert-danger">
						
						{{ session('deletestatus') }}

					</div>
					@endif

					<table class="table table-broder">
						  <thead>

						    <tr>

						    	<th scope="col">SL NO </th>
						      <th scope="col">Product Name</th>
						      <th scope="col">Description</th>
						      <th scope="col">Product Price</th>
						      <th scope="col">Product Quantity</th>
						      <th scope="col">Alert Quantity</th>
						       <th scope="col">Product Image</th>
						      <th scope="col">Action</th>
						      
						   
						    </tr>

						  </thead>

						  <tbody>
						  	@forelse($products as $product)

						  	<tr>
						  			<th>{{$loop->index+1}}</th>
						      <th>{{$product->product_name}}</th>
						      <th>{{str_limit($product->product_description,20)}}</th>
						      <td>{{$product->product_price}}</td>
						      <td>{{$product->product_quantity}}</td>
						      <td>{{$product->alert_quantity}}</td>
						      <td>
						      	<img src="{{ asset('uploads/product_photos') }}/{{$product->product_image}}" alt="no photos found" width="50">

						      </td>
						      <td>

						      	<div class="btn-group" role="group" aria-label="Basic example">
										
									  <a href="{{ url('delete/product') }}/{{$product->id}}" class="btn btn-danger ">Delete</a>
									  <a href="{{ url('edit/product') }}/{{$product->id}}" class="btn btn-info">Update</a>
									  </div>
									 
						      </td>
						    </tr>

						    	@empty
						    	<tr class="text-center text-danger" ><td colspan="7">Data is not available</td></tr>

						  	@endforelse
						    
						  </tbody>

						</table>

						{{$products->links()}} <!--//for pagination -->
				</div>
			</div>

			<div class="card">
				<div class="card-header bg-danger">
					Deleted Products
				</div>
				<div class="card-body">
					@if(session('restorestatus'))
					<div class="alert alert-success">
						
						{{ session('restorestatus') }}

					</div>
					@endif

					@if(session('forcedeletestatus'))
					<div class="alert alert-danger">
						
						{{ session('forcedeletestatus') }}

					</div>
					@endif


					<table class="table table-broder">
						  <thead>

						    <tr>

						    	<th scope="col">SL NO </th>
						      <th scope="col">Product Name</th>
						      <th scope="col">Description</th>
						      <th scope="col">Product Price</th>
						      <th scope="col">Product Quantity</th>
						      <th scope="col">Alert Quantity</th>
						     
						      <th scope="col">Action</th>
						      <th scope="col">#</th>
						   
						    </tr>

						  </thead>

						  <tbody>
						  	@forelse($deleted_products as $deleted_products)

						  	<tr>
						  			<th>{{$loop->index+1}}</th>
						      <th>{{$deleted_products->product_name}}</th>
						      <th>{{str_limit($deleted_products->product_description,20)}}</th>
						      <td>{{$deleted_products->product_price}}</td>
						      <td>{{$deleted_products->product_quantity}}</td>
						      <td>{{$deleted_products->alert_quantity}}</td>
						      
						      <td>

						      	<div class="btn-group" role="group" aria-label="Basic example">
										
									  <a href="{{ url('restore/product') }}/{{$deleted_products->id}}" class="btn btn-success ">Restore</a>
									  <a href="{{ url('forcedelete/product') }}/{{$deleted_products->id}}" class="btn btn-danger ">ForceDelete</a>
									  
									  </div>
									 
						      </td>
						    </tr>

						    	@empty
						    	<tr class="text-center text-danger" ><td colspan="7">Data is not available</td></tr>

						  	@endforelse
						    
						  </tbody>

						</table>

						{{$products->links()}} <!--//for pagination -->
				</div>
			</div>
		</div>

		<div class="col-4">

			<div class="card">
				<div class="card-header bg-success">
					Add Product Form
				</div>

				<div class="card-body">
					@if(session('status'))
					<div class="alert alert-success">
						
						{{ session('status') }}

					</div>
					@endif

					

					@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
					
					<form action="{{url('add/product/insert')}}" method="post" enctype="multipart/form-data">
						@csrf
						  <div class="form-group">
						    <label>Product Name</label>
						    <input type="text" name="product_name" class='form-control' placeholder="Enter Your Product Name" value="{{old('product_name')}}">
						  </div>

						  <div class="form-group">
						    <label>Product Description</label>
						    <textarea class="form-control"  rows="3" name="product_description">{{old('product_description')}}</textarea>
						  </div>

						  <div class="form-group">
						    <label>Product Price</label>
						    <input type="text"  class='form-control' placeholder="Enter Your Product Price" name="product_price" value="{{old('product_price')}}">
						  </div>

						  <div class="form-group">
						    <label>Product Quantity</label>
						    <input type="text"  class='form-control' placeholder="Enter Your Product Quantity" name="product_quantity" value="{{old('product_quantity')}}">
						  </div>

						  <div class="form-group">
						    <label>Alert Quantity</label>
						    <input type="text"  class='form-control' placeholder="Enter Your Product Alert	" name="alert_quantity" value="{{old('alert_quantity')}}">
						  </div>

						  <div class="form-group">
						    <label>Product Image</label>
						    <input type="file"  class='form-control' name="product_image">
						  </div>

						  <button type="submit" class="btn btn-primary">Add Product</button>
						</form>
					
				</div>

			</div>
			

		</div>
		
	</div>
	

</div>
@endsection

