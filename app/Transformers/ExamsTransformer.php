<?php

namespace App\Transformers;

use App\Exams;
use League\Fractal\TransformerAbstract;

class ExamsTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Exams $e)
    {
        return [
            'banford'          => $e->banford ?? [],
            'nih'              => $e->nih,
            'previous_rankin'  => $e->previous_rankin,
            'admission_rankin' => $e->admission_rankin,
            'barthel'          => $e->barthel,
            'list'             => $e->list,

            'fasting_blood_glicose' => $e->fasting_blood_glicose,
            'triglycerides'         => $e->triglycerides,
            'total_cholesterol'     => $e->total_cholesterol,
            'hdl'                   => $e->hdl,
            'ldl'                   => $e->ldl,
            'uric_acid'             => $e->uric_acid,
            'creatinine'            => $e->creatinine,
            'ecg'                   => $e->ecg,
            'ecg_description'       => $e->ecg_description,
            'actilyise'             => $e->actilyise,
            'vhs'                   => $e->vhs,
            'admission_pa'          => $e->admission_pa ?? [],
            'tomography_datetime'   => $e->tomography_datetime ? format_date($e->tomography_datetime, 'd/m/Y - H:i') : null,
            'actilyise_date'        => $e->actilyise_date ? format_date($e->actilyise_date, 'd/m/Y - H:i') : null,
            'holter24'              => $e->holter24 ? format_date($e->holter24, 'd/m/Y') : null,
            'holter3'               => $e->holter3 ? format_date($e->holter3, 'd/m/Y') : null,
            'holter7'               => $e->holter7 ? format_date($e->holter7, 'd/m/Y') : null,
            'note_telemetry_holter'                 => $e->note_telemetry_holter,
            'echocardiogram_transthoracic'          => $e->echocardiogram_transthoracic ? format_date($e->echocardiogram_transthoracic, 'd/m/Y') : null,
            'echocardiogram_transesophageal'        =>$e->echocardiogram_transesophageal ? format_date($e->echocardiogram_transesophageal, 'd/m/Y') : null,
            'echocardiogram_note'   => $e->echocardiogram_note,
            'doppler_data_vertebral'=> $e->doppler_data_vertebral ? format_date($e->doppler_data_vertebral, 'd/m/Y') : null,
            'doppler_vertebral_note' => $e->doppler_vertebral_note,
            'doppler_data_transcranial' => $e->doppler_data_transcranial ? format_date($e->doppler_data_transcranial, 'd/m/Y') : null,
            'doppler_transcranial_note' => $e->doppler_transcranial_note,
            'cardiac_area'          => $e->cardiac_area,
        ];
    }
}
