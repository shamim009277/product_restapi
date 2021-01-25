
@if(!empty($single_brand))
  @php  $title = "Update Product Brand";  @endphp
@else
   @php  $title = "Add Product Brand"; @endphp
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
						@if(!empty($single_brand))
						    <h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Update Product Brand
							</h3>
						@else
							<h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Add Product Brand
							</h3>
						@endif	
						</div>
					    </br>
					    
						<div class="panel-body">
							<div class="row mx-auto">
								<div class="col-md-10 mx-auto" style="float:none;margin:auto;">
									@include('common.message')
		@if(!empty($single_brand))
		 {!! Form::open(array('route'=>['brand.update',$single_brand->id],'method'=>'PUT','files'=>true)) !!}
           @php  $btn = "Update Category"; @endphp
		@else
								  
         {!! Form::open(array('route'=>['brand.store'],'method'=>'POST','files'=>true))!!} 
                @php  $btn = "Submit"; @endphp
        @endif          
									<div class="form-group">
									    <label for="name">Category Name</label>
									    	<select name="category_id" id="category_id" class="form-control" required>
									    	@if(isset($single_brand))
									    		<option value="{{$single_brand->category_id}}">{{$single_brand->category->name}}</option>
									    		@foreach($categories as $category)
									    		   @if(($single_brand->category->name)!==($category->name))
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
									    	<select name="subcategory_id" id="subcategory_id" class="form-control" required>
									    	@if(isset($single_brand))
									    		<option value="{{$single_brand->subcategory_id}}">{{$single_brand->subcategory->subcategory_name}}</option>
									    		@foreach($subcategories as $sub)
									    		   @if(($single_brand->subcategory->subcategory_name)!==($sub->subcategory_name))
									    	           <option value="{{$sub->id}}">{{$sub->subcategory_name}}</option>
									    	        @endif
									    	    @endforeach
									    	@else
									    		<option value="">---Select Sub Category name---</option>
									    	    @foreach($subcategories as $sub)
									    	    <option value="{{$sub->id}}">{{$sub->subcategory_name}}</option>
									    	    @endforeach
									    	@endif
									    	</select>
									</div>


									<div class="form-group">
									    <label for="name">Brand Name</label>
									    	<input type="text" name="brand_name" id="brand_name" class="form-control" placeholder="Brand Name" value="{!!isset($single_brand)?$single_brand->brand_name:old('brand_name')!!}" required>
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
