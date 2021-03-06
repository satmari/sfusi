@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				{{--<div class="panel-heading">Home</div>--}}
				
				<div class="panel-body">
					<div class="">
						<a href="{{url('/add')}}" class="btn btn-success center-block"><br>Add new SFUSI box<br><br></a>
					</div>
				</div>
				<br>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/refresh')}}" class="btn btn-info center-block"><br>SFUSI stock TABLE<br><br></a>
					</div>
				</div>
				<br>
				
				<div class="panel-body">
					<div class="">
						<a href="{{url('/move')}}" class="btn btn-warning center-block"><br>Move SFUSI box to new location<br><br></a>
					</div>
				</div>
				<br>
				
				<div class="panel-body">
					<div class="">
						<a href="{{url('/removecb')}}" class="btn btn-danger center-block"><br>Remove SFUSI box<br><br></a>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
@endsection
