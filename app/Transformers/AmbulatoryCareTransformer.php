<?php

namespace App\Transformers;

//use App\Exams;
use Route;

use App\AmbulatoryCare;
use League\Fractal\TransformerAbstract;

class AmbulatoryCareTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(AmbulatoryCare $esc)
    {
        $time = $esc->time ?? ['value' => '30dias'];

        return [

        'time' => $time,
         'follow30' => $this->getFollow($esc->follow30),
         'follow3m' => $this->getFollow($esc->follow3m),
         'follow1a' => $this->getFollow($esc->follow1a),
         'follow2a' => $this->getFollow($esc->follow2a),
         'follow3a' => $this->getFollow($esc->follow3a),
         'follow4a' => $this->getFollow($esc->follow4a),
         'follow5a' => $this->getFollow($esc->follow5a),
         'dead_in'  => $esc->dead_in

        ];
    }

    // getFollow
    public function getFollow($follow): array
    {   
                                    
        if($follow != null){
            for($x=0; $x < count($follow->especialities); $x++){            
               $follow->especialities[$x] = $this->VerificaOptionEspecialities($follow, $follow->especialities[$x]);
            }
            for($x=0; $x < count($follow->fuespecialities); $x++){            
                $follow->fuespecialities[$x] = $this->VerificaOptionFuespecialities($follow, $follow->fuespecialities[$x]);
             }
        }
        //dd($ac->follow30);// está buscando
         return collect([
          'avc_monitoring' =>  [], // Somente no posto, Somente na consultoria, Ambos
          'avc_monitoring_answer' =>  null, // Somente no posto, Somente na consultoria, Ambos
          'health_center' =>  null, // posto ou consultorio
          'frequency_health_center'  =>  null,// aquelas do BD, nao vou, uma vez por semana, 1 x por mes, 1 x a cada 6 meses, 3 x 3 meses, 1 x ano, outros ...
          'blood_pressure'  =>  [], // 120x80 - nao entrando com nada, nao sabe nao verificou (aquela habilitação que tem em exames)
          'glycemic_Hemoglobin_value'  =>  null, //um numero qualquer
          'glycemic_Hemoglobin_answer'  =>  null,// sim, nao, bom, alto, nao sabe.
          'ldl_value'  =>  null, // numero qualquer
          'ldl_answer'  =>  null, // sim, nao, bom, alto, nao sabe
          'blood_pressure_answer' => null, //resposta da pressão
          'smoking'  =>  null, // sim, nao, ex-fumante, nunca fumou (escolhe uma opcao)
          'follow_rankin30'  =>  null, //rankin, um valor de 0 a 6
            'rankin_options'  =>  [
                'rankin_sequel'           =>  false,
                'rankin_leave_activities' =>  false,
                'rankin_need_help'        =>  false,
                'rankin_need_help_walk'   =>  false,
                'rankin_bedridden'        =>  false,
                'rankin_dead'             =>  false,
            ],
          'capilar_value'  =>  null, // um numero qualquer
          'capillar_answer'  =>  null, // sim, nao, bom, alto, nao sabe
          'physiotherapy' => null, // sim, não
          'note' => null, //Observacoes
          'postname' => null, //Nome do posto
          'especialities' => [], //Especialidades
          'fuespecialities' => [], //Followup especialidades
          'nbperiods' => null, //Numero de periodos 
          'presencacrises' => null, //Sim, não
          'antiepiletic' => null, //Sim, não
          ])->merge($follow)->toArray();
    }

    public function VerificaOptionEspecialities( $follow, $option)
    {
        if (strpos($option, 'first-event-rehab-details-') !== false || is_null($option)) {
            return $option;
        } else {
            $c = \App\Option::where([
                ['value', 'like', '%first-event-rehab-details-%'],
                ['label', '=', $option]
            ])->get();
            return $c[0]->value;
        }
    }

    public function VerificaOptionFuespecialities( $follow, $option)
    {
        if (strpos($option, 'first-event-med-details-') !== false || is_null($option)) {
            return $option;
        } else {
            $c = \App\Option::where([
                ['value', 'like', '%first-event-med-details-%'],
                ['label', '=', $option]
            ])->get();
            if (!isset($c[0]->value)) {
                return null;
            }else{
                return $c[0]->value;
            }
        }
    }
    // public function getFollow30(AmbulatoryCare $ac) { $this->getFollow($ac->follow30); }
    // public function getFollow6m(AmbulatoryCare $ac) { $this->getFollow($ac->follow6m); }
    // public function getFollow1a(AmbulatoryCare $ac) { $this->getFollow($ac->follow1a); }
    // public function getFollow2a(AmbulatoryCare $ac) { $this->getFollow($ac->follow2a); }
    // public function getFollow3a(AmbulatoryCare $ac) { $this->getFollow($ac->follow3a); }
    // public function getFollow4a(AmbulatoryCare $ac) { $this->getFollow($ac->follow4a); }
    // public function getFollow5a(AmbulatoryCare $ac) { $this->getFollow($ac->follow5a); }
}
