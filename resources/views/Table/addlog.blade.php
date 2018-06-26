@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row vertical-center-row">
		<div class="text-center">
			<div class="panel panel-default">
				<div class="panel-heading h-n"><big>Add log table</big></div>
				<a href="{{ url('/clearlogtable') }}" class="btn btn-danger">Clear Log table</a>
				<div class="input-group"> <span class="input-group-addon">Filter</span>
                    <input id="filter" type="text" class="form-control" placeholder="Type here...">
                </div>
                <table class="table table-striped table-bordered" id="sort" 
                data-show-export="true"
                data-export-types="['excel']"
                >
                <!--
                
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
				           <th>Cartonbox used</th>
				           <th style="background-color: cornsilk;" data-sortable="true"><b>Po</b></th>
				           <th>Style</th>
				           <th data-sortable="true">Size</th>
				           <th>Color</th>
				           <th>ColorDesc</th>
				           <th style="background-color: aliceblue;"><b>Qty</b></th>
				           <th>Standard Qty</th>
				           <th>Module</th>
				           <th>Created at</th>

				        </tr>
				    </thead>
				    <tbody class="searchable">
				    
				    @foreach ($data as $d)
				    	
				        <tr>
				        	{{-- <td>{{ $d->id }}</td> --}}
				        	<td>{{ $d->cartonbox }}</td>
				        	<td>{{ $d->cartonbox_old }}</td>
				        	<td style="background-color: cornsilk;"><b>{{ substr($d->po, 8, 6) }}</b></td>
				        	<td>{{ $d->style }}</td>
				        	<td>{{ $d->size }}</td>
				        	<td>{{ $d->color }}</td>
				        	<td>{{ $d->colordesc }}</td>
				        	<td style="background-color: aliceblue;"><b>{{ $d->qty }}</b></td>
				        	<td>{{ $d->standard_qty }}</td>
				        	<td>{{ $d->module }}</td>
					        <td>{{ substr($d->created_at, 0, 19) }}</td>
				        	
						</tr>
				    
				    @endforeach
				    </tbody>

				</table>
			</div>
		</div>
	</div>
</div>

@endsection