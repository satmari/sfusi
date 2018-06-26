@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<!-- <div class="panel-heading h-n">SFUSI stock table</div> -->
				

				<a href="{{ url('/add') }}" class="btn btn-info btn-s">Add new SFUSI box</a>
				<br>
                <div class="input-group"> <span class="input-group-addon">Filter</span>
                    <input id="filter" type="text" class="form-control" placeholder="Type here...">
                </div>

                <table class="table table-striped table-bordered" id="sort" 
                >
                <!--
                data-show-export="true"
                data-export-types="['excel']"
                data-search="true"
                data-show-refresh="true"
                data-show-toggle="true"
                data-query-params="queryParams" 
                data-pagination="true"
                data-height="300"
                data-show-columns="true" 
                data-export-options='{
                         "fileName": "preparation_app", 
                         "worksheetName": "test1",         
                         "jspdf": {                  
                           "autotable": {
                             "styles": { "rowHeight": 20, "fontSize": 10 },
                             "headerStyles": { "fillColor": 255, "textColor": 0 },
                             "alternateRowStyles": { "fillColor": [60, 69, 79], "textColor": 255 }
                           }
                         }
                       }'
                -->
				    <thead>
				        <tr>
				           {{-- <th>id</th> --}}
				           <th>Cartonbox</th>
				           <th style="background-color: cornsilk;"><b>Po</b></th>
				           {{-- <th>Po status</th> --}}
				           <th>Size</th>
				           <th>Style</th>
				           <th>Color</th>
				           <th>ColorDesc</th>
				           <th style="background-color: aliceblue;">Qty</th>
				           <th style="background-color: beige;">Location</th>
				           <th>Standard Qty</th>
				           <th style="background-color: antiquewhite;">Comment</th>
				           <th>Last used</th>
				           <th>In days</th>
				           <th>Status</th>
				           <th>Flash</th>
				           <th>Flag</th>
				           {{-- <th>Created at</th> --}}
				           {{-- <th>Edited at</th> --}}

				           <th></th>
				           <th></th>
				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	<td>{{ $d->cartonbox }}</td>
				        	<td style="background-color: cornsilk;"><b>{{ substr($d->po, 8, 6) }}</b></td>
				        	{{-- <td>{{ $d->po_status }}</td> --}}
				        	<td>{{ $d->size }}</td>
				        	<td>{{ $d->style }}</td>
				        	<td>{{ $d->color }}</td>
				        	<td>{{ $d->colordesc }}</td>
				        	<td style="background-color: aliceblue;">{{ $d->qty }}</td>
				        	<td style="background-color: beige;">{{ $d->location }}</td>
				        	<td>{{ $d->standard_qty }}</td>
				        	<td style="background-color: antiquewhite;">{{ $d->coment }}</td>
				        	<td>{{ Carbon\Carbon::parse($d->lastused)->format('d.m.Y') }}</td>
				        	<td>{{ Carbon\Carbon::parse($d->lastused)->diffInDays(Carbon\Carbon::now()) }}</td>
				        	<td>{{ $d->status }}</td>
				        	<td>{{ $d->flash }}</td>
				        	<td>{{ $d->flag }}</td>
				        	{{-- <td>{{ substr($d->created_at, 0, 19) }}</td> --}}
				        	{{-- <td>{{ substr($d->updated_at, 0, 19) }}</td> --}}

				        	<td><a href="{{ url('/table/edit/'.$d->id) }}" class="btn btn-info btn-xs center-block">Edit</a></td>
				        	<td><a href="{{ url('/table/remove/'.$d->id) }}" class="btn btn-danger btn-xs center-block">Remove</a></td>
				        	
						</tr>
				    
				    @endforeach
				    </tbody>

				</table>
			</div>
		</div>
	</div>
</div>

@endsection