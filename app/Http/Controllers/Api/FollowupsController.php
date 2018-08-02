<?php
/**
 *
 * User: Harry
 * Date: 05/01/2017
 */
namespace App\Http\Controllers\Api;

use App\FirstEvent;
use App\Followup;
use App\Option;
use App\Patient;
use App\Biobase;
use Carbon\Carbon;
use App\Transformers\FollowupTransformer;
use App\Demographic;
use App\SocioeconomicCondition;
use App\RiskFactors;
use App\Exams;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Auth;


class FollowupsController extends Controller
{
    const RELATION_FIELDS = [
        'ccs',
        'current_event',
        'death',
        'demographic',
        'discharge',
        'biobase',
        'epivasc',
        'exams',
        'first_event',
        //'image_evaluations',
        //'indicators',
        'patient_origin',
        'risk_factors',
        'socioeconomic_conditions',
        'ambulatory_care',
        'imageform',
        'formalta'
    ];

    const UPDATING_FIELDS = [
        'socioeconomic_conditions' => 'App\\SocioeconomicCondition',
        'formalta' => 'App\\FormAlta'
    ];

    public function dataEHoraLogin($valor){

        list($data,$hora) = explode(" - ",$valor);
        list($d,$mo,$y) = explode("/",$data);
        list($h,$m) = explode(":",$hora);
        $timestamp = $y."-".$mo."-".$d." ".$h.":".$m.":00";
        return date("Y-m-d H:i:s", strtotime($timestamp));
    }

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) // :\Illuminate\Http\Response
    {
        // Normalize followup data
        $followupData = $request->get('followup');

        // Normalize patient data
        $patientData = $request->get('patient');

        // Create the records
        $patient = null;
        $followup = null;
       try{ 
        $this->createNewOptions((object)$followupData, (object)$patientData);
       }catch (\Throwable $e) {}
        $insert =  \DB::transaction(function () use ($patientData, $followupData, &$patient, &$followup) {
            try {
                // Create the patient entity

                $statusLastEvent = Followup::where('followups.patient_cpf', $patientData['cpf'])->orderBy('followups.PersonID', 'desc')->get()->first();
                if($statusLastEvent !=null && $statusLastEvent->disabled == 2){
                    return response()->json([
                        'msg' => "Esse paciente está arquivado devido ao óbito do ultimo evento",
                    ], 409);
                }

                $patient = Patient::create($patientData);
                $p = Patient::orderBy('created_at', 'desc')->first();
               
                $followupData['PersonID'] = $p->id_person;

                $idMagrathea = $p->id_person;
                // Create a followup for the patient
                $followup = $patient->followups()->create($followupData);
                $biobaseNam = $followupData['admission_date'];
                $followupData['discharge']['date_now']['descriptions'] = $this->dataEHoraLogin($biobaseNam);
                
                //echo Carbon::createFromFormat('Ydm', $biobaseNam)->format('Ydm')->id;
                // Save followup's relations
                $this->createRelations($followup, $followupData);
                $fractal = fractal()->item($followup, new FollowupTransformer());
                
                $nameMagrathea = $patientData['name'];
                $cpfMagrathea = $patientData['cpf'];
                $birthMagrathea = $patientData['birth_date'];
                if ($birthMagrathea == null) $birthMagrathea = '00-00-0000';
                
                $birthMagrathea = str_replace("/","-",$birthMagrathea); 
                $login = 'username';
                $password = 'nopasswd';
                $url = 'https://joinvasc-staging.herokuapp.com/patient/create';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,"Id=".$idMagrathea."&Document=".$cpfMagrathea."&FullName=".$nameMagrathea."&Birthday=".$birthMagrathea);
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
                $result = curl_exec($ch);
                curl_close($ch); 

                return $fractal;
            } catch (\Throwable $e) {
                if ($e->getCode() === '23000') {
                    return response()->json([
                        'msg' => "Paciente com prontu�rio {$patientData['id']} j� existe.",
                    ], 409);
                }

                return response()->json([
                    'msg' => $e->getMessage(),
                    'code' => $e->getCode(),
                ], 500);
            }
        });
        
        $numberOfEvents = Patient::where('cpf', $patientData['cpf'])->get()->count();

        $currentFollowup = Followup::where('followups.patient_cpf', $patientData['cpf'])->orderBy('followups.PersonID', 'desc')->get()->first();

        Followup::where('PersonID', $currentFollowup->PersonID)->update([
            'group' => \Auth::user()->group
        ]);

        Followup::where('followups.PersonID', $patient->id_person)->update(['event' => $numberOfEvents]);

        if($numberOfEvents > 1){
            $followupImportData = Followup::join('patients', 'followups.PersonId', '=', 'patients.id_person')
                    ->join('demographics', 'followups.id', '=', 'demographics.followup_id')
                    ->join('socioeconomic_conditions', 'followups.id', '=', 'socioeconomic_conditions.followup_id')
                    ->join('risk_factors', 'followups.id', '=', 'risk_factors.followup_id')
                    ->join('ambulatory_care', 'followups.id', '=', 'ambulatory_care.followup_id')
                    ->where('followups.patient_cpf', $patientData['cpf'])
                    ->select('demographics.*', 'demographics.schooling as demographics_schooling', 'socioeconomic_conditions.*','ambulatory_care.*', 'patients.*', 'risk_factors.*', 'followups.PersonID')
                    ->orderBy('followups.PersonID', 'desc')
                    ->get()->toArray();
                    
            $followupImportData2 = Followup::join('patients', 'followups.PersonId', '=', 'patients.id_person')
            ->where('followups.patient_cpf', $patientData['cpf'])->orderBy('followups.PersonID', 'desc')
            ->get()->toArray();

            $currentFollowup = Followup::where('followups.patient_cpf', $patientData['cpf'])->orderBy('followups.PersonID', 'desc')->get()->first();

            Patient::where('id_person', $currentFollowup->PersonID)->update([
                'name' => $followupImportData2[1]['name'],
                'birth_date' => $followupImportData2[1]['birth_date'],
                'gender' => $followupImportData2[1]['gender'],
            ]);

            Demographic::where('followup_id', $currentFollowup->id)->update([
                    'city' => $followupImportData[1]['city'],
                    'address' => $followupImportData[1]['address'],
                    'contact' => $followupImportData[1]['contact'],
                    'schooling' => $followupImportData[1]['demographics_schooling'],
                    'profession' => $followupImportData[1]['profession'],
                    'health' => $followupImportData[1]['health']
                ]);
                
            SocioeconomicCondition::where('followup_id', $currentFollowup->id)->update([
                    'schooling' => $followupImportData[1]['schooling'],
                    'social_class' => $followupImportData[1]['social_class'],
                    'child_health' => $followupImportData[1]['child_health'],
                    'healthcenter_attendance' => $followupImportData[1]['healthcenter_attendance'],
                    'piped_water' => $followupImportData[1]['piped_water'],
                    'paved_street' => $followupImportData[1]['paved_street'],
                    'assets' => $followupImportData[1]['assets']
                ]);

            RiskFactors::where('followup_id', $currentFollowup->id)->update([
                    'avc' => $followupImportData[1]['avc'],
                ]);

                $previusRankin = null;
                $prefixOpt = "exams-previous-rankin-";
                $prefixRemove = "discharge-rankin-";
                $followupsAmbulatory = array("follow5a", "follow4a", "follow3a", "follow2a", "follow1a", "follow3m", "follow30");

                for($x=0;$x<count( $followupsAmbulatory);$x++){
                    if($followupImportData[1][$followupsAmbulatory[$x]] !=null && $previusRankin == null){
                         $previusRankin =$this->getPreviusRankin($followupImportData[1][$followupsAmbulatory[$x]], $prefixRemove,  $prefixOpt );
                    }
                }

            Exams::where('followup_id', $currentFollowup->id)->update([
                    'previous_rankin' => $previusRankin
                ]);
            
            Followup::where('PersonID', $followupImportData[1]['PersonID'])->update(['disabled' => 3]);;
            Followup::where('PersonID', $followupImportData[1]['PersonID'])->update(['reason' => "Novo evento"]);  
        }

        return $insert;
    }
    

    public function getPreviusRankin($value, $oldPrefix, $newPrefix){
        $followAmbu = json_decode($value);
        if($followAmbu->follow_rankin30 != ""){
            return $newPrefix.str_replace($oldPrefix, "", $followAmbu->follow_rankin30);
        }
        return null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Followup $followup) // : \Illuminate\Http\Response
    {
        // Normalize followup data
        $followupData = $request->get('followup');

        // Normalize patient data
        $patientData = $request->get('patient');

        // Find patient
        //$patient = Patient::findOrFail($followup->patient->id);

        // Update the patient entity
        //$patient->fill($patientData);

        //$patient->save();

        // Update the followup
        $followup->fill($followupData);
        $followup->patient->fill($patientData);
        $followup->patient->save();
        $followup->save();

        // Save followup's relations
        try{
            $this->createNewOptions((object)$followupData, (object)$patientData);
        }
        catch(\Exception $ex){}
        $this->updateRelations($followup, (object)$followupData);

        $death = Followup::join('deaths', 'followups.id', '=', 'deaths.followup_id')->where('deaths.followup_id', '=', $followupData['id'])->select('deaths.*')->get()->toArray();

        if($death[0]['date'] !=null || $death[0]['place'] !=null || $death[0]['cause'] !=null ){
            Followup::where('id', $followupData['id'])->update(['disabled' => 2, 'reason' => "Óbito"]);
        }

        return fractal()->item($followup, new FollowupTransformer());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function recursiveCollect(array $array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = $this->recursiveCollect($value);
            }
        }

        return collect($array);
    }

    function removeAcentos($string, $slug = false)
    {
          $string = strtolower($string);
          // Código ASCII das vogais
          $ascii['a'] = range(224, 230);
          $ascii['e'] = range(232, 235);
          $ascii['i'] = range(236, 239);
          $ascii['o'] = array_merge(range(242, 246), array(240, 248));
          $ascii['u'] = range(249, 252);
          // Código ASCII dos outros caracteres
          $ascii['b'] = array(223);
          $ascii['c'] = array(231);
          $ascii['d'] = array(208);
          $ascii['n'] = array(241);
          $ascii['y'] = array(253, 255);
        foreach ($ascii as $key => $item) {
            $acentos = '';
            foreach ($item as $codigo) {
                $acentos .= chr($codigo);
            }
            $troca[$key] = '/['.$acentos.']/i';
        }
          $string = preg_replace(array_values($troca), array_keys($troca), $string);
          // Slug?
        if ($slug) {
            // Troca tudo que não for letra ou número por um caractere ($slug)
            $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
            // Tira os caracteres ($slug) repetidos
            $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
            $string = trim($string, $slug);
        }
          return $string;
    }

    protected function quebraString($label, $value)
    {
        $user = explode($label, $value);
        // print_r($user);
        if (count($user) == 2) {
            return $user[1];
        } else {
            return false;
        }
    }

    protected function Exists($label, $v)
    {
        $value = $this->quebraString($label, $v);
        if ($value==false && !empty($v)) {
            # code...
            $newString = $this->removeAcentos($v, '-');
            $querySearch = $label.''.$newString;
            // echo $querySearch;
            // die;
            $opt = Option::where('value', $querySearch)->count();
            if ($opt == 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }    
    }

    protected function createOption($followupEspeciality, $prefix, $group ){
        foreach ($followupEspeciality as $value) {
            if ($this->Exists($prefix, $value)) {
                Option::create([
                    'group' => $group,
                    'label' => $value,
                ]);
            }
        }
    }

    protected function createNewOptions($data, $patient)
    {

        $this->createOption($data->ambulatory_care['follow30']['fuespecialities'], 'first-event-med-details-' , 'first_event.med_details' );
        $this->createOption($data->ambulatory_care['follow30']['especialities'], 'first-event-rehab-details-', 'first_event.rehab_details');
        
        $this->createOption($data->ambulatory_care['follow3m']['fuespecialities'], 'first-event-med-details-' , 'first_event.med_details' );
        $this->createOption($data->ambulatory_care['follow3m']['especialities'], 'first-event-rehab-details-', 'first_event.rehab_details');
        
        $this->createOption($data->ambulatory_care['follow1a']['fuespecialities'], 'first-event-med-details-' , 'first_event.med_details' );
        $this->createOption($data->ambulatory_care['follow1a']['especialities'], 'first-event-rehab-details-', 'first_event.rehab_details');

        $this->createOption($data->ambulatory_care['follow2a']['fuespecialities'], 'first-event-med-details-' , 'first_event.med_details' );
        $this->createOption($data->ambulatory_care['follow2a']['especialities'], 'first-event-rehab-details-', 'first_event.rehab_details');

        $this->createOption($data->ambulatory_care['follow3a']['fuespecialities'], 'first-event-med-details-' , 'first_event.med_details' );
        $this->createOption($data->ambulatory_care['follow3a']['especialities'], 'first-event-rehab-details-', 'first_event.rehab_details');

        $this->createOption($data->ambulatory_care['follow4a']['fuespecialities'], 'first-event-med-details-' , 'first_event.med_details' );
        $this->createOption($data->ambulatory_care['follow4a']['especialities'], 'first-event-rehab-details-', 'first_event.rehab_details');

        $this->createOption($data->ambulatory_care['follow5a']['fuespecialities'], 'first-event-med-details-' , 'first_event.med_details' );
        $this->createOption($data->ambulatory_care['follow5a']['especialities'], 'first-event-rehab-details-', 'first_event.rehab_details');  
       
        $this->createOption( $data->risk_factors['dyslipidemia']['medicines_items'], 'risk-factors-dyslipidemia-medicines-items-', 'risk_factors.dyslipidemia_medicines_items');

        $this->createOption( $data->discharge['avc_itoast']['type'], 'discharge-avc-itoast-', 'discharge.avc_itoast');
       
        $this->createOption( $patient->telefone, 'patient-info-telefone-', 'patient_info.telefone');

        if ($this->Exists('demographic-profession-',$data->demographic['profession']['current'])) {
            Option::create([
                'group' => 'demographic.profession',
                'label' => $data->demographic['profession']['current'],
            ]);
        }

        if ($this->Exists('demographic-profession-',$data->demographic['profession']['father'])) {
            Option::create([
                'group' => 'demographic.profession',
                'label' => $data->demographic['profession']['father'],
            ]);
        }

        if ($this->Exists('demographic-healthcare-attendance-',$data->demographic['health']['healthcare_attendance'])) {
            Option::create([
                'group' => 'demographic.healthcare_attendance',
                'label' => $data->demographic['health']['healthcare_attendance'],
            ]);
        }

        if ($this->Exists('hospitals-',$data->first_event['hospital'])) {
            Option::create([
                'group' => 'hospitals',
                'label' => $data->first_event['hospital'],
            ]);
        }

        if ($this->Exists('first-event-hospital-especialities-',$data->first_event['hospital_especialities'])) {
            Option::create([
                'group' => 'first_event.hospital_especialities',
                'label' => $data->first_event['hospital_especialities'],
            ]);
        }
        
        $flag = 0;

        if ($this->Exists('patient-origin-immediate-origin-',$data->patient_origin['immediate_origin'])) {
            Option::create([
                'group' => 'patient_origin.immediate_origin',
                'label' => $data->patient_origin['immediate_origin'],
            ]);
        }

        if ($this->Exists('discharge-avc-ait-', $data->discharge['avc_ait']['value'])) {
            Option::create([
                'group' => 'discharge.avc_ait',
                'label' => $data->discharge['avc_ait']['value'],
            ]);
        }

          if ($this->Exists('death-cause-', $data->death['cause'])) {
            Option::create([
                'group' => 'death.cause',
                'label' => $data->death['cause'],
            ]);
        }

        if ($this->Exists('risk-factors-dyslipidemia-medicines-items',$data->risk_factors['dyslipidemia']['medicines_items']) && count($data->risk_factors['dyslipidemia']['medicines_items'])) {
            foreach ($data->risk_factors['dyslipidemia']['medicines_items'] as $item) {
                Option::create([
                    'group' => 'risk_factors.dyslipidemia_medicines_items',
                    'label' => $item,
                ]);
            }
        }
    }

    protected function createRelations(Followup $followup,  $data)
    {
        $fields = collect(self::RELATION_FIELDS);
        
        $fields->each(function ($field) use ($followup, $data) {
            $relation = camel_case($field);
            try{
                if($followup->$relation == null) {
                    # code...
                    $relation = array_key_exists($field, self::UPDATING_FIELDS) ? self::UPDATING_FIELDS[$field]: 'App\\'.ucfirst($relation);
                    //$relation = 'App\\'.ucfirst($relation);
                    $model = new $relation;
                    $model->fill($data->$field ?? []);
                    $model->followup_id = $followup['id'];
                    $model->save();
                }
                else {
                    # code...
                    $followup->$relation()->create($data->$field ?? []);
                }
            }catch(\Exception $e){
                var_dump($e->getMessage());
            }
        });
    }

    // protected function updateRelations(Followup $followup, $data)
    // {
    //     $fields = collect(self::RELATION_FIELDS);

    //     $fields->each(function ($field) use ($followup, $data) {
    //         $relation = camel_case($field);
    //         try{
    //             $followup->$relation->fill($data->$field ?? []);
    //             $followup->$relation->save();
    //         }catch(\Exception $e){
    //             var_dump($e->getMessage());
    //         }
    //     });
    // }

    protected function updateRelations(Followup $followup, $data)
    {
        $fields = collect(self::RELATION_FIELDS);

        $fields->each(function ($field) use ($followup, $data) {
            $relation = camel_case($field);
            try{
                if($followup->$relation == null) {
                    # code...
                    $relation = array_key_exists($field, self::UPDATING_FIELDS) ? self::UPDATING_FIELDS[$field]: 'App\\'.ucfirst($relation);
                    //$relation =  'App\\'.ucfirst($relation);
                    $model = new $relation;
                    $model->fill($data->$field ?? []);
                    $model->followup_id = $followup['id'];
                    $model->save();
                }
                else {
                    # code...
                    $followup->$relation->fill($data->$field ?? []);
                    $followup->$relation->save();
                }
            }catch(\Exception $e){
                var_dump($e->getMessage());
            }
        });
    }

    
}
