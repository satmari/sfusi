@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Success</div>
				<br>
				<h4 style="color:green;">{{ $msg }}</h4>

				<hr>
				<br>
				<div class="">
						<a href="{{url('/removecb')}}" class="btn btn-danger btn-lg center-block">Remove another Cartonbox</a>
				</div>
				<br>
				<div class="">
						<a href="{{url('/table')}}" class="btn btn-info btn-lg center-block">SFUSI stock table</a>
				</div>
				<br>
				<div class="">
						<a href="{{url('/')}}" class="btn btn-default btn-lg center-block">Back to main menu</a>
				</div>

				@include('errors.list')
			</div>
		</div>
	</div>
</div>
@endsection