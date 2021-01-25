
@extends('admin.layouts.app')
@section('title','Add Product')
@section('content')
<div class="main">           
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
               <div class="col-md-12">
               	   <div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title pull-left">
								<i class="fa fa-user"></i> Add Product
							</h3>
						</div>

					    </br>
		{!! Form::open(array('route'=>['products.store'],'method'=>'POST','files'=>true))!!}			    
						<div class="panel-body">
							<div class="row mx-auto">
								<div class="col-md-10 mx-auto" style="float:none;margin:auto;">
									@include('common.message')
									<div class="form-group">
									    <label for="name">Product Name</label>
									    	<input type="text" name="name" id="name" class="form-control" placeholder="Product Name" value="{!!isset($single_category)?$single_category->name:old('name')!!}">
									</div>

									<div class="form-group">
									    <label for="name">Category Name</label>
									    	<select name="category_id" id="category_id" class="form-control">
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
									    	<select name="subcategory_id" id="subcategory_id" class="form-control">
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
									    	<select name="brand_id" id="brand_id" class="form-control">
									    	@if(isset($single_brand))
									    		<option value="{{$single_brand->brand_id}}">{{$single_brand->subcategory->subcategory_name}}</option>
									    		@foreach($subcategories as $sub)
									    		   @if(($single_brand->subcategory->subcategory_name)!==($sub->subcategory_name))
									    	           <option value="{{$sub->id}}">{{$sub->subcategory_name}}</option>
									    	        @endif
									    	    @endforeach
									    	@else
									    		<option value="">---Select Brand Name---</option>
									    	    @foreach($brands as $brand)
									    	    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
									    	    @endforeach
									    	@endif
									    	</select>
									</div>

									<div class="form-group">
									    <label for="name">Details</label>
									    <textarea name="details" class="form-control"></textarea>	
									</div>


									<div class="form-group">
									    <label for="name">Base Price</label>
									    	<input type="text" name="base_price" id="base_price" class="form-control" placeholder="Product Base Price" value="{!!isset($single_category)?$single_category->base_price:old('base_price')!!}">
									</div>

									<div class="form-group">
									    <label for="image">Product Image</label>
									    <input type="file" class="form-control" id="image" name="image"
									     onchange="loadFile(event)">
									    <img id="output" width="20%" style="margin-top:5px;" />
									</div>			  
								</div>
							</div>
						</div>
					</div>
               </div>

               <div class="col-md-12">
               	   <div class="panel panel-headline">
					<div class="panel-heading">
						<h3 class="panel-title">Product Variation</h3>
					</div>
					<div class="panel-body">
						<div class="row mx-auto">
							<div class="col-md-10 mx-auto" style="float:none;margin:auto;">

								<div class="row">
									<div class="col-md-4">
									  <div class="form-group">
									     <input type="text" value="Size" class="form-control" readonly>
									  </div>
									</div>
									<div class="col-md-2">
                                       <label class="fancy-checkbox">
										    <input type="checkbox" id="mySmall" onclick="myFunctionSmall()">
										    <span>Small</span>
									    </label>
									</div>
									<div class="col-md-2">
                                       <label class="fancy-checkbox">
										    <input type="checkbox" id="myMedium" onclick="myFunctionMedium()">
										    <span>Medium</span>
									    </label>
									</div>
									<div class="col-md-2">
                                       <label class="fancy-checkbox">
										    <input type="checkbox" id="myLarge" onclick="myFunctionLarge()">
										    <span>Large</span>
									    </label>
									</div>
									<div class="col-md-2">
                                       <label class="fancy-checkbox">
										    <input type="checkbox" id="myXlarge" onclick="myFunctionXlarge()">
										    <span>Extra Large</span>
									    </label>
									</div>
								</div>
								<input type="hidden" name="size[]" value="50">
								<div id="addition"></div>
								<div id="addition2"></div>
								<div id="addition3"></div>
								<div id="addition4"></div>
								
								<div class="form-group">
								    <button type="submit" class=" btn btn-primary pull-right">
								    	Add Product
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
<script>
 var loadFile = function(event) {
 var reader = new FileReader();
 reader.onload = function(){
 var output = document.getElementById('output');
 output.src = reader.result;
                             };
reader.readAsDataURL(event.target.files[0]);
};
</script>
@endsection
@push('scripts')
<script>
	function myFunctionSmall() {
 
  var mySmall = document.getElementById("mySmall"); 
  if (mySmall.checked == true){
    $("#addition").append('<div class="row" id="small">\
    	                       <div class="col-md-4">\
								  <div class="form-group">\
								     <input type="text" name="size[]" value="Small" class="form-control">\
								  </div>\
							   </div>\
							   <div class="col-md-8">\
									  <div class="form-group">\
									     <input type="text" name="extended_price[]" class="form-control" placeholder="Extended Price For Small Product">\
									  </div>\
									</div>\
    	                  </div>');
  } else {
    var child = $("#addition").children();
    child.remove();
  }

}

function myFunctionMedium() {
 
  var myMedium = document.getElementById("myMedium");  
  
  if (myMedium.checked == true){
    $("#addition2").append('<div class="row" id="medium">\
    	                       <div class="col-md-4">\
								  <div class="form-group">\
								     <input type="text" name="size[]" value="Medium" class="form-control">\
								  </div>\
							   </div>\
							   <div class="col-md-8">\
									  <div class="form-group">\
									     <input type="text" name="extended_price[]" class="form-control" placeholder="Extended Price For Medium Product">\
									  </div>\
									</div>\
    	                  </div>');
  } else {
    var child = $("#addition2").children();
    child.remove();
  }
}
function myFunctionLarge() {
 
  var myMedium = document.getElementById("myLarge");  
  
  if (myMedium.checked == true){
    $("#addition3").append('<div class="row" id="medium">\
    	                       <div class="col-md-4">\
								  <div class="form-group">\
								     <input type="text" name="size[]" value="Large" class="form-control">\
								  </div>\
							   </div>\
							   <div class="col-md-8">\
									  <div class="form-group">\
									     <input type="text" name="extended_price[]" class="form-control" placeholder="Extended Price For Large Product">\
									  </div>\
									</div>\
    	                  </div>');
  } else {
    var child = $("#addition3").children();
    child.remove();
  }
}
function myFunctionXlarge() {
 
  var myMedium = document.getElementById("myXlarge");  
  
  if (myMedium.checked == true){
    $("#addition4").append('<div class="row" id="medium">\
    	                       <div class="col-md-4">\
								  <div class="form-group">\
								     <input type="text" name="size[]" value="XLarge" class="form-control">\
								  </div>\
							   </div>\
							   <div class="col-md-8">\
									  <div class="form-group">\
									     <input type="text" name="extended_price[]" class="form-control" placeholder="Extended Price For Extra Large Product">\
									  </div>\
									</div>\
    	                  </div>');
  } else {
    var child = $("#addition4").children();
    child.remove();
  }
}

</script>
@endpush
