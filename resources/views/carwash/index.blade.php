@extends('layout.dashboard')
@section('script_custom')
<script type="text/javascript">
$('#manage_queue').addClass('active');
//Date picker
$('#start_date').datepicker({
  format: 'yyyy-mm-dd',
  autoclose: true
})

$('#end_date').datepicker({
  format: 'yyyy-mm-dd',
  maxDate: 0,
  autoclose: true
})


$(function() {
    $('#datetimepicker1').datetimepicker({
      language: 'pt-BR'
    });
});


$( document ).ready(function() {

	  

}); 


</script>
@endsection
@section('title','Carwash Queue')



@section('content')

@if (session('status'))
<div class="alert alert-warning">
  {{ session('status') }}
</div> <!-- /alert -->
@endif

<div class="row">
    <div class="col-md-12">
        <div class="pull-right">
          <a href="{{'manage_queue/add'}}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> &nbsp&nbsp Add Queue</a>
          <br><br>
        </div>
    </div>  
</div>

<div class="box">
    <div class="box-header with-border">
              <h3 class="box-title">Filter</h3>
    </div>
    <div class="box-body">
              {{-- start --}}
                    <form method="GET">
                    
                    <div class="col-md-1">
                      <div class="form-group">
                        <label>SPBU</label>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        
                        <select class="form-control" name="spbu" id="spbu">
                            <option value="">Choose SPBU</option>
                            <?php if (count($spbu) > 0): ?>
                                <?php foreach ($spbu as $row): ?>
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
                      </div>
                    </div>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box box-danger">
			<div class="box-body pad">
				<div class="table-responsive">
					<table id="tableFullFeatures" class="table table-border">

						<thead>
							<tr>
                <th>SPBU Name</th>
								<th>Queue Date</th>
								<th>Queue No</th>
								<th>Source</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Action</th>
                
							</tr>
						</thead>

						<tbody>
							  @if(count($queue) == 0)
                    <tr><Td colspan="6"><i><center>No Data Found</center></i></td></tr>
                @else
                    @foreach($queue as $row)
                        <tr>
                            
                            <td>{{$row->spbu_name}}</td>
                            <td>{{$row->queue_date}}</td>
                            <td>{{$row->queue_no}}</td>
                            <td>
                                @if($row->source == 1)
                                    Manual
                                @else
                                    Mobile App
                                @endif
                            </td> 
                            <td>
                                @if(!empty($row->customer_registered))
                                    {{$customer_registered}}
                                @else
                                    {{$row->customer}}
                                @endif
                            </td>
                            <td>
                                @if($row->status == 1)
                                    <small class="label  bg-primary">Waiting</small>
                                @elseif($row->status == 2)
                                    <small class="label  bg-red">Failed</small>
                                @elseif($row->status == 3)
                                    <small class="label  bg-green">Done</small>
                                @endif
                            </td>
                            <td>
                                <a href="" class="btn btn-sm btn-flat btn-warning">Call</a>
                                <a href="{{url('/')}}/manage_queue/cancel/{{$row->id}}" class="btn btn-sm btn-flat btn-danger">Cancel</a>
                                <a href="{{url('/')}}/manage_queue/finish/{{$row->id}}" class="btn btn-sm btn-flat btn-success">Finish</a>
                            </td>
                            
                        </tr>
                    @endforeach
                @endif
						</tbody>

						

					</table> <!-- /table -->
				</div> <!-- /table-responsive -->
			</div> <!-- /box-body -->
      <div class="box-footer clearfix">  
        <ul class="pagination pagination-sm no-margin pull-right">
          {{-- to include parameter searching in pagination --}}
          
        </ul>
      </div>
			</div> <!-- /box -->
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