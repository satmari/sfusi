@extends('app')

@section('content')
<div class="container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Box:</div>
				<br>
				
				{!! Form::open(['url' => 'deletelogtableconfirm']) !!}

					<div class="panel-body">
						<span>Created at FROM: </span>
						{!! Form::input('date', 'from', NULL, ['class' => 'form-control']) !!}
					</div>
					
					<div class="panel-body">
						<span>Created at TO: </span>
						{!! Form::input('date', 'to', NULL , ['class' => 'form-control']) !!}
					</div>
										
					<div class="panel-body">
						{!! Form::submit('Delete', ['class' => 'btn btn-danger center-block']) !!}
					</div>

					@include('errors.list')
					{!! Form::close() !!}

			

				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/addlogtable')}}" class="btn btn-default">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection