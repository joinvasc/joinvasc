<?php

namespace App\Http\Controllers;

use App\FirstEvent;
use App\Followup;
use App\Option;
use App\Patient;
use App\Transformers\FollowupTransformer;
use App\Transformers\OptionTransformer;
use Carbon\Carbon;
use App\Export\ExportCenter;
use Illuminate\Http\Request;


class CallReportController extends Controller
{
	public function index()
	{
		return view('callReport');
    }
    
    public function getAllPatients(Request $filter){

        $followupFilterAll = array(1, 6, 12, 24, 36, 48, 60);
        
        $followupList = Followup::join('patients', 'followups.PersonID', '=', 'patients.id_person')
        ->join('current_events', 'followups.id', '=', 'current_events.followup_id' )
        ->join('ambulatory_care', 'followups.id', '=', 'ambulatory_care.followup_id' )
        ->join('deaths', 'followups.id', '=', 'deaths.followup_id' )
        ->select('patients.name as patientname', 'patients.id as patientid','followups.disabled', 'current_events.event_datetime as eventdatetime', 'ambulatory_care.*', 'deaths.date as deathdate');
        
        if($filter->input('initialDate') != null || $filter->input('endDate') != null || $filter->input('followupsFilter') != null){
        
            $initialDateSplit = explode('/', $filter->input('initialDate'));
            $endDateSplit = explode('/', $filter->input('endDate'));
            $initialDate = $initialDateSplit[2]."-".$initialDateSplit[1]."-".$initialDateSplit[0];
            $endDate = $endDateSplit[2]."-".$endDateSplit[1]."-".$endDateSplit[0];

            $followupsFilter = $filter->input('followupsFilter');
            if(in_array(100, $followupsFilter)){
                $followupsFilter = $followupFilterAll;
            }

            for($i=0; $i < sizeof($followupsFilter); $i++ ){
                $initialDateFilter = date("Y-m-d", strtotime("-".$followupsFilter[$i]." months",strtotime($initialDate)));
                $endDateFilter = date("Y-m-d", strtotime("-".$followupsFilter[$i]." months",strtotime( $endDate)));
                $followupList->orWhere(function($query) use ( $initialDateFilter, $endDateFilter){

                    return $query->where('current_events.event_datetime', '<=', $endDateFilter )->where('current_events.event_datetime', '>=', $initialDateFilter);

                });
            }
        }

        $followupList = $followupList->get()->toArray();
        $returnTable = [];

        for($x=0; $x < sizeof($followupList); $x++ ){
            if($followupList[$x]['disabled'] == 1 || $followupList[$x]['disabled'] == 2 || $followupList[$x]['disabled'] == 3|| $followupList[$x]['eventdatetime'] == null || $followupList[$x]['deathdate'] != null){
                continue;
            }
            array_push($returnTable, array( 
                "name" => $followupList[$x]['patientname'], 
                "prontuario" => $followupList[$x]['patientid'], 
                "followup30" => ($this->followupStatus($followupList[$x]['follow30'], $followupList[$x]['eventdatetime'] , 31)),
                "followup3m" => ($this->followupStatus($followupList[$x]['follow3m'], $followupList[$x]['eventdatetime'] , 165)),
                "followup1a" => ($this->followupStatus($followupList[$x]['follow1a'], $followupList[$x]['eventdatetime'] , 365)),
                "followup2a" => ($this->followupStatus($followupList[$x]['follow2a'], $followupList[$x]['eventdatetime'] , 730)),
                "followup3a" => ($this->followupStatus($followupList[$x]['follow3a'], $followupList[$x]['eventdatetime'] , 1095)),
                "followup4a" => ($this->followupStatus($followupList[$x]['follow4a'], $followupList[$x]['eventdatetime'] , 1460)),
                "followup5a" => ($this->followupStatus($followupList[$x]['follow5a'], $followupList[$x]['eventdatetime'] , 1825)),          
                "personid" => $followupList[$x]['followup_id'],          
            ));
       } 

       uasort($returnTable, array($this,'compareFollow'));
       return json_encode(array_values($returnTable));
    }

    public  function compareFollow($a, $b)
    {
        if($a == $b) {
            return 0;
        }
        $num_valuesA = array_count_values($a);
        $num_valuesB = array_count_values($b);
        return ((isset($num_valuesA["Pendente"])? $num_valuesA["Pendente"] : 0 ) > (isset($num_valuesB["Pendente"])? $num_valuesB["Pendente"] : 0)) ? -1 : 1;
    }

    public function followupStatus($followup, $discherge, $period){

        $event = substr($discherge,0,-8);
        $lastEvent = date('Y-m-d', strtotime(str_replace('/', '-', $event)));
        $currentDate = date('Y-m-d', Time());
        $datesDiff = abs(strtotime($currentDate) - strtotime($lastEvent));
        $daysDiff = round($datesDiff / (60 * 60 * 24));

        switch (true) {
            case ($daysDiff  >= $period  && $this->followupIsEmpty($followup)):
                return "Pendente";
                break;
            case ($daysDiff  < $period  && $this->followupIsEmpty($followup)):
                return " ";
                break;
            case ($daysDiff  > $period  && !$this->followupIsEmpty($followup)):
                return "Realizado";
                break;
            default:
                return "Antecipado";
                break;
        }
    }

    public function followupIsEmpty($followup){
        $followup = json_decode($followup, True);
        $numberOfValues = array_filter($followup, array($this, "jsonIsEmpty"));
        $isEmpty = empty($numberOfValues);
        return $isEmpty;
    }

    public function jsonIsEmpty($var){
        if (array_key_exists("rankin_sequel", (array)$var)) {
            $var = !count(array_unique((array)$var)) === 1;
        }
        return (!empty($var));
    }
}