@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				{{--<div class="panel-heading">Home</div>--}}
				
				<div class="panel-body">
					<div class="">
						<a href="{{url('/')}}" class="btn btn-success center-block"><br>Add SFUSI box<br><br></a>
					</div>
				</div>
				<br><br><br>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/')}}" class="btn btn-primary center-block"><br>Search box<br><br></a>
					</div>
				</div>
				<br><br><br>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/')}}" class="btn btn-danger center-block"><br>Remove SFUSI box<br><br></a>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
@endsection
