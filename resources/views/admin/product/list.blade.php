@extends('admin.layouts.app')
@section('title','Product List')
@push('css')
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">
@endpush
@section('content')
<div class="main">           
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
               	   <div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title pull-left">
								<i class="fa fa-list"></i> All Products List
							</h3>
							<a href="{{route('products.create')}}" class="btn btn-success pull-right">Add Product</a>
						</div>
					    </br>
						<div class="panel-body">
							@include('common.message')
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Category</th>
										<th>Sub Category</th>
										<th>Brand</th>
										<th>Base Price</th>
										<th>Details</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								  
								  
								    <tr>
								    	<td></td>
								    	<td></td>
								    	<td></td>
								    	<td></td>
								    	<td></td>
								    	<td></td>
								    	<td></td>
								    	
								    	<td>
								    		<a href="" class="btn btn-info btn-sm">
												<i class="lnr lnr-pencil"></i>
											</a>
											<a href="" class="btn btn-danger btn-sm">
												<i class="lnr lnr-trash"></i>
											</a>
								    	</td>
								    </tr>
								  
								</tbody>
							</table>
							
						</div>
					</div>
               </div>
            </div>        
        </div>
    </div>         
</div>
@endsection
@push('scripts')
  <script>
	$(document).ready(function() {
         $('#example').DataTable();
    } );
</script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
@endpush