@extends('layout.dashboard')
@section('script_custom')
<script type="text/javascript">
$('#config_carwash').addClass('active');
$( document ).ready(function() {

	 
}); 

</script>
@endsection
@section('title','Edit Carwash Config')

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
                    <form method="POST" action="{{URL::to('config_carwash/update')}}">
                    {{ csrf_field() }} 
                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$detail_spbu->name}}" disabled>
                        <input type="hidden" name="spbu_id" value="{{$detail_spbu->id}}">
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Capacity</label>
                        <input type="text" name="capacity" class="form-control" id="capacity" value="{{$detail_spbu->capacity}}">
                        
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Open At</label>
                        <input type="text" name="open_at" class="form-control" id="capacity" value="{{$detail_spbu->open_at}}">
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Closed At</label>
                        <input type="text" name="closed_at" class="form-control" id="capacity" value="{{$detail_spbu->closed_at}}">
                      </div>
                    </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <input type="submit" value="Update Config" class="btn btn-primary btn-flat">
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