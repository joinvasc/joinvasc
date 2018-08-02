<?php

namespace App\Http\Controllers;

use App\ExportProfile;
use App\Followup;
use App\Option;
use App\Patient;
use App\Transformers\FollowupTransformer;
use App\Transformers\OptionTransformer;
use Carbon\Carbon;
use App\Export\ExportCenter;
use Illuminate\Http\Request;

class ExportController extends Controller
{
	public function index()
	{
		return view('export');
    }

    public function getAllExportOptions(){
        $exportProfileNames = ExportProfile::select('name', 'columns')->get()->toArray();
        return json_encode($exportProfileNames);
    }

	public function getExportFile(Request $request)
    {
        $followupGroup = [];
        $followupList = Followup::get();
        foreach ($followupList as $value) {
            $followupGroup[] = fractal()->item($value, new FollowupTransformer())->toArray();
        }

        $rel = ExportCenter::CreateExcelFile($followupGroup, $request->input('options'));

        return $rel;
	}
	
	public function saveProfile(Request $request){
		$exportProfile = new ExportProfile();
		$exportProfile->name = $request->input('profileName');
		$exportProfile->columns = $request->input('selectedMenus');
		$exportProfile->save();
    }
}