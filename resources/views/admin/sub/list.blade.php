@extends('admin.layouts.app')
@section('title','Product Sub Category')
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
								<i class="fa fa-list"></i> All Sub Category List
							</h3>
							<a href="{{route('subcategory.create')}}" class="btn btn-success pull-right">Add Sub Category</a>
						</div>
					    </br>
						<div class="panel-body">
							@include('common.message')
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Category Name</th>
										<th>Sub Category Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								  @php $n=0; @endphp
								  @foreach($sub_categories as $sub)
								    <tr>
								    	<td><?php echo ++$n; ?></td>
								    	<td>{{$sub->category->name}}</td>
								    	<td>{{$sub->subcategory_name}}</td>
								    	<?php  
                                              $id = Crypt::encrypt($sub->id);
								    	?>
								    	<td>
								    		<a href="{{route('subcategory.edit',$id)}}" class="btn btn-info btn-sm">
												<i class="lnr lnr-pencil"></i>
											</a>
											<a href="" class="btn btn-danger btn-sm">
												<i class="lnr lnr-trash"></i>
											</a>
								    	</td>
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