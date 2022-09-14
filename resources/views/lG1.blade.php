@extends('layouts.master')

@section('breadcrumb','Logs / Los Santos Police Department')

@section('content')
<div class="row">
	<div class="col-sm-12">
		<form class="form-horizontal" role="form" method="post" name="manage_questions" id="manage_questions">
			<fieldset>
				<div class="table-responsive">
						<table class="table table-bordered table-hover table-bordered datatable">
							<thead>
								<tr>
									<th>Text</th>
									<th>Date <i class="fa fa-clock-o"></i></th>
								</tr>
							</thead>
							<tbody>
								@foreach ($kbsc as $l)
									<tr>
										<td>{{ $l->Text }}</td>
										<td>{{ $l->Date }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				<hr>
			</fieldset>
		</form>
	</div>
</div>
@section('css')<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dt.min.css') }}"/>@endsection
@section('js')<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.12/datatables.min.js"></script><script>$(document).ready(function(){$('.datatable').DataTable({"order": [[ 1, "desc" ]],iDisplayLength:10,"aLengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]]});});</script>@endsection
@endsection