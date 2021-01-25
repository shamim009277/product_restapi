
@if(!empty($single_subcategory))
  @php  $title = "Update Product Sub Category";  @endphp
@else
   @php  $title = "Add Product Sub Category"; @endphp
@endif

@extends('admin.layouts.app')
@section('title',$title)
@push('css')

@endpush
@section('content')
<div class="main">           
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
               	   <div class="panel panel-headline">
						<div class="panel-heading">
						@if(!empty($single_subcategory))
						    <h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Update Product SubCategory
							</h3>
						@else
							<h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Add Product Sub Category
							</h3>
						@endif	
						</div>
					    </br>
					    
						<div class="panel-body">
							<div class="row mx-auto">
								<div class="col-md-10 mx-auto" style="float:none;margin:auto;">
									@include('common.message')
		@if(!empty($single_subcategory))
		 {!! Form::open(array('route'=>['subcategory.update',$single_subcategory->id],'method'=>'PUT','files'=>true)) !!}
           @php  $btn = "Update Category"; @endphp
		@else
								  
         {!! Form::open(array('route'=>['subcategory.store'],'method'=>'POST','files'=>true))!!} 
                @php  $btn = "Submit"; @endphp
        @endif          
									<div class="form-group">
									    <label for="name">Category Name</label>
									    	<select name="category_id" id="category_id" class="form-control">
									    	@if(isset($single_subcategory))
									    		<option value="{{$single_subcategory->category_id}}">{{$single_subcategory->category->name}}</option>
									    		@foreach($categories as $category)
									    		   @if(($single_subcategory->category->name)!==($category->name))
									    	           <option value="{{$category->id}}">{{$category->name}}</option>
									    	        @endif
									    	    @endforeach
									    	@else
									    		<option value="">---Select Category name---</option>
									    	    @foreach($categories as $category)
									    	    <option value="{{$category->id}}">{{$category->name}}</option>
									    	    @endforeach
									    	@endif
									    	</select>
									</div>

									<div class="form-group">
									    <label for="name">Sub Category Name</label>
									    	<input type="text" name="subcategory_name" id="subcategory_name" class="form-control" placeholder="Sub Category Name" value="{!!isset($single_subcategory)?$single_subcategory->subcategory_name:old('subcategory_name')!!}" required>
									</div>

									<div class="form-group">
									    <button type="submit" class=" btn btn-primary pull-right">
									    	@php echo $btn; @endphp
                                        </button>
									</div>
							{!! Form::close() !!}		
							  
								</div>
							</div>
						</div>
					</div>
               </div>
            </div>        
        </div>
    </div>         
</div>
@endsection
