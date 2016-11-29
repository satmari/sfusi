@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><big>{{ $msg }}</big></div>
				
				@if ($case == 1)
				<img src="{{ asset('css/images/11.png') }}">
				<div class="panel-body">
					<p>New cartonbox: {{ $cartonbox }}</p>
					<p>New box quantity: {{ $qty }}</p>
					<br>
					<p><big><b>Existing cartonbox: {{ $exist_cartonbox }}</b></big></p>
					<p>Existing box quantity: {{ $exist_qty }}</p>
					<br>
					<p>Standard box quantity: {{ $standard_qty}}</p>
				</div>
				@endif

				@if ($case == 2)
				<img src="{{ asset('css/images/22.png') }}">
				<div class="panel-body">
					<p><big><b>New cartonbox: {{ $cartonbox }}</b></big></p>
					<p>New box quantity: {{ $qty }}</p>
					<br>
					<p>Existing cartonbox: {{ $exist_cartonbox }}</p>
					<p>Existing box quantity: {{ $exist_qty }}</p>
					<br>
					<p>Standard box quantity: {{ $standard_qty}}</p>
				</div>
				@endif

				@if ($case == 3)
				<img src="{{ asset('css/images/33.png') }}"><hr>
				<div class="panel-body">
					<p><big><b>New cartonbox: {{ $cartonbox }}</b></big></p>
					<p>New box quantity: {{ $qty }}</p>
					<br>
					<p>Existing cartonbox: {{ $exist_cartonbox }}</p>
					<p>Existing box quantity: {{ $exist_qty }}</p>
					<br>
					<p>Standard box quantity: {{ $standard_qty}}</p>
				</div>
				@endif

				@if ($case == 4)
				<img src="{{ asset('css/images/44.png') }}">
				<div class="panel-body">
					<p>New cartonbox: {{ $cartonbox }}</p>
					<p>New box quantity: {{ $qty }}</p>
					<br>
					<p><big><b>Existing cartonbox: {{ $exist_cartonbox }}</b></big></p>
					<p>Existing box quantity: {{ $exist_qty }}</p>
					<br>
					<p>Standard box quantity: {{ $standard_qty}}</p>
				</div>
				@endif

				@if ($case == 5)
				<img src="{{ asset('css/images/55.png') }}">
				<div class="panel-body">
					<p>New cartonbox: {{ $cartonbox }}</p>
					<p>New box quantity: {{ $qty }}</p>
					<br>
					<p>Existing cartonbox: {{ $exist_cartonbox }}</p>
					<p>Existing box quantity: {{ $exist_qty }}</p>
					<br>
					<p>Standard box quantity: {{ $standard_qty}}</p>
				</div>
				@endif

				<!-- <hr> -->
				<div class="panel-body">	
					<p><big><b>Actual location: {{ $exist_location }}</b></big></p>
				</div>

				<hr>
				<p>{{ $info }}</p>

				
				<hr>
				<div class="panel-body">
					<a href="{{url('/add')}}" class="btn btn-success center-block">Add new SFUSI box</a>
				</div>
				<div class="panel-body">
					<a href="{{url('/table')}}" class="btn btn-info center-block">SFUSI stock table</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection