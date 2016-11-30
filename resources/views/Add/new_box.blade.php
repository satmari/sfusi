@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><b><big>Add box location?</big></b></div>
				<br>
				<p>{{ $info }}</p>

				{{--
				<div>
					@if ($case == 0)
					<img src="{{ asset('css/images/00.png') }}">
					@endif
				</div>
				--}}

				{!! Form::open(['url' => 'add_new_box']) !!}
				<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">

				{!!Form::hidden('cartonbox', $cartonbox) !!}
				{!!Form::hidden('po', $po) !!}
				{!!Form::hidden('po_status', $po_status) !!}
				{!!Form::hidden('style', $style) !!}
				{!!Form::hidden('color', $color) !!}
				{!!Form::hidden('colordesc', $colordesc) !!}
				{!!Form::hidden('size', $size) !!}
				{!!Form::hidden('qty', $qty) !!}
				{!!Form::hidden('standard_qty', $standard_qty) !!}
				
				
				<div class="panel-body">
					<span>Location: <span style="color:red">*</span></span>
					{!! Form::input('text', 'location', NULL, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
				</div>
				

				<div class="panel-body">
					{!! Form::submit('Confirm', ['class' => 'btn btn-success btn-lg center-block']) !!}
				</div>

				@include('errors.list')

				{!! Form::close() !!}
				
				<br>
				<div class="">
						<a href="{{url('/')}}" class="btn btn-default btn-lg center-block">Back</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
