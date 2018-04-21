@extends('layout.dashboard')
@section('script_custom')
<script type="text/javascript">
$('#manage_spbu').addClass('active');
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

$( document ).ready(function() {

	  

}); 


</script>
@endsection
@section('title','Manage SPBU')

@if (session('status'))
@section('notification_message')
<script type="text/javascript">
swal("{{session('status')}}");
</script>
@endsection
@endif

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="pull-right">
          <a href="{{'manage_spbu/add'}}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> &nbsp&nbsp Add SPBU</a>
          <br><br>
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
								<th width="5%">ID</th>
								<th>Name</th>
								<th>Address</th>
								<th>Facility</th>
                <th>Location</th>
                <!-- <th>Action</th> -->
							</tr>
						</thead>

						<tbody>
							
                @if(count($spbu) == 0)
                    <tr><Td colspan="5"><i><center>No Data Found</center></i></td></tr>
                @else
                    @foreach($spbu as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->address}}</td>
                            <td>
                              @if($row->is_mosque == 1)
                                <img width="35" src="{{url('')}}/public/images/icon/mosque.png">
                              @endif

                              @if($row->is_toilet == 1)
                                <img width="35" src="{{url('')}}/public/images/icon/toilet.png">
                              @endif

                              @if($row->is_snack_store == 1)
                                <img width="35" src="{{url('')}}/public/images/icon/convenience-store.png">
                              @endif

                              @if($row->is_olimart == 1)
                                <img width="35" src="{{url('')}}/public/images/icon/oli.png">
                              @endif

                              @if($row->is_brightwash == 1)
                                <img width="35" src="{{url('')}}/public/images/icon/carwash.png">
                              @endif
                            </td>
                            <td><a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{$row->latitude}},{{$row->longitude}}" class="btn btn-sm btn-warning">See Location</a></td>
                            <!-- <td></td> -->
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