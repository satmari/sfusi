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
		$location = $input['location'];

		
		if ($input['coment']) {
			$coment = $input['coment'];	
		} else {
			$coment = NULL;
		}
		
		try {
			$box = sfusiStock::findOrFail($id);
			$box->qty = $qty;
			$box->coment = $coment;
			$box->location = $location;

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


}
