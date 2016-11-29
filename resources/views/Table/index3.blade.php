@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row vertical-center-row">
        <div class="text-center">
            
                <div class="row">
                    <div class="col-md-16">
                        <div class="panel panel-default">
                            <div class="panel-heading">Batch Table 
                            
                            </div>
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
                                       <th>id</th>
                                       <th>Cartonbox</th>
                                       <th>Po</th>
                                       <th>Po status</th>
                                       <th>Style</th>
                                       <th>Color</th>
                                       <th>Size</th>
                                       <th>Qty</th>
                                       <th>Standard Qty</th>
                                       <th></th>
                                       <th></th>
                                    </tr>
                                </thead>
                                <tbody class="searchable">
                                
                                @foreach ($data as $d)

                                    <tr>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->cartonbox }}</td>
                                        <td>{{ $d->po }}</td>
                                        <td>{{ $d->po_status }}</td>
                                        <td>{{ $d->style }}</td>
                                        <td>{{ $d->color }}</td>
                                        <td>{{ $d->size }}</td>
                                        <td>{{ $d->qty }}</td>
                                        <td>{{ $d->standard_qty }}</td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                
                                @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
         </div>
    </div>
</div>
@endsection