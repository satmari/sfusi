<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DateTime;
use Carbon\Carbon;

use App\sfusiStock;
use App\shipStock;
use DB;

class ShipTableController extends Controller {

	public function index()
	{
		//
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM shipStock"));
		return view('Table.index_s',compact('data'));
	}	

	public function remove() 
	{
		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT id FROM shipStock"));

		// dd($data);

		for ($i=0; $i < count($data); $i++) { 

			$results = shipStock::where('id', '=', $data[$i]->id)->delete();
		}

		return view('home');
	}

}
