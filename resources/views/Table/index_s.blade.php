@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<!-- <div class="panel-heading h-n">SFUSI stock table</div> -->

				<a href="{{ url('/remove_ship_table') }}" class="btn btn-danger btn-s">Remove all box</a>
				<br>
                <div class="input-group"> <span class="input-group-addon">Filter</span>
                    <input id="filter" type="text" class="form-control" placeholder="Type here...">
                </div>

                <table class="table table-striped table-bordered" id="sort" 
                data-show-export="true"
                data-export-types="['excel']"
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
				           <th style="background-color: cornsilk;" data-sortable="true"><b>Po</b></th>
				           {{-- <th>Po status</th> --}}
				           <th data-sortable="true">SKU</th>
				           <th>ColorDesc</th>
				           <th style="background-color: aliceblue;"><b>Qty</b></th>
				           <th style="background-color: beige;"><b>Location</b></th>
				           <th>Standard Qty</th>
				           <th style="background-color: azure;">Comment</th>
				           <th>Last used</th>
				           <th data-sortable="true">In days</th>
				           <!-- <th>Status</th>
				           <th>Flash</th>
				           <th>Flag</th> -->
				           <th>Edited at</th>
				           <th></th>

				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	<td>{{ $d->cartonbox }}</td>
				        	<td style="background-color: cornsilk;"><b>{{ $d->po }}</b></td>
				        	{{-- <td>{{ $d->po_status }}</td> --}}
				        	<td><pre>{{ trim($d->sku) }}</pre></td>
				        	<td>{{ $d->colordesc }}</td>
				        	<td style="background-color: aliceblue;"><b>{{ $d->qty }}</b></td>
				        	<td style="background-color: beige;"><b>{{ $d->location }}</b></td>
				        	<td>{{ $d->standard_qty }}</td>
				        	<td style="background-color: azure;">{{ $d->coment }}</td>
				        	<td>{{ Carbon\Carbon::parse($d->lastused)->format('d.m.Y') }}</td>
				        	<td class="days">{{ Carbon\Carbon::parse($d->lastused)->diffInDays(Carbon\Carbon::now()) }}</td>
				        	{{-- <td>{{ $d->status }}</td>
				        	<td>{{ $d->flash }}</td>
				        	<td>{{ $d->flag }}</td> --}}
				        	<td>{{ substr($d->updated_at, 0, 19) }}</td>
				        	<td><a href="{{ url('/table_s/remove/'.$d->id) }}" class="btn btn-danger btn-xs center-block">Remove</a></td>

				        </tr>
				    
				    @endforeach
				    </tbody>

				</table>
			</div>
		</div>
	</div>
</div>

@endsection