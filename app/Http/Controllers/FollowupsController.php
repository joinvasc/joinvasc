<?php

namespace App\Http\Controllers;

use App\AmbulatoryCare;
use App\FirstEvent;
use App\Followup;
use App\Option;
use App\Patient;
use App\CurrentEvent;
use App\Death;
use App\Demographic;
use App\Discharge;
use App\Biobase;
use App\Epivasc;
use App\Exams;
use App\ImageEvaluations;
use App\Indicators;
use App\PatientOrigin;
use App\RiskFactors;
use App\SocioeconomicCondition;
use App\FormAlta;
use App\ImageForm;
use App\Transformers\FollowupTransformer;
use App\Transformers\OptionTransformer;
use Carbon\Carbon;
use App\Export\ExportCenter;
use Illuminate\Http\Request;
use Session;
use Auth;

class FollowupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $followup = fractal()->item(new Followup([]), new FollowupTransformer())->toArray();

        $options = collect(fractal()->collection(Option::all(), new OptionTransformer())->toArray()['data']);

        $user = Session::get('access_level');
        $group = \Auth::user()->group;

        \JavaScript::put([
            '__STATE__' => [
                'followup' => $followup,
                'action'   => 'create',
                'options'  => $options->groupBy('group')->toArray(),
                'user'     => $user,
                'group'    => $group
            ],
        ]);

        return view('followups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Followup $followup)
    {
        $options = collect(fractal()->collection(Option::all(), new OptionTransformer())->toArray()['data']);

        $user = Session::get('access_level');

        $group = \Auth::user()->group;

        \JavaScript::put([
            '__STATE__' => [
                'followup' => fractal()->item($followup, new FollowupTransformer())->toArray(),
                'action'   => 'update',
                'options'  => $options->groupBy('group')->toArray(),
                'user'     => $user,
                'group'    => $group
            ],
        ]);

        //return fractal()->item($followup, new FollowupTransformer())->toArray();
        return view('followups.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function verifyAmbulatoryCareData(Request $followupId)
    {

      $targetPatient = [];
       $followup = Followup::where('id', $followupId->input('id'))->get()->first();
       $targetPatient =  fractal()->item($followup, new FollowupTransformer())->toArray();
       
       $event = substr($targetPatient['current_event']['event_datetime'],0,-8);
       $lastEvent = date('Y-m-d', strtotime(str_replace('/', '-', $event)));
       $currentDate = date('Y-m-d', Time());
       $datesDiff = abs(strtotime($currentDate) - strtotime($lastEvent));
       $daysDiff = round($datesDiff / (60 * 60 * 24));
              
       $doFollowup = true;
       $msg ="";
       switch (true) {
           case ($daysDiff  > 31  && $this->followupIsEmpty($targetPatient['ambulatory_care']['follow30'])):
                    $msg = "Realizar acompanhamento de 30 dias";
               break;
            case ($daysDiff  > 165 && $this->followupIsEmpty($targetPatient['ambulatory_care']['follow3m'])):
                $msg = "Realizar acompanhamento de 3 meses";
                break;
            case ($daysDiff  > 365 && $this->followupIsEmpty($targetPatient['ambulatory_care']['follow1a'])):
                $msg = "Realizar acompanhamento de 1 ano";
                break;
            case ($daysDiff  > 730 && $this->followupIsEmpty($targetPatient['ambulatory_care']['follow2a'])):
                $msg = "Realizar acompanhamento de 2 anos";
                break;
            case ($daysDiff  > 1095 && $this->followupIsEmpty($targetPatient['ambulatory_care']['follow3a'])):
                $msg = "Realizar acompanhamento de 3 anos";
                break;
            case ($daysDiff  > 1460 && $this->followupIsEmpty($targetPatient['ambulatory_care']['follow4a'])):
                $msg = "Realizar acompanhamento de 4 anos";
                break;
            case ($daysDiff  > 1825 && $this->followupIsEmpty($targetPatient['ambulatory_care']['follow5a'])):
                $msg = "Realizar acompanhamento de 5 anos";
                break;
           default:
                $doFollowup = false;
               break;
       }

        $jsonMensage = array(
                        'doFollowup' =>  $doFollowup,
                        'msg' => $msg);
        return  json_encode($jsonMensage);
    }

    public function followupIsEmpty($followup){
        $followup = json_decode(json_encode($followup), True);
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

    public function getLastEvents(Request $patientId){
        
        $events = Followup::where('followups.patient_cpf', $patientId->input('cpf'))
        ->select('followups.admission_date')->orderBy('followups.admission_date', 'asc')->get()->toArray();

        $colums = [];
        for($x=0;$x < count($events);$x++){
            $eventData = array("event" => ($x+1)." Evento", 
            "admission_date" => $events[$x]['admission_date'] = date("d/m/Y", strtotime($events[$x]['admission_date'])));
           $colums[$x] = $eventData;
    
        }
        unset($colums[count($colums)-1]);
        return json_encode($colums);
    }

    public function isEnable(Request $followupId){
        $followup = Followup::where('id', $followupId->input('id'))->get()->first();
        if($followup != null){
            return json_encode(fractal()->item($followup, new FollowupTransformer())->toArray());
        }else{
            return null;
        }
    }

    public function getQrCodePatientData($followupId){

        $qrCodeData = Followup::join('patients', 'followups.PersonId', '=', 'patients.id_person')
        ->join('biobases', 'followups.id', '=', 'biobases.followup_id')
        ->where( 'followups.id', $followupId)
        ->select('patients.id', 'patients.name', 'patients.cpf', 'biobases.receipt_date', 'biobases.extraction_date', 
                    'biobases.dna_quantification', 'biobases.storage_date', 'biobases.freezer_location', 'biobases.note')
        ->get()->first()->toArray();

        $qrCodeData['id'] = ($qrCodeData['id'] != null) ? $qrCodeData['id'] : "Não cadastrado";
        $qrCodeData['name'] = ($qrCodeData['name'] != null) ? $qrCodeData['name'] : "Não cadastrado";
        $qrCodeData['cpf'] = ($qrCodeData['cpf'] != null) ? $qrCodeData['cpf'] : "Não cadastrado";
        $qrCodeData['receipt_date'] = ($qrCodeData['receipt_date'] != null) ? date('d/m/y', strtotime($qrCodeData['receipt_date'])) : "Não cadastrado";
        $qrCodeData['extraction_date'] = ($qrCodeData['extraction_date'] != null) ? date('d/m/y', strtotime($qrCodeData['extraction_date'])) : "Não cadastrado";
        $qrCodeData['dna_quantification'] = ($qrCodeData['dna_quantification'] != null) ? $qrCodeData['dna_quantification'] : "Não cadastrado";
        $qrCodeData['storage_date'] = ($qrCodeData['storage_date'] != null) ? date('d/m/y', strtotime($qrCodeData['storage_date'])) : "Não cadastrado";
        $qrCodeData['freezer_location'] = ($qrCodeData['freezer_location'] != null) ? $qrCodeData['freezer_location'] : "Não cadastrado";
        $qrCodeData['note'] = ($qrCodeData['note'] != null) ? $qrCodeData['note'] : "Não cadastrado";

        return stripslashes(json_encode($qrCodeData, JSON_UNESCAPED_UNICODE));
    }

    public function createControl(Request $request){
       
    }

    public function getAllPatientsDashboard(){
        $patients = Followup::join('patients', 'followups.PersonId', '=', 'patients.id_person')
        ->join('biobases', 'followups.id', '=', 'biobases.followup_id')
        ->join('discharges', 'followups.id', '=', 'discharges.followup_id')
        ->select('patients.cpf', 'patients.id_person', 'patients.name', 'followups.id', 'followups.interview_date', 'followups.event', 'followups.PersonID', 'followups.disabled', 'discharges.date')
        ->get()->toArray();

        $returnTable = [];
        for($x=0; $x < sizeof($patients); $x++ ){
            array_push($returnTable, array( 
                "cpf" => $patients[$x]['cpf'], 
                "name" => $patients[$x]['name'], 
                "event" =>  $patients[$x]['event'], 
                "interview_date" =>  $patients[$x]['interview_date'], 
                "status" =>  ($patients[$x]['disabled']==null)? "Ativo": "Arquivado", 
               // "data" =>  $this->verifyData($patients[$x]['patientid']), //novo
               // "biobase" =>  $this->verifyBiobase($patients[$x]['patientid']), //novo
                "discharge" =>  ($patients[$x]['date']!=null)? "Sim" : "Não" , 
                "PersonID" =>  $patients[$x]['PersonID'], 
                "id_person" =>  $patients[$x]['id_person'], 
                "id_followup" =>  $patients[$x]['id'], 
            ));
       } 

       return $returnTable;
    }

    public function deletePatient(Request $request){

        $patient = $request->input('patient');
        uasort($patient, array($this,'comparePatient'));

        for($x=0; $x<count($patient); $x++){

            Patient::where('id_person', $patient[$x]['row']['id_person'])->delete();
            FirstEvent::where('followup_id', $patient[$x]['row']['id_followup'])->delete();
            CurrentEvent::where('followup_id', $patient[$x]['row']['id_followup'])->delete();
            Exams::where('followup_id', $patient[$x]['row']['id_followup'])->delete();
            Demographic::where('followup_id', $patient[$x]['row']['id_followup'])->delete();
            PatientOrigin::where('followup_id', $patient[$x]['row']['id_followup'])->delete();
            SocioeconomicCondition::where('followup_id', $patient[$x]['row']['id_followup'])->delete();
            RiskFactors::where('followup_id', $patient[$x]['row']['id_followup'])->delete();
            Discharge::where('followup_id', $patient[$x]['row']['id_followup'])->delete();
            Biobase::where('followup_id', $patient[$x]['row']['id_followup'])->delete();
            FormAlta::where('followup_id', $patient[$x]['row']['id_followup'])->delete();
            Epivasc::where('followup_id', $patient[$x]['row']['id_followup'])->delete();
            ImageForm::where('followup_id', $patient[$x]['row']['id_followup'])->delete();
            AmbulatoryCare::where('followup_id', $patient[$x]['row']['id_followup'])->delete();
            Death::where('followup_id', $patient[$x]['row']['id_followup'])->delete();
            Followup::where('id', $patient[$x]['row']['id_followup'])->delete();

            $statusLastEvent = Followup::where('followups.patient_cpf', $patient[$x]['row']['cpf'])->orderBy('followups.PersonID', 'desc')->get()->first();
            if($statusLastEvent != null && $statusLastEvent->id < $patient[$x]['row']['id_followup']){
                Followup::where('PersonID', $statusLastEvent->PersonID)->update(['disabled' => null]);;
                Followup::where('PersonID', $statusLastEvent->PersonID)->update(['reason' => null]);  
            }
        }        
    }

    public function comparePatient($a, $b){
        return ($a['row']['id_person'] > $b['row']['id_person'])? -1 : 1 ;
    }
}
