@extends('layout.dashboard')
@section('script_custom')
<script type="text/javascript">
$('#config_carwash').addClass('active');
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
@section('title','Carwash Configuration')



@section('content')

@if (session('status'))
<div class="alert alert-warning">
  {{ session('status') }}
</div> <!-- /alert -->
@endif


<div class="row">
	<div class="col-md-12">
		<div class="box box-danger">
			<div class="box-body pad">
				<div class="table-responsive">
					<table id="tableFullFeatures" class="table table-border">

						<thead>
							<tr>
                <th>SPBU</th>
								<th>Capacity</th>
								<th>Open At</th>
								<th>Closed At</th>
                
							</tr>
						</thead>

						<tbody>
							  @if(count($spbu) == 0)
                    <tr><Td colspan="4"><i><center>No Data Found</center></i></td></tr>
                @else
                    @foreach($spbu as $row)
                        <tr>
                            
                            <td>{{$row->name}}</td>
                            <td>{{$row->capacity}}</td>
                            <td>{{$row->open_at}}</td>
                              
                            <td>{{$row->closed_at}}</td>
                            <td><a href="{{url('/')}}/config_carwash/edit/{{$row->id}}" class="btn btn-sm btn-flat btn-primary">Edit</a></td>
                            
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