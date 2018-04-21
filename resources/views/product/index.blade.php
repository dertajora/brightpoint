@extends('layout.dashboard')
@section('script_custom')
<script type="text/javascript">
$('#manage_products').addClass('active');
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
@section('title','Manage Product')



@section('content')

@if (session('status'))
<div class="alert alert-warning">
  {{ session('status') }}
</div> <!-- /alert -->
@endif

<div class="row">
    <div class="col-md-12">
        <div class="pull-right">
          <a href="{{'manage_products/add'}}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> &nbsp&nbsp Add Product</a>
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
								<th>Price</th>
								<th>Availability</th>
                <th>SPBU</th>
                <th>Action</th>
							</tr>
						</thead>

						<tbody>
							
                @if(count($products) == 0)
                    <tr><Td colspan="5"><i><center>No Data Found</center></i></td></tr>
                @else
                    @foreach($products as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->price}}</td>
                            <td>
                                @if($row->is_available == 0)
                                  <small class="label  bg-red">Empty</small>
                                @else
                                  <small class="label  bg-green">Available</small>
                                @endif
                            </td>
                            <td>{{$row->spbu_name}}</td>
                            <td><a href="{{url('/')}}/manage_products/edit/{{$row->id}}" class="btn btn-sm btn-flat btn-primary">Edit</a></td>
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