@extends('app')

@section('content')
<div class="container container-table">
	<div class="row vertical-center-row">
		<div class="text-center col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading"><b><big>{{ $msg }}</big></b></div>
				
				@if ($case == 1)
				{{-- <img src="{{ asset('css/images/11.png') }}"> --}}
				<div class="panel-body">
					<table class="table">
    			    <tbody>
				      <!-- <tr> -->
				        <td style="text-decoration: line-through;">New cartonbox: {{ $cartonbox }}</td>
				        <td><b>Existing cartonbox: {{ $exist_cartonbox }}</b></td>
				      </tr>
				      <tr>
				        <td>New box quantity: {{ $qty }}</td>
				        <td>Existing box quantity: {{ $exist_qty }}</td>
				      </tr>
				    </tbody>
				  </table>
				  	<p><b>SFUSI box quantity:  <span style="font-size: 20px;">{{  $qty+$exist_qty }}</span></b></p>
					<p>Standard box quantity: {{ $standard_qty}}</p>
				</div>
				@endif

				@if ($case == 2)
				{{-- <img src="{{ asset('css/images/22.png') }}"> --}}
				<div class="panel-body">
					<table class="table">
    			    <tbody>
				      <!-- <tr> -->
				        <td><b>New cartonbox: {{ $cartonbox }}</b></td>
				        <td style="text-decoration: line-through;">Existing cartonbox: {{ $exist_cartonbox }}</td>
				      </tr>
				      <tr>
				        <td>New box quantity: {{ $qty }}</td>
				        <td>Existing box quantity: {{ $exist_qty }}</td>
				      </tr>
				    </tbody>
				  </table>
				  	<p><b>SFUSI box quantity:  <span style="font-size: 20px;">{{  $qty+$exist_qty }}</span></b></p>
					<p>Standard box quantity: {{ $standard_qty}}</p>
				</div>
				@endif

				@if ($case == 3)
				{{-- <img src="{{ asset('css/images/33.png') }}"> --}}
				<div class="panel-body">
					<table class="table">
    			    <tbody>
				      <!-- <tr> -->
				        <td><b>New cartonbox: {{ $cartonbox }}</b></td>
				        <td style="text-decoration: line-through;">Existing cartonbox: {{ $exist_cartonbox }}</td>
				      </tr>
				      <tr>
				        <td>New box quantity: {{ $qty }}</td>
				        <td>Existing box quantity: {{ $exist_qty }}</td>
				      </tr>
				    </tbody>
				  </table>
				  	<p><b>SFUSI box quantity:  <span style="font-size: 20px;">{{  $qty+$exist_qty-$standard_qty }}</span></b></p>
					<p>Standard box quantity: {{ $standard_qty}}</p>
				</div>
				@endif

				@if ($case == 4)
				{{-- <img src="{{ asset('css/images/44.png') }}"> --}}
				<div class="panel-body">
					<table class="table">
    			    <tbody>
				      <!-- <tr> -->
				        <td style="text-decoration: line-through;">New cartonbox: {{ $cartonbox }}</td>
				        <td><b>Existing cartonbox: {{ $exist_cartonbox }}</b></td>
				      </tr>
				      <tr>
				        <td>New box quantity: {{ $qty }}</td>
				        <td>Existing box quantity: {{ $exist_qty }}</td>
				      </tr>
				    </tbody>
				  </table>
				  	<p><b>SFUSI box quantity:  <span style="font-size: 20px;">{{  $qty+$exist_qty-$standard_qty }}</span></b></p>
					<p>Standard box quantity: {{ $standard_qty}}</p>
				</div>
				@endif

				@if ($case == 5)
				{{-- <img src="{{ asset('css/images/55.png') }}"> --}}
				<div class="panel-body">
					<table class="table">
    			    <tbody>
				      <!-- <tr> -->
				        <td>New cartonbox: {{ $cartonbox }}</td>
				        <td>Existing cartonbox: {{ $exist_cartonbox }}</td>
				      </tr>
				      <tr>
				        <td>New box quantity: {{ $qty }}</td>
				        <td>Existing box quantity: {{ $exist_qty }}</td>
				      </tr>
				    </tbody>
				  </table>
				  	<p><b>SFUSI box quantity: <span style="font-size: 20px;">{{  $qty+$exist_qty-$standard_qty }}</span></b></p>
					<p>Standard box quantity: {{ $standard_qty}}</p>
				</div>
				@endif

				<!-- <hr> -->
				<!-- <div class="panel-body">	 -->
					<p><big><b>Actual location: {{ $exist_location }}</b></big></p>
				<!-- </div> -->

				<hr>
				<p>{{ $info }}</p>

				
				<hr>
				<div class="panel-body">
					<a href="{{url('/add')}}" class="btn btn-success center-block">Add new SFUSI box</a>
				</div>
				<div class="panel-body">
					<a href="{{url('/table')}}" class="btn btn-info center-block">SFUSI stock table</a>
				</div>
				<div class="panel-body">
						<a href="{{url('/')}}" class="btn btn-default btn-lg center-block">Back to Main menu</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection