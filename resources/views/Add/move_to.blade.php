@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Move carton box</b></div>
				
				{!! Form::model($box , ['method' => 'POST', 'url' => '/move_to_location/'.$box->id /*, 'class' => 'form-inline'*/]) !!}
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<meta name="csrf-token" content="{{ csrf_token() }}" />

				<div class="panel-body">
					<span>Location: <span style="color:red">*</span></span>
					{!! Form::input('text', 'location', '', ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
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
