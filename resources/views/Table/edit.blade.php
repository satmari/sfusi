@extends('app')

@section('content')
<div class="container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Box:</div>
				<br>
				
					{!! Form::model($box , ['method' => 'POST', 'url' => '/table/edit_update/'.$box->id /*, 'class' => 'form-inline'*/]) !!}

					<div class="panel-body">
						<span>Qty: </span>
						{!! Form::input('number', 'qty', $box->qty, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<span>Location: </span>
						{!! Form::input('text', 'location', $box->location, ['class' => 'form-control']) !!}
					</div>

					<div class="panel-body">
						<span>Comment: </span>
						{!! Form::input('text', 'coment', $box->coment, ['class' => 'form-control']) !!}
					</div>
										
					<div class="panel-body">
						{!! Form::submit('Save', ['class' => 'btn btn-success center-block']) !!}
					</div>

					@include('errors.list')
					{!! Form::close() !!}

			

				<hr>
				<div class="panel-body">
					<div class="">
						<a href="{{url('/table')}}" class="btn btn-default">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection