<?php

namespace App\Transformers;

use App\FormAlta;
use League\Fractal\TransformerAbstract;

class FormAltaTransformer extends TransformerAbstract
{
	public function transform(FormAlta $fa) 
	{	
		return [
			'medhas' => $fa->medhas ?? [],
			'meddm' => $fa->meddm ?? [],
			'meddis' => $fa->meddis ?? [],
			'medanti' => $fa->medanti ?? [],
			'medantico' => $fa->medantico ?? [],
			'enca' => $fa->enca ?? [],
			'encseg' => $fa->encseg ?? [],
			'medepilepsia' => $fa->medepilepsia ?? [], 
		];
	}
}

