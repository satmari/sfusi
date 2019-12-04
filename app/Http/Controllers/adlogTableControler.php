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

	public function deletelogtable()
	{
		//
		
		return view('Table.deletelog');		
	}

	public function deletelogtableconfirm(Request $request)
	{
		//
		// Validate
		$this->validate($request, ['from'=>'required', 'to'=>'required']);

		$input = $request->all(); 
		// var_dump($input);
	
		$from = $input['from'];
		$to = $input['to'];

		// dd($from);

		$sql1 = DB::connection('sqlsrv')->select(DB::raw("SET NOCOUNT ON;
					DELETE FROM addlogs
					WHERE created_at > '".$from."' AND created_at < '".$to."';
					SELECT TOP 1 id FROM addlogs; "));
		
		return redirect('addlogtable/');
	}


}
