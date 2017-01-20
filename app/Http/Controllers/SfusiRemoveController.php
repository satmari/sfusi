<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\sfusiStock;
use App\shipStock;
use DB;

use Session;

class SfusiRemoveController extends Controller {

	public function index()
	{

		$ses = Session::get('cb_to_remove');
		//ses = $request->session()->get('bb_to_remove');
		return view('Remove.index',compact('ses'));
	}

	public function destroy(Request $request)
	{
		//remove CB
		//validation
		//$this->validate($request, ['bb_to_remove'=>'required|max:10']);

		$input = $request->all(); // change use (delete or comment user Requestl; )
		//var_dump($inteosinput);
	
		$cbcode = $input['cb_to_remove'];
		//$results = bbStock::where('bbcode', '=', $bb_to_remove)->delete();
		//dd($bbcode);

		if ($cbcode) {

			$cb = DB::connection('sqlsrv')->select(DB::raw("SELECT id,cartonbox,po,size,qty FROM sfusiStock WHERE cartonbox = ".$cbcode));
			// dd($cb);

			if (empty($cb)) {
				$msg = 'Cartonbox not exist on stock';
			    
			} else {

				$id = $cb[0]->id;
				$cartonbox = $cbcode;
				$qty = $cb[0]->qty;
				$size = $cb[0]->size;
				$po = $cb[0]->po;


				$cbarray = array(
				'id' => $id,
				'cartonbox' => $cartonbox,
				'qty' => $qty,
				'size' => $size,
				'po' => $po
				);

				Session::push('cb_to_remove_array',$cbarray);
			}
		}

		// dd($cbarray);

		$cb_to_remove_array = Session::get('cb_to_remove_array');
		// dd($cb_to_remove_array);

		if ($cb_to_remove_array != NULL) {

			$cb_to_remove_array_unique = array_map("unserialize", array_unique(array_map("serialize", $cb_to_remove_array)));
			
			$sumofcb = 0;
			foreach ($cb_to_remove_array_unique as $line) {
				// foreach ($line as $key) {
					// dd($line);
					// if ($key == 'cartonbox') {
						// dd($line);
						$sumofcb += 1;
					// }
				// }
			}
		}

		return view('Remove.index',compact('cb_to_remove_array_unique','sumofcb','msg'));	
	}

	public function destroycb(Request $request)
	{

		$cb_to_remove_array = Session::get('cb_to_remove_array');
		// dd($cb_to_remove_array);
		
		//dd($cb_to_remove_array_unique);
		if (isset($cb_to_remove_array)) {
			foreach ($cb_to_remove_array as $line) {
				
				$results = sfusiStock::where('cartonbox', '=', $line['cartonbox'])->delete();
				
			}
			Session::set('cb_to_remove_array', null);
			$msg = "All scanned Cartonbox succesfuly removed from Stock";
			return view('Remove.success',compact('msg'));
		}

		Session::set('cb_to_remove_array', null);
		$msg = "List of Cartonbox to delete is empty";
		return view('Remove.success',compact('msg'));		
	}

	public function destroycb2(Request $request)
	{

		$cb_to_remove_array = Session::get('cb_to_remove_array');
		// dd($cb_to_remove_array);

		if ($cb_to_remove_array != NULL) {

			$cb_to_remove_array_unique = array_map("unserialize", array_unique(array_map("serialize", $cb_to_remove_array)));
			Session::set('cb_to_remove_array', null);
			Session::set('cb_to_remove_array', $cb_to_remove_array_unique);

			$cb_to_remove_array = $cb_to_remove_array_unique;
		}

		$msg1 = "";

		//dd($cb_to_remove_array_unique);
		if (isset($cb_to_remove_array)) {
			foreach ($cb_to_remove_array as $line) {
				
				// $ship_table = shipStock::where('cartonbox', '=', $line['id']);
				$sfusi_table = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sfusiStock WHERE cartonbox = ". $line['cartonbox']));

				$style = $sfusi_table[0]->style;
				$size = $sfusi_table[0]->size;
				$color = $sfusi_table[0]->color;
				// var_dump($style);

				$ship_table = DB::connection('sqlsrv')->select(DB::raw("SELECT cartonbox FROM shipStock WHERE style = '".$style."' AND color = '".$color."' AND size = '".$size."'"));
				// dd($ship_table);

				if (empty($ship_table)){

					// Add to ship
					try {
						$table = new shipStock;

						$table->cartonbox = $sfusi_table[0]->cartonbox;
						$table->po = $sfusi_table[0]->po;
						$table->po_status = $sfusi_table[0]->po_status;

						$table->style = $sfusi_table[0]->style;
						$table->color = $sfusi_table[0]->color;
						$table->colordesc = $sfusi_table[0]->colordesc;
						$table->size = $sfusi_table[0]->size;

						$table->qty = $sfusi_table[0]->qty;
						$table->standard_qty = $sfusi_table[0]->standard_qty;

						$table->location = "SHIP"; 

						$table->save();
					}
					catch (\Illuminate\Database\QueryException $e) {
						$msg = "Problem to save cb in shipstock table";
						return view('Remove.error',compact('msg'));
					}

					// Delete from sfusiStock
					$results = sfusiStock::where('cartonbox', '=', $line['cartonbox'])->delete();	
					
				} else {
					$msg1 = $msg1." ".$line['cartonbox'];
					
				}
			}

			if ($msg1 != "") {
				Session::set('cb_to_remove_array', null);
				$msg = $msg1." This cartonbox have SKU that already exist in SHIP table";
				return view('Remove.error',compact('msg'));
			}
			
			Session::set('cb_to_remove_array', null);
			$msg = "All scanned Cartonbox succesfuly removed from Stock";
			return view('Remove.success',compact('msg'));
		}

		Session::set('cb_to_remove_array', null);
		$msg = "List of Cartonbox to delete is empty";
		return view('Remove.success',compact('msg'));		
	}
}
