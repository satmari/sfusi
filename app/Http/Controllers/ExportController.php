<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\sfusiStock;
use Excel;
use DB;

class ExportController extends Controller {

	public function index()
	{
		//
		$list = sfusiStock::all();

        $csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());

        $csv->insertOne(\Schema::getColumnListing('sfusiStock'));

        foreach ($list as $line) {
            $csv->insertOne($line->toArray());
        }

        $csv->output('sfusiStock.csv');
	}


}
