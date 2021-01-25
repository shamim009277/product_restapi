@extends('admin.layouts.app')
@section('title','Product Brand')
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
								<i class="fa fa-list"></i> All Brand List
							</h3>
							<a href="{{route('brand.create')}}" class="btn btn-success pull-right">Add Brand</a>
						</div>
					    </br>
						<div class="panel-body">
							@include('common.message')
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Category</th>
										<th>Sub Category</th>
										<th>Brand</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								  @php $n=0; @endphp
								  @foreach($brands as $brand)
								    <tr>
								    	<td><?php echo ++$n; ?></td>
								    	<td>{{$brand->category->name}}</td>
								    	<td>{{$brand->subcategory->subcategory_name}}</td>
								    	<td>{{$brand->brand_name}}</td>
								    	<?php  
                                              $id = Crypt::encrypt($brand->id);
								    	?>
								    	<th>
								    		<a href="{{route('brand.edit',$id)}}" class="btn btn-info btn-sm">
												<i class="lnr lnr-pencil"></i>
											</a>
											<a href="" class="btn btn-danger btn-sm">
												<i class="lnr lnr-trash"></i>
											</a>
								    	</th>
								    </tr>
								  @endforeach
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