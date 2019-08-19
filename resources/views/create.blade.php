@extends('layouts.app')

@section('title', 'Test')



@section('content')
	


    <div class="container">
    	<div class="row">
    		<div class="col">
    			<br>
    			<h3>Create Product</h3>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col"></div>
    		<div class="col-8">
    			<form method="POST" action="/product">
    				 @csrf
    				<div class="form-group">
					    <label for="name">Name</label>
					    <input type="text" class="form-control" id="name" name="name" required aria-describedby="Name" placeholder="Enter name">
					</div>
					<div class="form-group">
					    <label for="quantity">Quantity in Stock</label>
					    <input type="number" class="form-control" id="quantity" name="quantity" required aria-describedby="Name" placeholder="Quantity in Stock">
					</div>
					<div class="form-group">
					    <label for="price">Price</label>
					    <input type="number" class="form-control" id="price" name="price"  requiredaria-describedby="Name" placeholder="Price">
					</div>
					<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
				  	<button type="submit" class="btn btn-primary">Submit</button>
				</form>
    		</div>
    		<div class="col"></div>
    	</div>
    </div>	
<hr>
	<div class="alert alert-success" role="alert">
	  This table is sorted by date from oldest to most recent
	</div>
	<br>
    <table class="table">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Product Name</th>
	      <th scope="col">Quantity in stock</th>
	      <th scope="col">Price per item</th>
	      <th scope="col">Datetime submitted</th>
	      <th scope="col">Total Value</th>
	      <th scope="col">Action</th>
	    </tr>
	  </thead>
	  <tbody>
	  	@foreach ($products as $product)
	    <tr>
	      <th scope="row"></th>
	      <td>{{ $product['name'] }}</td>
	      <td>{{ $product['quantity'] }}</td>
	      <td>{{ $product['price'] }}</td>
	      <td>{{ $product['date'] }}</td>
	      <td class="total-element" data-total="{{ $product['quantity'] * $product['price'] }}">
	      	{{ $product['quantity'] * $product['price'] }}
	      </td>
	      <td>
	      	<i data-id="{{ $product['id'] }}" data-name="{{ $product['name'] }}" data-quantity="{{ $product['quantity'] }}" data-price="{{ $product['price'] }}" class="fas fa-pen-square product-edit"></i> 
	      </td>

	    </tr>
	    @endforeach
	    <tr>
	    	<td colspan="4"></td>
	    	<td >TOTAL >>>> </td>
	    	<td class="total"></td>
	    	<td>&nbsp;</td>
	    </tr>
	  </tbody>
	</table>

<div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-product" method="POST" action="/product/">
			 @csrf
			<div class="form-group">
			    <label for="name">Name</label>
			    <input type="text" class="form-control" id="ename" name="ename" required aria-describedby="Name" placeholder="Enter name">
			</div>
			<div class="form-group">
			    <label for="quantity">Quantity in Stock</label>
			    <input type="number" class="form-control" id="equantity" name="equantity" required aria-describedby="Name" placeholder="Quantity in Stock">
			</div>
			<div class="form-group">
			    <label for="price">Price</label>
			    <input type="number" class="form-control" id="eprice" name="eprice"  requiredaria-describedby="Name" placeholder="Price">
			</div>
			<input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
			<input type="hidden" name="eid" id="eid" value=""></input>
		  	<button type="submit" class="btn btn-primary">Submit</button>
		</form>
      </div>
    </div>
  </div>
</div>
	

	<script type="text/javascript">
			$(document).ready(function(){
				$('.product-edit').on('click', function(){
					$('#edit-product').attr('action', '/product/update');
					$('#ename').val($(this).data('name'));
					$('#eid').val($(this).data('id'));
					$('#equantity').val($(this).data('quantity'));
					$('#eprice').val($(this).data('price'));
					$('#myModal').modal('show')
				});

				var total = 0;
				$('.total-element').each(function(){
					total += $(this).data('total');
				});
				$('.total').html(total);
			});

	</script>
@endsection