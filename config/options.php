<?php

return [
    'hospitals' => ['C.H.U', 'H.D.H', 'H.R.H.D.S', 'H.M.S.J', 'Bethesda', 'Busca ativa', 'Infantil', 'Outro Município', 'Ambulatorial', 'Não Internou'],

    'first_event' => [
        'previous'         => ['AVC', 'AIT', 'Não', 'Desconhece'],
        'number_of_events' => ['1 vez', '2 vezes', 'Mais que duas vezes'],
        'rehab'            => ['Não', 'regular >= 3 meses', 'irregular <= 3 meses'],
        'rehab_details'    => ['Fisioterapia Respiratória', 'Fisioterapia Motora', 'Terapia Ocupacional', 'Psicologia', 'Fonoaudióloga'],
        'med_details'      => ['Clinico Geral', 'Cardiologista', 'Neurologista', 'Geriatra'],
        'hospital_especialities' => ['Clínico geral', 'Cardiologista', 'Neurologista', 'Geriatra']

    ],

    'exams' => [
        'banford'          => ['LACS', 'PACS', 'TACS', 'POCS', 'Não se aplica'],
        'previous_rankin'  => ['0 - No symptoms at all ', 
                               '1 - No significant disability despite symptoms; able to carry out all usual duties and activities',
                               '2 - Slight disability; unable to carry out all previous activities, but able to look after own affairs without assistance',
                               '3 - Moderate disability; requiring some help, but able to walk without assistance',
                               '4 - Moderately severe disability; unable to walk without assistance and unable to attend to own bodily needs without assistance',
                               '5 - Severe disability; bedridden, incontinent and requiring constant nursing care and attention',
                               '6 - Dead'
                            ],
        'admission_rankin' => [0, 1, 2, 3, 4, 5, 6],
        'exams_list'       => [
            'Tomografia',
            'USG Carótidas',
            'Ecocardiograma',
            'RNM Crânio',
            'Holter',
            'Angio RNM',
            'Angio TC',
            'Angiografia',
            'Dopler Transcraniano',
        ],
        'ecg'              => ['FA', 'Sinusal', 'Outros'],
        'actilyise'        => ['Mecânica', 'Química', 'Química + Mecânica', 'Não se aplica'],
        'cardiac_area'     => ['Normal', 'Limítrofe', 'Aumentada']
    ],

    'demographic' => [
        'city_time' => ['< 6 meses', '1 ano', '2 anos', '3 anos', '4 anos', '5 anos', '> 5 anos'],

        'race' => [
            'Branco (caucasiano)',
            'Oriental (amarelo)',
            'Indígena',
            'Negro',
            'Mulato (pardo)',
        ],

        'nbperiods' => ['Nenhuma', '1', '2 a 5', '>5'],

        'schooling'             => [
            'Analfabeto/Até 3ª Série Fundamental',
            '4ª Série Fundamental',
            'Fundamental Completo',
            'Médio Completo',
            'Superior Completo',
            'Desconhecido',
        ],
        'profession'            => ['Desconhecido'],
        'child_health'          => ['Excelente', 'Boa', 'Regular', 'Ruim', 'Desconhece'],
        'healthcare_attendance' => ['Não vou', '1x por semana', '1x por mês', '1x a cada 6 meses', '3 em 3 meses', '1x ao ano', '3x por ano'],
    ],

    'patient_origin' => [
        'ecocarotidas_doctor' => ['Dr. Ademar', 'Dra. Fernanda', 'Dr. Garcia'],
        'immediate_origin'    => ['Casa', 'Ambulatório público', 'Ambulatório privado', 'PA 24hs'],
    ],

    'patient_info' => [
        'treatment_type' => ['Ambulatório', 'Internado'],
        'patient_gender' => ['Masculino', 'Feminino'],
        'telefone' => ['Paciente', 'Acompanhante'],
        'disable_reason' => ['Mudou de cidade', 'Sem contato'],
        'disable_reason_new_event' => ['Novo evento'],
        'disable_reason_death' => ['Óbito']
    ],

    'current_event' => [
        'transportation' => ['Carro próprio', 'Amigo/Táxi', 'Ônibus', 'Ambulância privada', 'Samu/Bombeiro'],
    ],

    'death' => [
        'cause' => ['AVC', 'IAM'],

        'place' => ['Intra-hospitalar', 'Extra-hospitalar'],
    ],

    'discharge' => [
        'avc_type' => ['AIT', 'AVC I TOAST', 'AVC H (Intraparenquimatoso)', 'HSA'],

        'avc_ait' => ['Provável', 'Definido'],

        'avc_itoast' => [
            'Lacunar',
            'Aterotrombótico',
            'Cardiombólico',
            'Indeterminado por investigação negativa',
            'Indeterminado por investigação incompleta',
            'Indeterminado por outras causas',
            'Indeterminado por duas causas',
        ],

        'avc_h_type' => ['Lobar', 'Não Lobar'],

        'rankin' => ['0 - No symptoms at all ', 
                    '1 - No significant disability despite symptoms; able to carry out all usual duties and activities',
                    '2 - Slight disability; unable to carry out all previous activities, but able to look after own affairs without assistance',
                    '3 - Moderate disability; requiring some help, but able to walk without assistance',
                    '4 - Moderately severe disability; unable to walk without assistance and unable to attend to own bodily needs without assistance',
                    '5 - Severe disability; bedridden, incontinent and requiring constant nursing care and attention',
                    '6 - Dead'
                ],

        'hmsj_uavc' => ['U-AVC até 72h', 'U-AVC após 72h', 'Somente PS', 'AVC agudo', 'AIT', 'UTI', 'Outros Setores'],
    ],

    'risk_factors' => [
        'medicines'                       => ['Sim - Regular', 'Sim - Irregular', 'Parou', 'Não'],
        'avc_parents'                     => ['Pai', 'Mãe', 'Ambos', 'Não', 'Desconhece'],
        'avc_family'                      => [
            'Sim',
            'Não',
            'Somente parente 1º grau de sexo masculino',
            'Somente parente 1º grau de sexo feminino',
            'Ambos',
            'Desconhece',
        ],
        'has_hypertension'                => ['Sim', 'Não', 'Desconhece'],
        'has_medicines_items'             => [
            'Inibidor de angiotensina (captopril, enalopril)',
            'Inibidor de receptor angiotensina (losartana, valsartana)',
            'Beta-bloqueador (propranolol, atenolol)',
            'Bloqueador de cálcio (anlodipina, nifedipina)',
            'Alfa-bloqueador (affametildopa)',
            'Diuréticos (hidroclorotiazida, clorotiazida, furosemida)',
        ],
        'has_conclusion'                  => [
            'Hipertensão tratada e controlada (tem HAS > de 1 mês, faz tratamento regular)',
            'HAS tratada e não controlada (tem HAS > de 1 mês, usa regular ou irregular, >140/90 na última verificação antes do AVC)',
            'HAS com controle desconhecido (tem HAS > de 1 mês, usa regular ou irregular, mas não verificou a PA antes do AVC nenhuma vez ou não se lembra)',
            'Sem HAS (Verificou e estava <= 140/90)',
            'HAS não tratada e não controlada'
        ],
        'diabetes'                        => [
            'Sim',
            'Não',
            'Desconhece',
        ],
        'diabetes_hemoglobin_hba1c'       => ['Desconhece', 'Não lembra', 'Não fez', 'Bom', 'Alto'],
        'diabetes_medicines_items'        => [
            'Hipoglicemiante oral',
            'Insulina',
            'Metformina',
        ],
        'smoking'                         => ['Sim', 'Não', 'Ex-fumante (>1 ano sem fumar - OMS)', 'Nunca fumou'],
        'alcohol_rating'                  => ['Eventual / Social', 'Alcoolismo', 'Somente no passado'],
        'dyslipidemia'                    => [
            'Controla e trata',
            'Controla mas não precisa tratar',
            'Não controla',
            'Desconhece',
        ],
        'dyslipidemia_medicines_items'    => [
            'Ovastatina',
            'Sinvastatina',
            'Artrovastatina',
            'Provastatina',
            'Osuvastatina',
            'Fibratos',
        ],
        'cardiopathy'                     => ['Sim', 'Não', 'Desconhece'],
        'cardiopathy_patologies'          => ['IAM', 'Stent', 'Angioplastia', 'Revascularização', 'Angina', 'ICC', 'FA', 'Arritmia', 'Doença Valvar', 'Cateterismo'],
        'cardiopathy_conclusion'          => [
            'FA conhecida (já tinha mais de um ECG com FA laudada e confirmamos na internação no laudo em ECG ou Holter)',
            'FA paroxística (tinha FA em pelo menos um laudo prévio mas não em outros)',
            'FA nova (FA confirmada no laudo da internação, após AVC e sustentada em mais de um ECG)',
            'FA nova e paroxística (FA confirmada no laudo da internação, após AVC mas não sustentada)',
            'Não se aplica'
        ],
        'cardiopathy_anticoagulant_items' => [
            'Marcoumar',
            'Marevan',
            'Coumadin',
            'Apixabam (eliquis)',
            'Dabigatran (pradaxa)',
            'Rivaroxabam (xarelto)'
        ],
        'antitrombotic_medicines_items'   => [
            'AAS',
            'Dipiridamol (persantim)',
            'Clopidogrel',
            'AAS + Clopidogrel',
            'AAS + Dipiridamol',
        ],
        'drugs_usage'                     => ['Sim', 'Não sabe', 'Não', 'Somente no passado'],
        'sedentary'                       => ['Inativo', 'Ativo Leve', 'Ativo Moderado', 'Ativo Intenso'],
    ],

    'socioeconomic_conditions' => [
        'schooling' => [
            'Analfabeto / Fundamental I Incompleto',
            'Fundamental I Completo / Fundamental II Incompleto',
            'Fundamental II Completo / Médio Incompleto',
            'Médio Completo / Superior Incompleto',
            'Superior Completo',
        ],
    ],

    'formalta' =>[
        'medhas'    => ['inibidor de angiotensina (captopril, enalapril)', 'inibidor de receptor angiotensina (losartana,valsartana)', 'diuréticos (hidroclorotiazida, clorotiazida, furosemida)', 'Inibidor de angiotensina (captopril, enalopril)',
        'Inibidor de receptor angiotensina (losartana, valsartana)',
        'Beta-bloqueador (propranolol, atenolol)',
        'Bloqueador de cálcio (anlodipina, nifedipina)',
        'Alfa-bloqueador (affametildopa)',
        'Diuréticos (hidroclorotiazida, clorotiazida, furosemida)'],
        'meddm'     => ['Hipoglicemiante oral (glibenclamida)', 'Metformina', 'Insulina', 'Outros'],
        'meddis'    => ['Lovastatina', 'Sinvastatina', 'Artrovastatina', 'Provastatina', 'Rosuvastatina', 'Fibratos'],
        'medanti'   => ['AAS', 'Clopidogrel'],
        'medantico' => ['Marevan', 'Apixabam (eliquis)', 'Dabigatran (pradaxa)', 'Rivaroxabam (xarelto)'],
        'enca'      => ['Fisioterapia', 'Terapia Ocupacional', 'Fonoaudiologia', 'Psicologia'],
        'encseg'    => ['Internação Domiciliar', 'Unidade Básica de Saúde', 'Ambulatório de neurologia', 'Ambulatório de neurocirurgia'],
        'medepilepsia' => ['Carbamazepina', 'Fenitoina', 'Fenobarbital', 'Lamotrigina', 'Benzodiazepinico', 'Oxcarbamazepina', 'Levetiracetam', 'Topiramato', 'Lacosamida', 'Gabapentina']
    ],

    'imageform' =>[
        'topolobar'         => ['Frontal', 'Parietal', 'Temporal', 'Occipital', 'Cerebelo'],
        'topoprofunda'      => ['Gânglios basais', 'Tálamo', 'Tronco Cerebral'],
        'volhematoma'       => ['<=30 MI', '>30 MI'],
        'fisher'            => [1, 2, 3, 4],
        'angiotomografia'   => ['Mal formação arteriovenosa', 'Vasoespasmo/vasoconstrição', 'Trombosa Venosa'],
        'aneurisma'         => ['ACI', 'AcomA', 'AcomP', 'ACA', 'ACM', 'ACP', 'Basilar', 'ACPI', 'ACAI', 'ACS'],
        'fa_aspects'        => ['>5', '<=5'],
        'fa_lado'           => ['Direito', 'Esquerdo', 'Bilateral', 'Múltiplos (territórios vasculares diferentes)', 'Múltiplos (Diferentes tempos de evolução em mesmo território)'],
        'fa_topografia'     => ['Frontal', 'Parietal', 'Temporal', 'Occipital', 'Tronco Cerebral', 'Cerebelo', 'Gânglios Basais', 'Tálamo', 'Watershad Profundo', 'Lacuna (<20 mm)'],
        'tvc_op'            => ['Artéria Hiperdensa', 'Microangiopatia', 'Outras lesões isquemicas', 'Transformação Hemorrágica'],
        'fa_tumefativo'     => ['Não', 'Leve', 'Moderado', 'Grave'],
        'opga'              => ['ACP', 'Não', 'ACI', 'ACM M1', 'ACM M2', 'Basilar', 'ACA'],
        'rnm_acdlado'       => ['Direito', 'Esquerdo'],
        'rnm_acdloc'        => ['Outro segmento cervical', 'Bifurcação e Origem'],
        'rnm_acdgrau'       => ['>70%', '50% a 70%', '<50%', 'Sublocusão'],
        'rnm_selec'         => ['Tomografia', 'RNM'],
        'efeitotumofativo'  => ['Não', 'Leve', 'Moderado', 'Grave'],
        'thop'              => ['HI 1', 'HI 2', 'PH 1', 'PH 2', 'Inundação ventricular', 'Hidrocefalia'],
        'css1'              => ['A imagem cerebral não foi realizada (TC ou MRI)', 
                                'A imagem cerebral é negativa quanto à presença de infarto cerebral agudo ou déficit de perfusão consistente com sintomas clínicos.', 
                                'Existe um infarto lacunar agudo no território das artérias penetrantes no tronco cerebral, núcleos da base ou cápsula interna , ≤20 mm em seu maior diâmetro e não há patologia focal conhecida em grande vaso desse região (ACM, ACA, ACI, AB)', 
                                'Watershed unilateral agudo',
                                'Existem múltiplos infartos temporalmente separados exclusivamente no território da artéria clinicamente relevante.',
                                'Existem múltiplas lesões isquêmicas agudas e subagudas nas circulações anterior ou anterior e posterior ou ambas, na ausência de oclusão não embólica ou estenose /oclusão de grandes vasos.'
                            ],
        'css2'              => ['A avaliação da imagem dos vasos sanguíneos não foi realizada',
                                'Existe doença vascular estenótica ou oclusiva secundária a aterosclerose em artérias clinicamente relevantes',
                                'A placa aterosclerótica descrita em 3b possui características consistentes com a formação de trombo, ulceração, estenose ou oclusão não crônica',
                                'Existe uma placa aterosclerótica que causa estenose leve na ausência de qualquer ulceração ou trombose detectável na placa em artéria extracraniana ou intracraniana clinicamente relevante. Há também um histórico prévio de dois ou mais acidentes vasculares isquêmicos, ataque isquêmico transitório ou cegueira monocular transitória do território da artéria, com pelo menos um evento no último mês',
                                'Há evidência angiográfica de trombo em artéria intracraniana sem outras anormalidades angiográficas',
                                'Evidência de recanalização completa de artéria previamente ocluída clinicamente relevante.'
                            ],
        'css3'              => ['Dissecção arterial aguda em artérias relevantes',
                                'Anormalidades vasculares na artéria relevante',
                                'Vasculite cerebral',
                                'Trombose venosa cerebral',
                                'Coagulação intravascular disseminada aguda',
                                'AVC induzido por drogas',
                                'Displasia fibromuscular',
                                'Trombocitopenia induzida por heparina',
                                'CADASIL',
                                'Síndromes de hiperviscosidade',
                                'Síndromes de hipoperfusão',
                                'Causas iatrogênicas',
                                'Aneurisma cerebral parcialmente trombosado em artéria clinicamente relevante',
                                'MELAS',
                                'Meningite',
                                'AVC induzido por enxaqueca',
                                'Doença de Moyamoya',
                                'SAF primária',
                                'Vasculite infecciosa',
                                'Doença falciforme',
                                'Síndrome de Sneddon',
                                'Purpura trombocitopênica trombótica - Síndrome urêmica hemolítica',
                                'Vasoconstricção segmentar ou vasoespasmo',
                                'Anormalidades de trombose e hemostasia',
                            ' Outras causas',
                            ]
    ],

    'ccs' => [
        'options'          => ['Evidente', 'Provável', 'Possível'],
        'undefined_causes' => [
            'Embolia Criptogenica Desconhecida',
            'Por Outra Causa Desconhecida',
            'Investigação Incompleta',
            'Não Classificado',
        ],
    ],
    
    'ambulatory_cares' => [
        'avc_monitoring' => ['Posto', 'Consultorio', 'Ambulatorio'],
        'health_center_awnser' => ['Sim', 'Não'],
    ],
    
    'epivasc' => [
        'history'  => ['História familiar de epilepsia (parente de primeiro grau)', 'História mórbida pregressa de epilepsia ativa (crise nos últimos 10 anos ou uso de DAE)'],
        'seizures' => ['Crise nas primeiras 24h', 'Crise < 7 dias',' Crise > 7 dias', 'Estado de Mal convulsivo', 'Estado de Mal não convulsivo', 'Recorrência de crise']
    ],
    
    'biobase' => [
        'relationship' => ['Parente 1 grau', 'Parente 2 grau', 'Parente 3 grau',  'Cônjuge',  'Nenhum'],
        'who' => ['Pai', 'Mãe', 'Pai e mãe', "Outro Parente"],
        'yesno' => ['Sim', 'Não', 'Desconhece'],
    ]
];

