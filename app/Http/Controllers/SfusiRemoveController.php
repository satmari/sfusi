<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\sfusiStock;
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

			$cb = DB::connection('sqlsrv')->select(DB::raw("SELECT id,cartonbox,qty FROM sfusiStock WHERE cartonbox = ".$cbcode));
			// dd($cb);

			if (empty($cb)) {
				$msg = 'Cartonbox not exist on stock';
			    
			} else {

				$id = $cb[0]->id;
				$cartonbox = $cbcode;
				$qty = $cb[0]->qty;

				$cbarray = array(
				'id' => $id,
				'cartonbox' => $cartonbox,
				'qty' => $qty
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
					// dd($line['cartonbox']);
					// if ($line == 'cartonbox') {
						// dd($line);
						$results = sfusiStock::where('cartonbox', '=', $line['cartonbox'])->delete();
					// }
				
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
