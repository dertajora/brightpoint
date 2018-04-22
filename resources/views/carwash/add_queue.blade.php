@extends('layout.dashboard')
@section('script_custom')
<script type="text/javascript">
$('#manage_queue').addClass('active');
$( document ).ready(function() {

	 
}); 

</script>
@endsection
@section('title','Add Queue Manually')

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
                    <form method="POST" action="{{URL::to('manage_queue/save')}}">
                    {{ csrf_field() }} 
                    

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Customer</label>
                        <input type="text" name="customer" class="form-control" id="customer">
                        
                      </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Outlet Brightwash</label>
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
                          <input type="submit" value="Add Queue Manually" class="btn btn-primary btn-flat">
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