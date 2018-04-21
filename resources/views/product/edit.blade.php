@extends('layout.dashboard')
@section('script_custom')
<script type="text/javascript">
$('#manage_products').addClass('active');
$( document ).ready(function() {

	 
}); 

</script>
@endsection
@section('title','Edit Product')

@section('content')
@if (session('status'))
<div class="alert alert-warning">
	{{ session('status') }}
</div> <!-- /alert -->
@endif

@if(count($spbu) == 0)
  <div class="alert alert-warning">
      Anda tidak memiliki SPBU, silahkan tambahkan SPBU terlebih dahulu
  </div> <!-- /alert -->
@endif



<div class="row">
	<div class="col-md-9">
		<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Form</h3>
            </div>
            <div class="box-body">
              {{-- start --}}
                    <form method="POST" action="{{URL::to('manage_products/update')}}">
                    {{ csrf_field() }} 
                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$detail_product->name}}">
                        <input type="hidden" name="product_id" value="{{$detail_product->id}}">
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" id="price" value="{{$detail_product->price}}">
                        
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Availability</label>
                        <select class="form-control" name="availability" id="availability">
                            <option value=""></option>
                            <option value="1" <?php if ($detail_product->is_available == 1) echo "selected" ?>>Available</option>
                            <option value="0" <?php if ($detail_product->is_available == 0) echo "selected" ?>>Not Available</option>

                        </select>
                        
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>SPBU</label>
                        <select class="form-control" name="spbu_id" id="spbu_id">
                            <option value=""></option>
                            
                            <?php if (count($spbu) > 0): ?>
                                <?php foreach ($spbu as $row): ?>
                                    @if($row->id == $detail_product->spbu_id)
                                        <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                    @else
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endif
                                <?php endforeach ?>
                            <?php endif ?>
                            
                        </select>
                        
                      </div>
                    </div>
                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="submit" value="Update Product" class="btn btn-primary btn-flat">
                        </div>
                      </div>
                    </div>
                    
	                 
                    
                	
	                  
            </div>
            <!-- /.box-body -->
            <!-- /.box-footer-->
          	</div>
          	
			
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->
@endsection

@section('script_custom')
<script type="text/javascript">
$(document).ready(function() {
    $('#tableFullFeatures').DataTable();
});
</script>
@endsection