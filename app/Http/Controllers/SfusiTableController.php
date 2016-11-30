<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\sfusiStock;
use DB;

class SfusiTableController extends Controller {

	
	public function index()
	{
		//

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sfusiStock"));
		return view('Table.index',compact('data'));
	}

	public function edit($id)
	{
		//

		$box = sfusiStock::findOrFail($id);
		return view('Table.edit', compact('box'));
	}

	public function edit_update($id, Request $request)
	{
		$this->validate($request, ['qty' => 'required']);
		$input = $request->all(); 

		$qty = $input['qty'];
		// $location = $input['location'];

		
		if ($input['coment']) {
			$coment = $input['coment'];	
		} else {
			$coment = NULL;
		}
		
		try {
			$box = sfusiStock::findOrFail($id);
			$box->qty = $qty;
			$box->coment = $coment;
			// $box->location = $location;

			$box->save();
			return Redirect::to('/table');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/table');
		}
	}

	public function remove($id)
	{
		
		try {
			$table = sfusiStock::findOrFail($id);
		
			$table->delete();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to delete in sfusiStock table";
			return view('Add.error',compact('msg'));		
		}
		
		return Redirect::to('/table');
	}

	public function refresh()
	{
		$boxlist = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sfusiStock"));
		// dd(count($data));
		if ($boxlist) {

			function object_to_array($data)
			{
			    if (is_array($data) || is_object($data))
			    {
			        $result = array();
			        foreach ($data as $key => $value)
			        {
			            $result[$key] = object_to_array($value);
			        }
			        return $result;
			    }
			    return $data;
			}

			foreach ($boxlist as $line) {
				// dd($line);
				// Last box used
				$id = $line->id;
				$po = $line->po;
				$variant = $line->color."-".$line->size;
				// dd($variant);

				// Inteos - box information
				$inteos = DB::connection('sqlsrv2')->select(DB::raw("SELECT	TOP 1
					cb.EDITDATE /*,
					cb.BoxNum,
					po.POnum,
					sku.Variant*/
					
					FROM            dbo.CNF_CartonBox AS cb 
					LEFT OUTER JOIN dbo.CNF_PO AS po ON cb.IntKeyPO = po.INTKEY 
					LEFT OUTER JOIN dbo.CNF_SKU AS sku ON po.SKUKEY = sku.INTKEY
					LEFT OUTER JOIN dbo.CNF_STYLE AS st ON sku.STYKEY = st.INTKEY
									
					WHERE			po.POnum = :po AND sku.Variant = :variant

					GROUP BY		
									cb.EDITDATE/*,
									cb.BoxNum,
									po.POnum,
									sku.Variant*/
					ORDER BY EDITDATE desc
								"
					), array(
						'po' => $po, 'variant' => $variant
				));
				// dd($inteos);

				$inteos_array = object_to_array($inteos);

		    	$lastused = $inteos_array[0]['EDITDATE'];
		    	// dd($lastused);

		    	try {
					$box = sfusiStock::findOrFail($id);
					$box->lastused = $lastused;
					
					$box->save();
					
				}
				catch (\Illuminate\Database\QueryException $e) {
					// return Redirect::to('/table');
				}


				// Add Nav details (flash, status, flag)

				// NAV - PO information
				$nav = DB::connection('sqlsrv3')->select(DB::raw("SELECT [No_]
					      /*,[Status]*/
					      ,(CASE WHEN [Status] = '3' THEN 'Released' WHEN [Status] = '4' THEN 'Finished' WHEN [Status] = '0' THEN 'Simulate' END) AS Status
					      /*,[Flash Order]*/
					      ,(CASE WHEN [Flash Order] = '0' THEN '' WHEN [Flash Order] = '1' THEN 'Flash' END) AS Flash
					      /*,[To be finished]*/
					      ,(CASE WHEN [To be finished] = '0' THEN '' WHEN [Flash Order] = '1' THEN 'To be fin' END) AS To_be_finished
					      /*,[To Be Consumned]*/
					      ,(CASE WHEN [To Be Consumned] = '0' THEN '' WHEN [To Be Consumned] = '1' THEN 'To be con' END) AS To_be_consumed
					  FROM [Gordon_LIVE].[dbo].[GORDON\$Production Order]
					  WHERE [No_] = :po"
					), array(
						'po' => $po
				));
				// dd($nav);

				$status = $nav[0]->Status;
				$flash = $nav[0]->Flash;
				$To_be_finished = $nav[0]->To_be_finished;
				$To_be_consumed = $nav[0]->To_be_consumed;

				$flag = $To_be_consumed.$To_be_finished;

				try {
					$box = sfusiStock::findOrFail($id);
					$box->status = $status;
					$box->flash = $flash;
					$box->flag = $flag;
					
					$box->save();
					
				}
				catch (\Illuminate\Database\QueryException $e) {
					// return Redirect::to('/table');
				}

			}
		}
	    	
		return Redirect::to('/table');
	}


}
