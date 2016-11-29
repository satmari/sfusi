<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\sfusiStock;
use DB;

class SfusiAddController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//

		return view('Add.index');
	}

	public function searchinteos(Request $request)
	{
		//
		$this->validate($request, ['inteos_cb_code' => 'required|min:12|max:13']);
		$inteosinput = $request->all(); 
		//

		$inteoscbcode = $inteosinput['inteos_cb_code'];
		// dd($inteoscbcode);
		
		// Live database
		try {
			
			// Inteos - box information
			$inteos = DB::connection('sqlsrv2')->select(DB::raw("SELECT 
				cb.BoxNum,
				cb.Produced,
				po.POnum,
				po.BoxQuant,
				po.POClosed,
				st.StyCod,
				sku.Variant

				FROM            dbo.CNF_CartonBox AS cb 
				LEFT OUTER JOIN dbo.CNF_PO AS po ON cb.IntKeyPO = po.INTKEY 
				LEFT OUTER JOIN dbo.CNF_SKU AS sku ON po.SKUKEY = sku.INTKEY
				LEFT OUTER JOIN dbo.CNF_STYLE AS st ON sku.STYKEY = st.INTKEY
				LEFT OUTER JOIN dbo.CNF_BlueBox AS bb ON cb.BBcreated = bb.INTKEY
				
				WHERE			cb.BoxNum = :somevariable

				GROUP BY		cb.BoxNum,
								cb.Produced,
								po.POnum,
								po.BoxQuant,
								po.POClosed,
								st.StyCod,
								sku.Variant"
				), array(
					'somevariable' => $inteoscbcode
			));

			if ($inteos) {
				//continue
			} else {
	        	$msg = 'Cannot find CB in Inteos, NE POSTOJI KARTONSKA KUTIJA U INTEOSU !';
	        	return view('Add.error', compact('msg'));
	    	}

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
		
	    	$inteos_array = object_to_array($inteos);

	    	$cartonbox = $inteos_array[0]['BoxNum'];
	    	$po = $inteos_array[0]['POnum'];
	    	$po_status = $inteos_array[0]['POClosed'];
	    	
	    	$style = $inteos_array[0]['StyCod'];
	    	$variant = $inteos_array[0]['Variant'];

	    	$qty = $inteos_array[0]['Produced'];
	    	$standard_qty = $inteos_array[0]['BoxQuant'];

	    	$location = NULL;

	    	list($color, $size) = explode('-', $variant);
	    	// dd($size);

	    	// $size_to_search = str_replace("/","-",$size);

	    	// dd($size_to_search);
	    }
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to get data from cb table. try agan.";
			return view('Add.error',compact('msg'));
		}


		return view('Add.checkqty', compact('cartonbox', 'po', 'po_status', 'style', 'color', 'size', 'qty', 'standard_qty', 'location'));
	}

	public function checkqty(Request $request) 
	{
		//
		$this->validate($request, ['qty' => 'required']);
		$input = $request->all(); 
		//

		$cartonbox = $input['cartonbox'];
		$po = $input['po'];
		$style = $input['style'];
		$color = $input['color'];
		$size = $input['size'];
		$qty = (int)$input['qty'];
		$standard_qty = (int)$input['standard_qty'];
		$po_status = $input['po_status'];

		if ($po_status == NULL) {
			$po_status = "Open";
		} else {
			$po_status = "Closed";
		}

		// Search for exist cb
		$exist = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sfusiStock WHERE po = '".$po."' AND size = '".$size."' ORDER BY created_at"));
		// dd($exist);

		if ($exist){
			// dd("exist");

			$exist_qty = $exist[0]->qty;
			$exist_cartonbox = $exist[0]->cartonbox;
			$exist_location = $exist[0]->location;
			$exist_id = $exist[0]->id;

			$sumofqty = $exist_qty + $qty;
			//$standard_qty_num = $standard_qty;
			$noofboxes = ceil($sumofqty/$standard_qty);

			// var_dump("sumofqty = ".$sumofqty);
			// var_dump("standard_qty = ".$standard_qty);
			// var_dump("noofboxes = ".$noofboxes);

			$info = "";
			$case = NULL;

			if ($sumofqty < $standard_qty) {
				$info .= " Box with this SKU already exist, but SUM of qty is less than standard box qty, ";

				if ($exist_qty >= $qty) {
					$info .= " take out garments from NEW and put inside OLD box on same location. ";
					$msg = "OLD STAY";
					$case = 1;

					//Edit existing box in sfusiStock
					try {
						$table = sfusiStock::findOrFail($exist_id);
					
						$table->po_status = $po_status;
						$table->qty = $sumofqty;
						$table->standard_qty = $standard_qty;
																				
						$table->save();
					}
					catch (\Illuminate\Database\QueryException $e) {
						$msg = "Problem to edit in sfusiStock table";
						return view('Add.error',compact('msg'));		
					}

					return view('Add.result', compact('info','msg','case','exist_cartonbox','exist_qty','cartonbox','qty','standard_qty','exist_location'));


				} else {
					$info .= " take out garments from OLD box and put in NEW box on same location. ";
					$msg = "NEW STAY";
					$case = 2;

					//Edit existing box in sfusiStock
					try {
						$table = sfusiStock::findOrFail($exist_id);
					
						$table->cartonbox = $cartonbox;
						
						$table->po_status = $po_status;
						$table->qty = $sumofqty;
						$table->standard_qty = $standard_qty;
																				
						$table->save();
					}
					catch (\Illuminate\Database\QueryException $e) {
						$msg = "Problem to edit in sfusiStock table";
						return view('Add.error',compact('msg'));		
					}

					return view('Add.result', compact('info','msg','case','exist_cartonbox','exist_qty','cartonbox','qty','standard_qty','exist_location'));
						
				}

			} elseif ($sumofqty > $standard_qty) {
				$info .= " Box with this SKU already exist, SUM of qty is higher than standard box qty, ";	

				if ($exist_qty >= $qty) {
					$info .= " take out garments from NEW box and fill up OLD box, after that NEW box put on same location. ";
					$new_qty = $sumofqty - $standard_qty;
					$msg = "NEW STAY +1(full)";
					$case = 3;

					//Edit existing box in sfusiStock
					try {
						$table = sfusiStock::findOrFail($exist_id);
					
						$table->cartonbox = $cartonbox;
						
						$table->po_status = $po_status;
						$table->qty = $new_qty;
						$table->standard_qty = $standard_qty;
														
						$table->save();
					}
					catch (\Illuminate\Database\QueryException $e) {
						$msg = "Problem to edit in sfusiStock table";
						return view('Add.error',compact('msg'));		
					}

					return view('Add.result', compact('info','msg','case','exist_cartonbox','exist_qty','cartonbox','qty','standard_qty','exist_location'));

				} else {
					$info .= " take out garments from OLD box and fill up NEW box, after that OLD box put on same location. ";
					$new_qty = $sumofqty - $standard_qty;
					$msg = "OLD STAY +1(full)";
					$case = 4;

					//Edit existing box in sfusiStock
					try {
						$table = sfusiStock::findOrFail($exist_id);
					
						$table->po_status = $po_status;
						$table->qty = $new_qty;
						$table->standard_qty = $standard_qty;
																				
						$table->save();
					}
					catch (\Illuminate\Database\QueryException $e) {
						$msg = "Problem to edit in sfusiStock table";
						return view('Add.error',compact('msg'));		
					}

					return view('Add.result', compact('info','msg','case','exist_cartonbox','exist_qty','cartonbox','qty','standard_qty','exist_location'));
					
				}


			} elseif ($sumofqty = $standard_qty) {
				// var_dump("");
				$info .= "Sum of garments in OLD and NEW box are enaugth to fill up one box. ";
				$msg = "EXACTLY ONE BOX";
				$case = 5;

				//Delete existing box in sfusiStock
					try {
						$table = sfusiStock::findOrFail($exist_id);
					
						$table->delete();
					}
					catch (\Illuminate\Database\QueryException $e) {
						$msg = "Problem to delete in sfusiStock table";
						return view('Add.error',compact('msg'));		
					}

					return view('Add.result', compact('info','msg','case','exist_cartonbox','exist_qty','cartonbox','qty','standard_qty','exist_location'));

			}	
		} else {
			$info = 'Not on stock before';
			$case = 0;	

			return view('Add.new_box',compact('info','case','cartonbox','po','po_status','style','color','size','qty','standard_qty'));
		}


		// dd($info);
		   
		// return view('Add.result', compact('info'));
		// return Redirect::to('/table');
		// return view('Add.index');

	}
	
	public function add_new_box(Request $request) 
	{
		//
		$this->validate($request, ['location' => 'required']);
		$input = $request->all(); 
		//

		$cartonbox = $input['cartonbox'];
		$po = $input['po'];
		$po_status = $input['po_status'];
		$style = $input['style'];
		$color = $input['color'];
		$size = $input['size'];
		$qty = (int)$input['qty'];
		$standard_qty = (int)$input['standard_qty'];
		
		$location = $input['location'];

		// Add new box to sfusiStock
			try {
				$table = new sfusiStock;

				$table->cartonbox = $cartonbox;
				$table->po = $po;
				$table->po_status = $po_status;

				$table->style = $style;
				$table->color = $color;
				$table->size = $size;

				$table->qty = $qty;
				$table->standard_qty = $standard_qty;

				$table->location = $location; 

				$table->status;
				$table->coloumn;
				
				$table->save();
			}
			catch (\Illuminate\Database\QueryException $e) {
				$msg = "Problem to save cb in sfusistock table";
				return view('Add.error',compact('msg'));
			}

		return Redirect::to('/table');
	}

	public function move()
	{
		//
		return view('Add.move');
	}

	public function move_box(Request $request)
	{

		$this->validate($request, ['inteos_cb_code' => 'required|min:12|max:13']);
		$inteosinput = $request->all(); 
		//

		$inteoscbcode = $inteosinput['inteos_cb_code'];
		$exist = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sfusiStock WHERE cartonbox = '".$inteoscbcode."' ORDER BY created_at"));


		if ($exist) {
			// dd("Exist");
		} else {
        	$msg = 'Cannot find CB in database';
        	return view('Add.error', compact('msg'));
    	}

       	$exist_id = $exist[0]->id;
       	// dd($exist_id);
       	$box = sfusiStock::findOrFail($exist_id);
       	// dd($box->cartonbox);
	   	return view('Add.move_to',compact('box'));

	}
	public function move_to_location($id, Request $request)
	{

		$this->validate($request, ['location' => 'required']);
		$inteosinput = $request->all(); 

		$location = $inteosinput['location'];

		//Edit existing box in sfusiStock
		try {
			$table = sfusiStock::findOrFail($id);
		
			$table->location = $location;
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to edit in sfusiStock table";
			return view('Add.error',compact('msg'));		
		}

		return Redirect::to('/');
	}

}
