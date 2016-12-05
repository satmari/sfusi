@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading">Remove Cartonbox from Stock</div>
				
				@if(isset($msg))
				<h4 style="color:red;">{{ $msg }}</h4>
				@endif
							
				{!! Form::open(['url' => 'removecb\destroy']) !!}
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<meta name="csrf-token" content="{{ csrf_token() }}" />
				
				<div class="panel-body">
					{!! Form::input('number', 'cb_to_remove', null, ['class' => 'form-control', 'autofocus' => 'autofocus']) !!}
				</div>

				
				<div class="panel-body">
					{!! Form::submit('Add to list', ['class' => 'btn btn-danger btn-lg center-block']) !!} 
				</div>
				

				@include('errors.list')
				{!! Form::close() !!}
				<hr>

				{{-- 
				<input id="proba" type="text" class="form-control" name="proba">
				<div id="display"></div>
				--}}

				<p><big>List to remove</big></p>
				<hr>
				
				@if(isset($cb_to_remove_array_unique))
					<table class="table">
						<thead>
							<td>Cartonbox</td>
							<td>Po</td>
							<td>Size</td>
							<td>Qty</td>
						</thead>

					@foreach($cb_to_remove_array_unique as $array)
						<tr>
							<td>
							@foreach($array as $key => $value)
								@if($key == 'cartonbox')
						    		{{ $value }}
						    	@endif
						    @endforeach
					   		</td>
					   		<td>
							@foreach($array as $key => $value)
								@if($key == 'po')
						    		<b>{{ substr($value, 9, 5) }}</b>
						    	@endif
						    @endforeach
					   		</td>
					   		<td>
							@foreach($array as $key => $value)
								@if($key == 'size')
						    		<b>{{ $value }}</b>
						    	@endif
						    @endforeach
					   		</td>
					   		<td>
							@foreach($array as $key => $value)
								@if($key == 'qty')
						    		{{ $value }}
						    	@endif
						    @endforeach
					   		</td>
					   		
					    </tr>

					@endforeach

						<tfoot>
						<tr>
							<td>
								Total boxes:
							</td>
					   		<td>
							<big><b>{{ $sumofcb }}</b></big>
					   		</td>
					    </tr>
						</tfoot>
					</table>
				@endif

				{!! Form::open(['url' => 'removecb\destroycb']) !!}
				<input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">


				<div class="panel-body">
					{!! Form::submit('Remove CB list', ['class' => 'btn btn-danger btn-lg center-block']) !!}
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