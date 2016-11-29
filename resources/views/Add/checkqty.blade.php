@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Add Quantity of garments and location</b></div>
				
				{!! Form::open(['url' => 'checkqty']) !!}
				<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

				{!!Form::hidden('cartonbox', $cartonbox) !!}
				{!!Form::hidden('po', $po) !!}
				{!!Form::hidden('po_status', $po_status) !!}
				{!!Form::hidden('style', $style) !!}
				{!!Form::hidden('color', $color) !!}
				{!!Form::hidden('size', $size) !!}
				{!!Form::hidden('standard_qty', $standard_qty) !!}
				
				<div class="panel-body">
					<span>Quantity: <span style="color:red">*</span></span>
					{!! Form::input('number', 'qty', $qty, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
				</div>

				<div class="panel-body">
					{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
				</div>

				@include('errors.list')

				{!! Form::close() !!}
				
				<br>
				<div class="">
						<a href="{{url('/')}}" class="btn btn-default btn-lg center-block">Back to main menu</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
