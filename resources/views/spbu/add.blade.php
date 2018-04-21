@extends('layout.dashboard')
@section('script_custom')
<script type="text/javascript">
$('#manage_spbu').addClass('active');
$( document ).ready(function() {

	 
}); 

</script>
@endsection
@section('title','Add SPBU')

@section('content')
@if (session('status'))
<div class="alert alert-warning">
	{{ session('status') }}
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
                    <form method="POST" action="{{URL::to('manage_spbu/save')}}">
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
                        <label>Address</label>
                        
                        <textarea name="address" class="form-control"></textarea>
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Toilet</label>
                        <select class="form-control" name="is_toilet" id="is_toilet">
                            <option value="">Choose Availibility</option>
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>

                        </select>
                        
                      </div>
                    </div>
                    </div>


                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Prayer Room</label>
                        <select class="form-control" name="is_mosque" id="is_mosque">
                            <option value="">Choose Availibility</option>
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>

                        </select>
                        
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Bright Food & Drink</label>
                        <select class="form-control" name="is_snack_store" id="is_snack_store">
                            <option value="">Choose Availibility</option>
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>

                        </select>
                        
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Oli Mart</label>
                        <select class="form-control" name="is_olimart" id="is_olimart">
                            <option value="">Choose Availibility</option>
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>

                        </select>
                        
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>BrightWash</label>
                        <select class="form-control" name="is_brightwash" id="is_brightwash">
                            <option value="">Choose Availibility</option>
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>

                        </select>
                        
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Latitude</label>
                        <input type="text" name="latitude" class="form-control" id="latitude">
                        
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Longitude</label>
                        <input type="text" name="longitude" class="form-control" id="longitude">
                        
                      </div>
                    </div>
                    </div>

                    
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="submit" value="Add SPBU" class="btn btn-primary btn-flat">
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