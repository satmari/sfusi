<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\addlog;
use DB;

class adlogTableControler extends Controller {

	public function index()
	{
		//

		$data = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM addlogs"));
		return view('Table.addlog',compact('data'));

	}

	public function clearlogtable()
	{
		//
		DB::table('addlogs')->truncate();
		return redirect('addlogtable/');
	}

}
