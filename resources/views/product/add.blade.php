@extends('layout.dashboard')
@section('script_custom')
<script type="text/javascript">
$('#manage_products').addClass('active');
$( document ).ready(function() {

	 
}); 

</script>
@endsection
@section('title','Add Product')

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
                    <form method="POST" action="{{URL::to('manage_products/save')}}">
                    {{ csrf_field() }} 
                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" id="name">
                        
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" id="price">
                        
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Availability</label>
                        <select class="form-control" name="availability" id="availability">
                            <option value=""></option>
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>

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
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                <?php endforeach ?>
                            <?php endif ?>
                            
                        </select>
                        
                      </div>
                    </div>
                    </div>


                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="submit" value="Add Product" class="btn btn-primary btn-flat">
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