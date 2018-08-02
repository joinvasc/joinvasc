<?php

namespace App\Export;

require '../vendor/autoload.php';

use App\Option;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportCenter
{
    const FIELDS = [
        'Ultimo Evento AVC', 
        'Evento AVC Atual', 
        'Exames', 
        'Demográfico', 
        'Origem do Paciente', 
        'Condições Socioeconômicas', 
        'Fatores de Risco', 
        'Alta', 
        'Biobase', 
        'Formulario de Alta', 
        'EpiVasc',
        'Formulario de Imagens',
        'Followup 30 Dias',
        'Followup 6 meses',
        'Followup 1 ano',
        'Followup 2 ano',
        'Followup 3 ano',
        'Followup 4 ano',
        'Followup 5 ano',
        'Óbito'
    ];

    public static function CreateExcelFile($followupData, $exportProfile)
    {
        $identificacao_final =  ['index'=>[
            'Nome', 
            'Data de nascimento',
            'Data da entrevista',
            'Data de admissão',
            'Horário da admissão',
            'CPF',
            'Hospital',
            'Gênero',
            'Questionário respondido por:'
        ]];
        
        $ultimo_avc_final = ['index'=>[
            'O Sr(a) já teve episódio de AVC ou ameaça de AVC(AIT) na vida?',
            'Quantos?',
            'Quando ocorreu o último AVC?',
            'O Sr.(a) fez reabilitação após a alta?',
            'Qual tipo de reabilitação?',
            'Qual hospital o Sr.(a) ficou internado(a)?',
            'Se internado no HMSJ, o Sr(a) ficou internado(a) na U-AVC?'
        ],];

        $evento_atual_final= ['index'=>[
            'No AVC atual quando iniciaram os sintomas (Data)?',
            'No AVC atual quando iniciaram os sintomas (Hora)?',
            'Em que data e hora o(a) Sr(a) pediu ajuda? (Data)',
            'Em que data e hora o(a) Sr(a) pediu ajuda? (Hora)',
            'Em que data e hora o(a) Sr(a) chegou na porta do hospital? (Data)',
            'Em que data e hora o(a) Sr(a) chegou na porta do hospital? (Hora)',
            'Qual transporte o(a) Sr(a) utilizou para vir ao hospital?',
            'Observações'
        ],];

        $exames_final = ['index'=>[
            'Escala de diagnóstico de Banford',
            'NIH (0-42)',
            'Ranking prévio',
            'Ranking na admissão',
            'Barthel até 48hs',
            'Tomografia',
            'USG Carótidas',
            'Ecocardiograma',
            'RNM Crânio',
            'Holter',
            'Angio RNM',
            'Angio TC',
            'Angiografia',
            'Dopler Transcraniano',
            'Glicemia de Jejum',
            'Triglicerídios',
            'Colesterol Total',
            'HDL',
            'LDL',
            'Ácido Úrico',
            'Creatinina',
            'VHS',
            'ECG',
            'Trombolítico (Actilyise)',
            'Trombolítico (Data)',
            'Trombolítico (Horário)',
            'Nível de PA na Admissão',
            'Tomografia (Data)',
            'Tomografia (Horário)',
            'Holter 24 horas',
            'Holter 3 dias',
            'Holter 7 dias',
            'Observações - Holter prolongado com telemetria',
            'Ecocardiograma transtorácico',
            'Ecocardiograma transesofágico',
            'Observações - Ecocardiograma',
            'Data - Doppler de carótidas e vertebrais',
            'Observação - Doppler de carótidas e vertebrais',
            'Data - Doppler Transcraniano',
            'Observações - Doppler Transcraniano',
            //'RX de tórax',
            'Área cadíaca'
        ],];

        $demografico_final = ['index'=>[
            'O Sr(a) mora em Joiville?',
            'Há quanto tempo o Sr(a) mora nessa cidade? (Anos)',
            'CEP',
            'Endereço',
            'Número',
            'Bairro',
            'Ponto de referência',
            'Tel. Residencial',
            'Tel. Celular',
            'Tel. Trabalho',
            'Contato Trabalho',
            'Observações',
            'Idade',
            'Raça',
            'Peso',
            'Altura',
            'IMC',
            'Escolaridade',
            'Escolaridade da Mãe',
            'Escolaridade do Pai',
            'Profissão atual',
            'Profissão do pai',
            'Quando o(a) sr(a) era criança,
            do nascimento até aos 16 anos,
            sua saúde era?',
            'Com que frequência o(a) Sr(a) vai ao posto de saúde?'
        ],];

        $origem_paciente_final = ['index'=>[
            'Origem imediata do paciente'
        ],];

        $condicoes_socio_final = ['index'=>[
            'Banheiros',
            'Empregados Domésticos',
            'Carros',
            'Motocicletas',
            'Computadores',
            'Lava-louças',
            'Geladeiras',
            'Freezers',
            'Lava-roupas',
            'DVDs',
            'Microondas',
            'Secadoras de Roupas',
            'Água encanada',
            'Rua pavimentada'
        ],];

        $fatores_risco_final = ['index'=>[
            'Seu pai ou sua mãe já tiveram AVC?',
            'Algum outro parente de primeiro grau teve avc? (tio,
            irmão ou filho?)',
            'O(a) Sr(a) tem ou já teve hipertensão?',
            'Há quanto tempo? (Anos)',
            'O(a) Sr(a) faz tratamento com medicamentos?',
            'Quais medicamentos?',
            'Participa do grupo de hipertensão/agente de saúde visita o Sr(a)?',
            'A última vez que o(a) Sr(a) verificou a P.A estava em quanto?',
            'Classificação - P.A',
            'Conclusão',
            'O(a) Sr(a) tem diabetes?',
            'Há quanto tempo? (Anos)',
            'O(a) Sr(a) faz tratamento com medicamentos?',
            'Quais medicamentos?',
            'Participa do grupo de diabetes?',
            'A última vez que o(a) Sr(a) verificou a Hemoglobina Glicada estava em quanto?',
            'Nível de admissão HBA1C',
            'Já fumou em média 1 cigarro (charuto/cachimbo),
            diariamente pelo menos por 1 ano?',
            'O(a) Sr(a) esteve casado(a) ou vivendo junto com um(a) fumante?',
            '(a) Sr(a) já bebeu bebidas de álcool pelo menos uma vez por semana?',
            'Número de doses',
            'Classificação - Alcoolismo',
            'O(a) Sr(a) faz controle de colesterol e triglicerídios?',
            'O Sr(a) faz tratamento com medicamentos?',
            'Quais medicamentos?',
            'Há quanto tempo? (Anos)',
            'O(a) Sr(a) tem algum problema cardíaco?',
            'Quais problemas cardíacos?',
            'Patologia',
            'Conclusão',
            'O(a) Sr(a) faz uso de anticoagulante?',
            'Quais medicamentos?',
            'O(a) Sr(a) faz tratamento com medicamentos para previnir derrame?',
            'Quais medicamentos?',
            'Insuficiência vascular periférica? (Para de caminhar por dor nas pernas,
            que melhora com o repouso - não é fraqueza).',
            'Já fez revascularização arterial com o médico vascular das pernas? (não é varizes).',
            'O(a) Sr(a) já fez uso de drogas?',
            'Quais?',
            'Há quanto tempo faz uso? (Anos)',
            'Há quanto tempo parou de usar? (Anos)',
            'O(a) Sr(a) realiza atividade física?'
        ],];

        $alta_final = ['index'=>[
            'Data da alta',
            'Classificação de AVC',
            'AIT',
            'AVC I TOAST',
            'AVC H - Tipo',
            'AVC H - Operado',
            'AVC HSA - Operado',
            'Rankin',
            'Barthel',
            'Para o paciente internado no HMSJ: Foi para o U-AVC em'
        ],];

        $biobase_final = ['index'=>[
            'Data da Coleta',
            'Data da Extrassão do DNA',
            'Data de Armazenamento',
            'Quantificação DNA',
            'Localização no Freezer',
            'Observações',
            'C1 - Nome',
            'C1 - Data de Nascimento',
            'C1 - Gênero',
            'C1 - Grau de Parentesco com o Paciente',
            'C1 - Raça',
            'C1 - CEP',
            'C1 - Endereço',
            'C1 - Número',
            'C1 - Bairro',
            'C1 - Ponto de referência',
            'C1 - Parente com AVC',
            'C1 - Quem?',
            'C1 - Hipertensão',
            'C1 - Diabetes Mellitus',
            'C1 - Dislipidemia',
            'C1 - Tabagismo',
            'C1 - Cardiopatia',
            'C1 - Qual',
            'C2 - Nome',
            'C2 - Data de Nascimento',
            'C2 - Gênero',
            'C2 - Grau de Parentesco com o Paciente',
            'C2 - Raça',
            'C2 - CEP',
            'C2 - Endereço',
            'C2 - Número',
            'C2 - Bairro',
            'C2 - Ponto de referência',
            'C2 - Parente com AVC',
            'C2 - Quem?',
            'C2 - Hipertensão',
            'C2 - Diabetes Mellitus',
            'C2 - Dislipidemia',
            'C2 - Tabagismo',
            'C2 - Cardiopatia',
            'C2 - Qual',
            'C3 - Nome',
            'C3 - Data de Nascimento',
            'C3 - Gênero',
            'C3 - Grau de Parentesco com o Paciente',
            'C3 - Raça',
            'C3 - CEP',
            'C3 - Endereço',
            'C3 - Número',
            'C3 - Bairro',
            'C3 - Ponto de referência',
            'C3 - Parente com AVC',
            'C3 - Quem?',
            'C3 - Hipertensão',
            'C3 - Diabetes Mellitus',
            'C3 - Dislipidemia',
            'C3 - Tabagismo',
            'C3 - Cardiopatia',
            'C3 - Qual',
            'C4 - Nome',
            'C4 - Data de Nascimento',
            'C4 - Gênero',
            'C4 - Grau de Parentesco com o Paciente',
            'C4 - Raça',
            'C4 - CEP',
            'C4 - Endereço',
            'C4 - Número',
            'C4 - Bairro',
            'C4 - Ponto de referência',
            'C4 - Parente com AVC',
            'C4 - Quem?',
            'C4 - Hipertensão',
            'C4 - Diabetes Mellitus',
            'C4 - Dislipidemia',
            'C4 - Tabagismo',
            'C4 - Cardiopatia',
            'C4 - Qual',
            'C5 - Nome',
            'C5 - Data de Nascimento',
            'C5 - Gênero',
            'C5 - Grau de Parentesco com o Paciente',
            'C5 - Raça',
            'C5 - CEP',
            'C5 - Endereço',
            'C5 - Número',
            'C5 - Bairro',
            'C5 - Ponto de referência',
            'C5 - Parente com AVC',
            'C5 - Quem?',
            'C5 - Hipertensão',
            'C5 - Diabetes Mellitus',
            'C5 - Dislipidemia',
            'C5 - Tabagismo',
            'C5 - Cardiopatia',
            'C5 - Qual',

         ],];

        $imageform_final = ['index'=>[
            'AVC-H', 
            'AVC Intraparenquimatoso', 
            'Hemorragia Subaracnóide', 
            'Topografia Lobar', 
            'Topografia Profunda', 
            'Volume Hematoma', 
            'Inundação Ventricular', 
            'Fisher', 
            'Hidrocefalia', 
            'Angio Tomografia', 
            'Aneurisma - Angio Tomografia', 
            'Angio RNM', 
            'Aneurisma - Angio RNM', 
            'DSA', 
            'Aneurisma - DSA', 
            'AVC-I', 
            'TC', 
            'RNM', 
            'ASPECTS', 
            'Lado', 
            'Topografia', 
            'Território vascular completo ou >1/3 da ACM', 
            'Opção - Território vascular completo ou >1/3 da ACM', 
            'Efeito tumefativo', 
            'Angio TC intracraniana', 
            'Oclusão intracraniana', 
            'AVC I Detectável', 
            'Restrição a DWI', 
            'Lado', 
            'Topografia', 
            'Território vascular completo ou >1/3 da ACM', 
            'Opção - Território vascular completo ou >1/3 da ACM', 
            'Efeito tumefativo', 
            'Angio RNM intracraniana', 
            'Oclusão intracraniana',  
            'Estenose intracraniana', 
            'Angio RNM extracraniana', 
            'Normal', 
            'ACD', 
            'Oclusão - Lado', 
            'Oclusão - Localização', 
            'Estenose - Lado', 
            'Estenose - Localização', 
            'Estenose - Grau', 
            'ACE', 
            'Oclusão - Lado', 
            'Oclusão - Localização', 
            'Estenose - Lado', 
            'Estenose - Localização', 
            'Estenose - Grau', 
            'AVD', 
            'Oclusão - Lado', 
            'Oclusão - Localização', 
            'Estenose - Lado', 
            'Estenose - Localização', 
            'Estenose - Grau', 
            'AVE',
            'Oclusão - Lado', 
            'Oclusão - Localização', 
            'Estenose - Lado', 
            'Estenose - Localização', 
            'Estenose - Grau', 
            'DSA', 
            'Observações - DSA', 
            'Investiagação Complementar - Opção',
            'Definição da área de lesão',
            'Craniotomia descompressiva',
            'Efeito Tumofativo',
            'Transformação hemorrágica',
            'Opção - Transformação hemorrágica',
            '1. Avaliação de imagem do cérebro (verifique todos os que se aplicam)',
            '2. Avaliação de imagem vascular cerebral (verifique todos os que se aplicam)',
            '3. Avaliação para o diagnóstico de outras causas (incomum) de acidente vascular cerebral (verifique todas as que se aplicam)',
            'Foi realizado o upload da imagem?'
        ],];
        
        $death_final = ['index'=>[
            'Data do óbito',            
            'Local',            
            'Causa'
        ],];

        $formalta_final = ['index'=>[
            'Medicamentos para HAS',
            'Medicamentos para DM',
            'Medicamentos para Dislipidemia',
            'Medicamentos antitrombóticos',
            'Medicamentos anticoagulantes',
            'Medicamentos para Epilepsia',
            'Medicamentos para reabilitação',
            'Encanhimamentos para seguimento'
        ],];

        $epivasc_final = ['index'=>[
            'Histórico',
            'Crises'
        ],];

        $followup30Final = ['index'=>[
            'Faz acompanhamento para o AVC?',
            'Qual especialidade?',
            'Frequência',
            'Reabilitação pós alta?',
            'Qual especialidade?',
            'Valor da Hemoglobina Glicada',
            'Classificação - Hemoglobina',
            'Valor do colesterol LDL: (<75)',
            'Classificação - Colesterol',
            'Pressão arterial (PA > 140/90)',
            'Classificação - Pressão arterial',
            'Tabagismo',
            'Rankin',
            'Nome do posto',
            'Observações',
            'Número de crises no período',
            'Presença de crises com generalização tônico-clônica',
            'Uso de medicação anti-epilética'
        ],];

        $followup3mFinal = ['index'=>[
            'Faz acompanhamento para o AVC?',
            'Qual especialidade?',
            'Frequência',
            'Reabilitação pós alta?',
            'Qual especialidade?',
            'Valor da Hemoglobina Glicada',
            'Classificação - Hemoglobina',
            'Valor do colesterol LDL: (<75)',
            'Classificação - Colesterol',
            'Pressão arterial (PA > 140/90)',
            'Classificação - Pressão arterial',
            'Tabagismo',
            'Rankin',
            'Nome do posto',
            'Observações',
            'Número de crises no período',
            'Presença de crises com generalização tônico-clônica',
            'Uso de medicação anti-epilética'
        ],];

        $followup1aFinal = ['index'=>[
            'Faz acompanhamento para o AVC?',
            'Qual especialidade?',
            'Frequência',
            'Reabilitação pós alta?',
            'Qual especialidade?',
            'Valor da Hemoglobina Glicada',
            'Classificação - Hemoglobina',
            'Valor do colesterol LDL: (<75)',
            'Classificação - Colesterol',
            'Pressão arterial (PA > 140/90)',
            'Classificação - Pressão arterial',
            'Tabagismo',
            'Rankin',
            'Nome do posto',
            'Observações',
            'Número de crises no período',
            'Presença de crises com generalização tônico-clônica',
            'Uso de medicação anti-epilética'
        ],];

        $followup2aFinal = ['index'=>[
            'Faz acompanhamento para o AVC?',
            'Qual especialidade?',
            'Frequência',
            'Reabilitação pós alta?',
            'Qual especialidade?',
            'Valor da Hemoglobina Glicada',
            'Classificação - Hemoglobina',
            'Valor do colesterol LDL: (<75)',
            'Classificação - Colesterol',
            'Pressão arterial (PA > 140/90)',
            'Classificação - Pressão arterial',
            'Tabagismo',
            'Rankin',
            'Nome do posto',
            'Observações',
            'Número de crises no período',
            'Presença de crises com generalização tônico-clônica',
            'Uso de medicação anti-epilética'
        ],];

        $followup3aFinal = ['index'=>[
            'Faz acompanhamento para o AVC?',
            'Qual especialidade?',
            'Frequência',
            'Reabilitação pós alta?',
            'Qual especialidade?',
            'Valor da Hemoglobina Glicada',
            'Classificação - Hemoglobina',
            'Valor do colesterol LDL: (<75)',
            'Classificação - Colesterol',
            'Pressão arterial (PA > 140/90)',
            'Classificação - Pressão arterial',
            'Tabagismo',
            'Rankin',
            'Nome do posto',
            'Observações',
            'Número de crises no período',
            'Presença de crises com generalização tônico-clônica',
            'Uso de medicação anti-epilética'
        ],];

        $followup4aFinal = ['index'=>[
            'Faz acompanhamento para o AVC?',
            'Qual especialidade?',
            'Frequência',
            'Reabilitação pós alta?',
            'Qual especialidade?',
            'Valor da Hemoglobina Glicada',
            'Classificação - Hemoglobina',
            'Valor do colesterol LDL: (<75)',
            'Classificação - Colesterol',
            'Pressão arterial (PA > 140/90)',
            'Classificação - Pressão arterial',
            'Tabagismo',
            'Rankin',
            'Nome do posto',
            'Observações',
            'Número de crises no período',
            'Presença de crises com generalização tônico-clônica',
            'Uso de medicação anti-epilética'
        ],];

        $followup5aFinal = ['index'=>[
            'Faz acompanhamento para o AVC?',
            'Qual especialidade?',
            'Frequência',
            'Reabilitação pós alta?',
            'Qual especialidade?',
            'Valor da Hemoglobina Glicada',
            'Classificação - Hemoglobina',
            'Valor do colesterol LDL: (<75)',
            'Classificação - Colesterol',
            'Pressão arterial (PA > 140/90)',
            'Classificação - Pressão arterial',
            'Tabagismo',
            'Rankin',
            'Nome do posto',
            'Observações',
            'Número de crises no período',
            'Presença de crises com generalização tônico-clônica',
            'Uso de medicação anti-epilética'
        ],];

        foreach ($followupData as $paciente)
        {
            $identificacao = array($paciente['patient']['name'], 
            ExportCenter::TratamentoBranco($paciente['patient']['birth_date']), 
            ExportCenter::TratamentoBranco($paciente['interview_date']), 
            ExportCenter::getDate($paciente['admission_date']), 
            ExportCenter::getTime($paciente['admission_date']), 
            ExportCenter::TratamentoBranco($paciente['patient']['cpf']),
            ExportCenter::TranslateOption($paciente['hospital']), 
            ExportCenter::TranslateOption($paciente['patient']['gender']), 
            ExportCenter::TranslateOption(ExportCenter::ResolveArray($paciente['patient']['telefone']), true));
            
            $ultimo_avc = array(ExportCenter::TranslateOption($paciente['first_event']['previous']), 
            ExportCenter::TratamentoBranco(ExportCenter::TranslateOption($paciente['first_event']['number_of_events'])),
            ExportCenter::TratamentoBranco($paciente['first_event']['last_event_date']), 
            ExportCenter::TratamentoBranco(ExportCenter::TranslateOption($paciente['first_event']['rehab'])),
            ExportCenter::TranslateOption(ExportCenter::ResolveArray($paciente['first_event']['rehab_details']), true), 
            ExportCenter::TranslateOption($paciente['first_event']['hospital']),
            ExportCenter::TranslateOption($paciente['first_event']['hmsj_uavc']));

            $evento_atual = array(ExportCenter::getDate($paciente['current_event']['event_datetime']), 
            ExportCenter::getTime($paciente['current_event']['event_datetime']),
            ExportCenter::getDate($paciente['current_event']['help_datetime']), 
            ExportCenter::getTime($paciente['current_event']['help_datetime']),
            ExportCenter::getDate($paciente['current_event']['arrival_datetime']), 
            ExportCenter::getTime($paciente['current_event']['arrival_datetime']),
            ExportCenter::TranslateOption($paciente['current_event']['transportation']), 
            ExportCenter::TratamentoBranco($paciente['current_event']['note']));
            
            $exames = array(ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['exams']['banford'], true)), 
            ExportCenter::TratamentoNIH($paciente['exams']['nih']),
            ExportCenter::TranslateOption($paciente['exams']['previous_rankin']),
            ExportCenter::TranslateOption($paciente['exams']['admission_rankin']), 
            ExportCenter::TratamentoBranco($paciente['exams']['barthel']),  
            ExportCenter::TomografiaCheck($paciente['exams']['list']),
            ExportCenter::CarotidasCheck($paciente['exams']['list']), 
            ExportCenter::EcocardiogramaCheck($paciente['exams']['list']), 
            ExportCenter::CranioCheck($paciente['exams']['list']),
            ExportCenter::HolterCheck($paciente['exams']['list']), 
            ExportCenter::RnmCheck($paciente['exams']['list']), 
            ExportCenter::AngiotcCheck($paciente['exams']['list']),
            ExportCenter::AngiografiaCheck($paciente['exams']['list']), 
            ExportCenter::DoplerCheck($paciente['exams']['list']), 
            //ExportCenter::faCheck($paciente['exams']['list']),
            //ExportCenter::sinusalCheck($paciente['exams']['list']),
            ExportCenter::TratamentoBranco($paciente['exams']['fasting_blood_glicose']), 
            ExportCenter::TratamentoBranco($paciente['exams']['triglycerides']), 
            ExportCenter::TratamentoBranco($paciente['exams']['total_cholesterol']), 
            ExportCenter::TratamentoBranco($paciente['exams']['hdl']), 
            ExportCenter::TratamentoBranco($paciente['exams']['ldl']), 
            ExportCenter::TratamentoBranco($paciente['exams']['uric_acid']),
            ExportCenter::TratamentoBranco($paciente['exams']['creatinine']),
            ExportCenter::TratamentoBranco($paciente['exams']['vhs']), 
            ExportCenter::TranslateOption($paciente['exams']['ecg']),
            ExportCenter::TranslateOption($paciente['exams']['actilyise']), 
            ExportCenter::getDate($paciente['exams']['actilyise_date']),
            ExportCenter::getTime($paciente['exams']['actilyise_date']), 
            ExportCenter::ResolveArray($paciente['exams']['admission_pa']),
            ExportCenter::getDate($paciente['exams']['tomography_datetime']),
            ExportCenter::getTime($paciente['exams']['tomography_datetime']),
            ExportCenter::TratamentoBranco($paciente['exams']['holter24']), 
            ExportCenter::TratamentoBranco($paciente['exams']['holter3']),
            ExportCenter::TratamentoBranco($paciente['exams']['holter7']), 
            ExportCenter::TratamentoBranco($paciente['exams']['note_telemetry_holter']), 
            ExportCenter::TratamentoBranco($paciente['exams']['echocardiogram_transthoracic']), 
            ExportCenter::TratamentoBranco($paciente['exams']['echocardiogram_transesophageal']), 
            ExportCenter::TratamentoBranco($paciente['exams']['echocardiogram_note']), 
            ExportCenter::TratamentoBranco($paciente['exams']['doppler_data_vertebral']), 
            ExportCenter::TratamentoBranco($paciente['exams']['doppler_vertebral_note']), 
            ExportCenter::TratamentoBranco($paciente['exams']['doppler_data_transcranial']), 
            ExportCenter::TratamentoBranco($paciente['exams']['doppler_transcranial_note']),
            //ExportCenter::areaCardiacaCheck($paciente['exams']['cardiac_area']),
            //ExportCenter::TranslateOption($paciente['exams']['xray_status']),
            ExportCenter::TranslateOption($paciente['exams']['cardiac_area']));
            
            $demografico = array(ExportCenter::TratamentoBranco(ExportCenter::BooleanStats(ExportCenter::ObjectOrArray($paciente['demographic']['city'],'joinville'))), 
            ExportCenter::TranslateOption(ExportCenter::ObjectOrArray($paciente['demographic']['city'],'time')), 
            ExportCenter::TratamentoBranco(ExportCenter::ObjectOrArray($paciente['demographic']['address'],'cep')), 
            ExportCenter::TratamentoBranco(ExportCenter::ObjectOrArray($paciente['demographic']['address'],'name')),
            ExportCenter::TratamentoBranco(ExportCenter::ObjectOrArray($paciente['demographic']['address'],'number')), 
            ExportCenter::TratamentoBranco(ExportCenter::ObjectOrArray($paciente['demographic']['address'],'neighborhood')), 
            ExportCenter::TratamentoBranco(ExportCenter::ObjectOrArray($paciente['demographic']['address'],'reference')), 
            ExportCenter::TratamentoBranco(ExportCenter::ObjectOrArray($paciente['demographic']['contact'],'phone')),
            ExportCenter::TratamentoBranco(ExportCenter::ObjectOrArray($paciente['demographic']['contact'],'mobile')),  
            ExportCenter::TratamentoBranco(ExportCenter::ObjectOrArray($paciente['demographic']['contact'],'office_phone')),
            ExportCenter::TratamentoBranco(ExportCenter::ObjectOrArray($paciente['demographic']['contact'],'office_name')), 
            ExportCenter::TratamentoBranco(ExportCenter::ObjectOrArray($paciente['demographic']['contact'], 'note')),
            ExportCenter::TratamentoBranco($paciente['demographic']['age']), 
            ExportCenter::TranslateOption($paciente['demographic']['race']), 
            ExportCenter::TratamentoBranco($paciente['demographic']['weight']), 
            ExportCenter::TratamentoBranco($paciente['demographic']['height']),
            ExportCenter::TratamentoBranco($paciente['demographic']['imc']),  
            ExportCenter::TranslateOption(ExportCenter::ObjectOrArray($paciente['demographic']['schooling'],'patient')),
            ExportCenter::TranslateOption(ExportCenter::ObjectOrArray($paciente['demographic']['schooling'],'mother')),  
            ExportCenter::TranslateOption(ExportCenter::ObjectOrArray($paciente['demographic']['schooling'],'father')), 
            ExportCenter::TranslateOption(ExportCenter::ObjectOrArray($paciente['demographic']['profession'],'current')), 
            ExportCenter::TranslateOption(ExportCenter::ObjectOrArray($paciente['demographic']['profession'],'father')),
            ExportCenter::TranslateOption(ExportCenter::ObjectOrArray($paciente['demographic']['health'],'child_health')), 
            ExportCenter::TranslateOption(ExportCenter::ObjectOrArray($paciente['demographic']['health'],'healthcare_attendance')));
            
            $origem_paciente = array(ExportCenter::TranslateOption($paciente['patient_origin']['immediate_origin']));
            
            $condicoes_socio = array(ExportCenter::TratamentoBranco($paciente['socioeconomic_conditions']['assets']['bathrooms']), 
            ExportCenter::TratamentoBranco($paciente['socioeconomic_conditions']['assets']['domestic_servants']),
            ExportCenter::TratamentoBranco($paciente['socioeconomic_conditions']['assets']['automobiles']),
            ExportCenter::TratamentoBranco($paciente['socioeconomic_conditions']['assets']['motorcycles']), 
            ExportCenter::TratamentoBranco($paciente['socioeconomic_conditions']['assets']['computers']),
            ExportCenter::TratamentoBranco($paciente['socioeconomic_conditions']['assets']['dishwashers']), 
            ExportCenter::TratamentoBranco($paciente['socioeconomic_conditions']['assets']['fridges']),
            ExportCenter::TratamentoBranco($paciente['socioeconomic_conditions']['assets']['freezers']), 
            ExportCenter::TratamentoBranco($paciente['socioeconomic_conditions']['assets']['washing_machines']),
            ExportCenter::TratamentoBranco($paciente['socioeconomic_conditions']['assets']['dvds']), 
            ExportCenter::TratamentoBranco($paciente['socioeconomic_conditions']['assets']['microwaves']), 
            ExportCenter::TratamentoBranco($paciente['socioeconomic_conditions']['assets']['clothes_dryers']), 
            ExportCenter::TratamentoBranco($paciente['socioeconomic_conditions']['piped_water'], true), 
            ExportCenter::TratamentoBranco($paciente['socioeconomic_conditions']['paved_street'], true));
            
            $fatores_risco = array(ExportCenter::TranslateOption($paciente['risk_factors']['avc']['parents']), 
            ExportCenter::TranslateOption($paciente['risk_factors']['avc']['family']),
            ExportCenter::TranslateOption($paciente['risk_factors']['hypertension']['status']),
            ExportCenter::TratamentoBranco($paciente['risk_factors']['hypertension']['months']),
            ExportCenter::TranslateOption($paciente['risk_factors']['hypertension']['medicines']), 
            ExportCenter::ResolveArray($paciente['risk_factors']['hypertension']['medicines_items'], true), 
            ExportCenter::TratamentoBranco($paciente['risk_factors']['hypertension']['group_visit'], true), 
            ExportCenter::TratamentoBranco($paciente['risk_factors']['hypertension']['pa']), 
            ExportCenter::TranslateOption($paciente['risk_factors']['hypertension']['pa_answer']), 
            ExportCenter::TranslateOption($paciente['risk_factors']['hypertension']['conclusion']), 
            ExportCenter::TranslateOption($paciente['risk_factors']['diabetes']['status']), 
            ExportCenter::TratamentoBranco($paciente['risk_factors']['diabetes']['months']),
            ExportCenter::TranslateOption($paciente['risk_factors']['diabetes']['medicines'], true),
            ExportCenter::TranslateOption($paciente['risk_factors']['diabetes']['medicines_items']), 
            ExportCenter::TranslateOption($paciente['risk_factors']['diabetes']['group_visit'], true), 
            ExportCenter::TranslateOption($paciente['risk_factors']['diabetes']['hemoglobin_level']), 
            ExportCenter::TranslateOption($paciente['risk_factors']['diabetes']['hemoglobin_hba1c_level']),
            ExportCenter::TranslateOption($paciente['risk_factors']['smoking']['status']), 
            ExportCenter::TranslateOption($paciente['risk_factors']['smoking']['livedwith']),
            ExportCenter::TratamentoBranco($paciente['risk_factors']['alcohol']['status'], true), 
            ExportCenter::TratamentoBranco($paciente['risk_factors']['alcohol']['doses']),
            ExportCenter::TranslateOption($paciente['risk_factors']['alcohol']['rating']),
            ExportCenter::TranslateOption($paciente['risk_factors']['dyslipidemia']['status']),
            ExportCenter::TranslateOption($paciente['risk_factors']['dyslipidemia']['medicines']), 
            ExportCenter::TranslateOption(ExportCenter::ResolveArray($paciente['risk_factors']['dyslipidemia']['medicines_items'], true)),
            ExportCenter::TratamentoBranco($paciente['risk_factors']['dyslipidemia']['months']), 
            ExportCenter::TranslateOption($paciente['risk_factors']['cardiopathy']['status']),
            ExportCenter::ResolveArray($paciente['risk_factors']['cardiopathy']['patologies'], true), 
            ExportCenter::TratamentoBranco($paciente['risk_factors']['cardiopathy']['custom_patology']), 
            ExportCenter::TranslateOption($paciente['risk_factors']['cardiopathy']['conclusion']), 
            ExportCenter::TranslateOption($paciente['risk_factors']['cardiopathy']['anticoagulant_usage']), 
            ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['risk_factors']['cardiopathy']['anticoagulant_items'], true)), 
            ExportCenter::TranslateOption($paciente['risk_factors']['antitrombotic']['medicines']), 
            ExportCenter::ResolveArray($paciente['risk_factors']['antitrombotic']['medicines_items'], true), 
            ExportCenter::TratamentoBranco($paciente['risk_factors']['antitrombotic']['pvi'], true),
            ExportCenter::TratamentoBranco($paciente['risk_factors']['antitrombotic']['revascularization'], true), 
            ExportCenter::TranslateOption($paciente['risk_factors']['drugs']['usage']),
            ExportCenter::TratamentoBranco($paciente['risk_factors']['drugs']['description']),
            ExportCenter::TratamentoBranco($paciente['risk_factors']['drugs']['usage_months']),
            ExportCenter::TratamentoBranco($paciente['risk_factors']['drugs']['stopped_months']), 
            ExportCenter::TranslateOption($paciente['risk_factors']['sedentary']['status']));
            
            $alta = array(ExportCenter::TratamentoBranco($paciente['discharge']['date']), 
            ExportCenter::TranslateOption($paciente['discharge']['avc_type']),
            ExportCenter::TranslateOption(ExportCenter::ObjectOrArray($paciente['discharge']['avc_ait'],'value')), 
            ExportCenter::TranslateOption(ExportCenter::ResolveArray(ExportCenter::ObjectOrArray($paciente['discharge']['avc_itoast'],'type'),true)), 
            ExportCenter::TranslateOption(ExportCenter::ObjectOrArray($paciente['discharge']['avc_h'],'type')),
            ExportCenter::TratamentoBranco(ExportCenter::BooleanStats(ExportCenter::ObjectOrArray($paciente['discharge']['avc_itoast'],'surgery')), true), 
            ExportCenter::TratamentoBranco(ExportCenter::BooleanStats(ExportCenter::ObjectOrArray($paciente['discharge']['avc_hsa'],'surgery')), true),
            ExportCenter::TranslateOption($paciente['discharge']['rankin']), 
            ExportCenter::TratamentoBranco($paciente['discharge']['barthel']), 
            ExportCenter::ResolveArray($paciente['discharge']['hmsj_uavc']['description'], true)); 

            $biobase = array(ExportCenter::TratamentoBranco($paciente['biobase']['receipt_date']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['extraction_date']), 
                            ExportCenter::TratamentoBranco($paciente['biobase']['storage_date']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['dna_quantification']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['freezer_location']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['note']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_1']['name']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_1']['born_date']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_1']['gender']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_1']['kinship']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_1']['race']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_1']['cep']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_1']['address']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_1']['number']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_1']['neighborhood']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_1']['reference']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_1']['avc']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_1']['kindred_avc']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_1']['hypertension']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_1']['diabetes']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_1']['dyslipidemia']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_1']['smoking']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_1']['cardiopathy']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_1']['cardiopathy_description']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_2']['name']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_2']['born_date']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_2']['gender']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_2']['kinship']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_2']['race']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_2']['cep']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_2']['address']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_2']['number']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_2']['neighborhood']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_2']['reference']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_2']['avc']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_2']['kindred_avc']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_2']['hypertension']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_2']['diabetes']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_2']['dyslipidemia']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_2']['smoking']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_2']['cardiopathy']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_2']['cardiopathy_description']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_3']['name']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_3']['born_date']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_3']['gender']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_3']['kinship']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_3']['race']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_3']['cep']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_3']['address']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_3']['number']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_3']['neighborhood']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_3']['reference']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_3']['avc']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_3']['kindred_avc']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_3']['hypertension']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_3']['diabetes']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_3']['dyslipidemia']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_3']['smoking']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_3']['cardiopathy']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_3']['cardiopathy_description']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_4']['name']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_4']['born_date']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_4']['gender']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_4']['kinship']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_4']['race']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_4']['cep']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_4']['address']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_4']['number']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_4']['neighborhood']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_4']['reference']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_4']['avc']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_4']['kindred_avc']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_4']['hypertension']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_4']['diabetes']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_4']['dyslipidemia']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_4']['smoking']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_4']['cardiopathy']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_4']['cardiopathy_description']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_5']['name']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_5']['born_date']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_5']['gender']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_5']['kinship']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_5']['race']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_5']['cep']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_5']['address']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_5']['number']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_5']['neighborhood']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_5']['reference']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_5']['avc']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_5']['kindred_avc']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_5']['hypertension']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_5']['diabetes']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_5']['dyslipidemia']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_5']['smoking']),
                            ExportCenter::TranslateOption($paciente['biobase']['control_5']['cardiopathy']),
                            ExportCenter::TratamentoBranco($paciente['biobase']['control_5']['cardiopathy_description']),
                        );
            
            $imageform = array(ExportCenter::TratamentoBranco(ExportCenter::BooleanStats($paciente['imageform']['avc_h'])),
                        ExportCenter::TratamentoBranco($paciente['imageform']['avc_intra'], true),
                        ExportCenter::TratamentoBranco($paciente['imageform']['hs'], true),
                        ExportCenter::TranslateOption($paciente['imageform']['topolobar']),
                        ExportCenter::TranslateOption($paciente['imageform']['topoprofunda']),
                        ExportCenter::TranslateOption($paciente['imageform']['volhematoma']),
                        ExportCenter::TranslateOption($paciente['imageform']['iv']),
                        ExportCenter::TranslateOption($paciente['imageform']['fisher']),
                        ExportCenter::TratamentoBranco($paciente['imageform']['hidrocefalia'], true),
                        ExportCenter::TranslateOption($paciente['imageform']['angiotomografia']),
                        ExportCenter::TranslateOption($paciente['imageform']['aneurisma']),
                        ExportCenter::TranslateOption($paciente['imageform']['angiornm']),
                        ExportCenter::TranslateOption($paciente['imageform']['aneurismarnm']),
                        ExportCenter::TranslateOption($paciente['imageform']['dsa']),
                        ExportCenter::TranslateOption($paciente['imageform']['aneurismadsa']),
                        ExportCenter::TratamentoBranco($paciente['imageform']['avc_i'], true),
                        ExportCenter::TratamentoBranco($paciente['imageform']['avc_tc'], true),
                        ExportCenter::TratamentoBranco($paciente['imageform']['avc_rnm'], true),
                        ExportCenter::TranslateOption($paciente['imageform']['fa_aspects']),
                        ExportCenter::TranslateOption($paciente['imageform']['fa_lado']),
                        ExportCenter::TranslateOption($paciente['imageform']['fa_topografia']),
                        ExportCenter::TratamentoBranco($paciente['imageform']['fa_tvc'], true),
                        ExportCenter::TranslateOption($paciente['imageform']['tvc_op']),
                        ExportCenter::TranslateOption($paciente['imageform']['fa_tumefativo']),
                        ExportCenter::TranslateOption($paciente['imageform']['fa_atc']),
                        ExportCenter::TranslateOption($paciente['imageform']['atc_opga']),
                        ExportCenter::TranslateOption($paciente['imageform']['rnm_avcidetec']),
                        ExportCenter::TranslateOption($paciente['imageform']['rnm_rdwi']),
                        ExportCenter::TranslateOption($paciente['imageform']['rnm_lado']),
                        ExportCenter::TranslateOption($paciente['imageform']['rnm_topografia']),
                        ExportCenter::TranslateOption($paciente['imageform']['rnm_tvc']),
                        ExportCenter::TranslateOption($paciente['imageform']['rnm_tvc_op']),
                        ExportCenter::TranslateOption($paciente['imageform']['rnm_tumefativo']),
                        ExportCenter::TranslateOption($paciente['imageform']['angiornm']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_opga']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_estopga']),
                        ExportCenter::TratamentoBranco($paciente['imageform']['fa_rnmextra'], true),
                        ExportCenter::TratamentoBranco($paciente['imageform']['arnm_normal'], true),
                        ExportCenter::TratamentoBranco($paciente['imageform']['arnm_acd'], true),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_acdlado']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_acdloc']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_acdestlado']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_acdestloc']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_acdestgrau']),
                        ExportCenter::TratamentoBranco($paciente['imageform']['arnm_ace'], true),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_acelado']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_aceloc']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_aceestlado']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_aceestloc']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_aceestgrau']),
                        ExportCenter::TratamentoBranco($paciente['imageform']['arnm_avd'], true),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_avdlado']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_avdloc']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_avdestlado']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_avdestloc']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_avdestgrau']),
                        ExportCenter::TratamentoBranco($paciente['imageform']['arnm_ave'], true),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_avelado']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_aveloc']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_aveestlado']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_aveestloc']),
                        ExportCenter::TranslateOption($paciente['imageform']['arnm_aveestgrau']),
                        ExportCenter::TratamentoBranco($paciente['imageform']['dsanew'], true),
                        ExportCenter::TratamentoBranco($paciente['imageform']['dsanote']),
                        ExportCenter::TranslateOption($paciente['imageform']['rnm_selec']),
                        ExportCenter::TratamentoBranco($paciente['imageform']['rnm_dal'], true),
                        ExportCenter::TratamentoBranco($paciente['imageform']['rnm_cd'], true),
                        ExportCenter::TranslateOption($paciente['imageform']['rnm_et']),
                        ExportCenter::TratamentoBranco($paciente['imageform']['avc_rnm_th']),
                        ExportCenter::TranslateOption($paciente['imageform']['rnm_thop']),
                        ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['imageform']['css1'], true)),
                        ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['imageform']['css2'], true)),
                        ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['imageform']['css3'], true)),
                        ExportCenter::TratamentoBranco($paciente['imageform']['uploadimg'], true));
                
                $formalta = array(ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['formalta']['medhas'], true)),
                                  ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['formalta']['meddm'], true)), 
                                  ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['formalta']['meddis'], true)),
                                  ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['formalta']['medanti'], true)),
                                  ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['formalta']['medantico'], true)),
                                  ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['formalta']['medepilepsia'], true)),
                                  ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['formalta']['enca'], true)),
                                  ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['formalta']['encseg'],true)));
                
                $epivasc = array(ExportCenter::ResolveArray($paciente['epivasc']['clinical_history'], true),
                                 ExportCenter::ResolveArray($paciente['epivasc']['seizures'], true)); 
                        
                $followup30 = array(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow30']['avc_monitoring'], true),
                                ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow30']['fuespecialities'], true)),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow30']['frequency_health_center']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow30']['physiotherapy']),
                                ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow30']['especialities'], true)),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow30']['glycemic_Hemoglobin_value']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow30']['glycemic_Hemoglobin_answer']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow30']['ldl_value']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow30']['ldl_answer']),
                                ExportCenter::ResolveArray($paciente['ambulatory_care']['follow30']['blood_pressure']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow30']['blood_pressure_answer']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow30']['smoking']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow30']['follow_rankin30']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow30']['postname']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow30']['note']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow30']['nbperiods']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow30']['presencacrises']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow30']['antiepiletic']));
                        
                $followup3m = array(ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow3m']['avc_monitoring'], true)),
                                ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow3m']['fuespecialities'], true)),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow3m']['frequency_health_center']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow3m']['physiotherapy']),
                                ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow3m']['especialities'], true)),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow3m']['glycemic_Hemoglobin_value']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow3m']['glycemic_Hemoglobin_answer']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow3m']['ldl_value']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow3m']['ldl_answer']),
                                ExportCenter::ResolveArray($paciente['ambulatory_care']['follow3m']['blood_pressure']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow3m']['blood_pressure_answer']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow3m']['smoking']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow3m']['follow_rankin30']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow3m']['postname']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow3m']['note']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow3m']['nbperiods']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow3m']['presencacrises']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow3m']['antiepiletic']));

                $followup1a = array(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow1a']['avc_monitoring'], true),
                                ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow1a']['fuespecialities'], true)),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow1a']['frequency_health_center']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow1a']['physiotherapy']),
                                ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow1a']['especialities'], true)),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow1a']['glycemic_Hemoglobin_value']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow1a']['glycemic_Hemoglobin_answer']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow1a']['ldl_value']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow1a']['ldl_answer']),
                                ExportCenter::ResolveArray($paciente['ambulatory_care']['follow1a']['blood_pressure']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow1a']['blood_pressure_answer']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow1a']['smoking']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow1a']['follow_rankin30']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow1a']['postname']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow1a']['note']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow1a']['nbperiods']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow1a']['presencacrises']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow1a']['antiepiletic']));
                        
                $followup2a = array(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow2a']['avc_monitoring'], true),
                                ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow2a']['fuespecialities'], true)),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow2a']['frequency_health_center']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow2a']['physiotherapy']),
                                ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow2a']['especialities'], true)),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow2a']['glycemic_Hemoglobin_value']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow2a']['glycemic_Hemoglobin_answer']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow2a']['ldl_value']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow2a']['ldl_answer']),
                                ExportCenter::ResolveArray($paciente['ambulatory_care']['follow2a']['blood_pressure']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow2a']['blood_pressure_answer']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow2a']['smoking']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow2a']['follow_rankin30']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow2a']['postname']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow2a']['note']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow2a']['nbperiods']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow2a']['presencacrises']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow2a']['antiepiletic']));
                        
                $followup3a = array(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow3a']['avc_monitoring'], true),
                                ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow3a']['fuespecialities'], true)),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow3a']['frequency_health_center']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow3a']['physiotherapy']),
                                ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow3a']['especialities'], true)),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow3a']['glycemic_Hemoglobin_value']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow3a']['glycemic_Hemoglobin_answer']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow3a']['ldl_value']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow3a']['ldl_answer']),
                                ExportCenter::ResolveArray($paciente['ambulatory_care']['follow3a']['blood_pressure']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow3a']['blood_pressure_answer']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow3a']['smoking']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow3a']['follow_rankin30']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow3a']['postname']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow3a']['note']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow3a']['nbperiods']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow3a']['presencacrises']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow3a']['antiepiletic']));

                $followup4a = array(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow4a']['avc_monitoring'], true),
                                ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow4a']['fuespecialities'], true)),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow4a']['frequency_health_center']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow4a']['physiotherapy']),
                                ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow4a']['especialities'], true)),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow4a']['glycemic_Hemoglobin_value']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow4a']['glycemic_Hemoglobin_answer']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow4a']['ldl_value']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow4a']['ldl_answer']),
                                ExportCenter::ResolveArray($paciente['ambulatory_care']['follow4a']['blood_pressure']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow4a']['blood_pressure_answer']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow4a']['smoking']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow4a']['follow_rankin30']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow4a']['postname']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow4a']['note']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow4a']['nbperiods']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow4a']['presencacrises']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow4a']['antiepiletic']));

                $followup5a = array(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow5a']['avc_monitoring'], true),
                                ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow5a']['fuespecialities'], true)),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow5a']['frequency_health_center']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow5a']['physiotherapy']),
                                ExportCenter::TratamentoBranco(ExportCenter::ResolveArray($paciente['ambulatory_care']['follow5a']['especialities'], true)),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow5a']['glycemic_Hemoglobin_value']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow5a']['glycemic_Hemoglobin_answer']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow5a']['ldl_value']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow5a']['ldl_answer']),
                                ExportCenter::ResolveArray($paciente['ambulatory_care']['follow5a']['blood_pressure']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow5a']['blood_pressure_answer']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow5a']['smoking']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow5a']['follow_rankin30']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow5a']['postname']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow5a']['note']),
                                ExportCenter::TranslateOption($paciente['ambulatory_care']['follow5a']['nbperiods']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow5a']['presencacrises']),
                                ExportCenter::TratamentoBranco($paciente['ambulatory_care']['follow5a']['antiepiletic']));

                $death = array(ExportCenter::TratamentoBranco($paciente['death']['date']),
                                ExportCenter::TranslateOption($paciente['death']['place']),
                                ExportCenter::TranslateOption($paciente['death']['cause'])); 

                array_push($identificacao_final, $identificacao); 
                array_push($ultimo_avc_final, $ultimo_avc); 
                array_push($evento_atual_final, $evento_atual);
                array_push($exames_final, $exames); 
                array_push($death_final, $death); 
                array_push($origem_paciente_final, $origem_paciente);
                array_push($condicoes_socio_final, $condicoes_socio); 
                array_push($demografico_final, $demografico); 
                array_push($alta_final, $alta); 
                array_push($biobase_final, $biobase); 
                array_push($fatores_risco_final, $fatores_risco); 
                array_push($imageform_final, $imageform); 
                array_push($formalta_final, $formalta); 
                array_push($epivasc_final, $epivasc); 
                array_push($followup30Final, $followup30);
                array_push($followup3mFinal, $followup3m);
                array_push($followup1aFinal, $followup1a);
                array_push($followup2aFinal, $followup2a);
                array_push($followup3aFinal, $followup3a);
                array_push($followup4aFinal, $followup4a);
                array_push($followup5aFinal, $followup5a); 

            $final = [    
                $ultimo_avc_final, 
                $evento_atual_final,
                $exames_final,
                $demografico_final,
                $origem_paciente_final,
                $condicoes_socio_final,
                $fatores_risco_final,
                $alta_final,                
                $biobase_final,
                $formalta_final,
                $epivasc_final,
                $imageform_final,
                $followup30Final,
                $followup3mFinal,
                $followup1aFinal,
                $followup2aFinal,
                $followup3aFinal,
                $followup4aFinal,
                $followup5aFinal,
                $death_final,                
            ];
            
            $result = $identificacao_final;
            $spreadsheet = new Spreadsheet();

            for ($x=0; $x < count(self::FIELDS); $x++) { 
                $result = ExportCenter::mergeArray(self::FIELDS[$x], $exportProfile, $result, $final[$x]);
            }
        }
        $sizeArray = sizeof($result[0]);
        
        $spreadsheet->getActiveSheet()->getStyle('1:1')->getFont()->setBold(true);
        $spreadsheet->getDefaultStyle()->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        $spreadsheet->getActiveSheet()->fromArray($result, 'A1');
 
        for ($i=0;$i<$sizeArray;$i++)
        {
            $spreadsheet->getActiveSheet()->getColumnDimension(ExportCenter::getNameFromNumber($i))->setAutoSize(true);
        } 

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save("Export.xlsx");

        $file = 'Export.xlsx';

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            unlink($file);
        }
}

    private static function mergeArray($filed, $exportProfile, $result, $endColuns){ 
        if(in_array($filed, $exportProfile)){
            return array_map(function($array1,$array2){  
                    return array_merge(isset($array1) ? $array1 : array(), isset($array2) ? $array2 : array());
                     },$result,$endColuns);
        }
        return $result;
    }

    private static function getNameFromNumber($num)
    {
        $numeric = $num % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval($num / 26);
        if ($num2 > 0) {
            return ExportCenter::getNameFromNumber($num2 - 1) . $letter;
        } 
        else {
            return $letter;
        }
    }

    private static function ResolveArray($array, $translate=false)
    {
        # code...
        $resposta = "";
        if ($array == null) {
            $resposta = "";
        } else {
            # code...
            foreach ($array as $key => $value) {
                # code...
                if($translate === true){
                    $resposta .= ExportCenter::TranslateOption($value).",";
                }else {
                    $resposta .= $value.",";
                }
            }
        }

        return ExportCenter::TratamentoBranco(rtrim($resposta,","));
    }
    
    private static function TranslateOption($value)
    {
         $options = new \App\Option();
         $op = $options->where('value', $value)->first();
         return ExportCenter::TratamentoBranco($op['label']);
    }

    private static function ExportFilterPA($followupData)
    {
        $followupResp = [];
        # criando um tratamento
        foreach ($followupData as $paciente) {
            # code...
            if($paciente['exams']['admission_pa'][0] <= 160 && $paciente['exams']['admission_pa'][1] <= 80) {
                //print_r($paciente['exams']['admission_pa']);
                $followupResp[] = $paciente;
            }
        }
        return ExportCenter::CreateExcelFile($followupResp);
    }

    private static function TratamentoNIH($value)
    {
        if (($value == 0 || $value == FALSE) && !is_null($value)) {
            return "Zero";
        } else if (is_null($value)) {
            return "Não definido";
        } else {
            return $value;
        }
    }

    private static function TratamentoBranco($value, $bool="false")
    {
        #code...
        if (is_null($value) || $value == "") { 
            return "Não definido";
        } else if ($value === TRUE || $value == "TRUE" || $value == "true" || ($value == '1' && $bool == "true")) {
            return "Sim";
        } else if (($value == "false" && $bool == "true") || ($value == FALSE && $bool == "true") || ($value == "FALSE" && $bool == "true") || ($value == 0 && $bool == "true")) {
            return "Não";
        } else {
            return $value;
        }
    }

    private static function BooleanStats($bool)
    {
        return $bool = 1 ? true : false;
    }

    private static function getDate($value)
    {
        #code...
        $data = explode(" - ", $value);
        if (count($data)>0){
            $diaMes = $data[0];
        }else{
            $diaMes = '';
        }
        
        return ExportCenter::TratamentoBranco($diaMes);
    }

    private static function getTime($value)
    {
        #code...
        $data = explode(" - ", $value);
        if(count($data) == 2){
            $time = $data[1];
        }else{
            $time = '';
        }
        return ExportCenter::TratamentoBranco($time);
    }

    private static function ObjectOrArray($array,$field)
    {
        # code...
        if ($field == "note") {
            if (array_key_exists($field, $array)) {
                $city = $array;
                return is_array($city) ? $city[$field] : $city->$field;
            } else {
                return null;
            }
        }
        $city = $array;
        return is_array($city) ? $city[$field] : $city->$field;
    }

    private static function TomografiaCheck($list) 
    {
        if (!is_null($list)) {
            $size = sizeof($list); 

            for($i=0; $i<$size; $i++) {
                if ($list[$i] == "exams-exams-list-tomografia"){
                    return "Sim";
                }
                else {
                    return "Não Realizado";
                }
            }
        } else {
            return "Não Definido";
        }
    }        

    private static function CarotidasCheck($list)
    {
        if (!is_null($list)) {
            $size = sizeof($list); 

            for($i=0; $i<$size; $i++) {
                if ($list[$i] == "exams-exams-list-usg-carotidas"){
                    return "Sim";
                }
                else {
                    return "Não Realizado";
                }
            }
        } else {
            return "Não Definido";
        }
               
    }
    
    private static function EcocardiogramaCheck($list)
    {
        if (!is_null($list)) {
            $size = sizeof($list); 

            for($i=0; $i<$size; $i++) {
                if ($list[$i] == "exams-exams-list-ecocardiograma"){
                    return "Sim";
                }
                else {
                    return "Não Realizado";
                }
            }
        } else {
            return "Não Definido";
        }
               
    }

    private static function CranioCheck($list)
    {
        if (!is_null($list)) {
            $size = sizeof($list); 

            for($i=0; $i<$size; $i++) {
                if ($list[$i] == "exams-exams-list-rnm-cranio"){
                    return "Sim";
                }
                else {
                    return "Não Realizado";
                }
            }
        } else {
            return "Não Definido";
        }
    }

    private static function HolterCheck($list)
    {
        if (!is_null($list)) {
            $size = sizeof($list); 

            for($i=0; $i<$size; $i++) {
                if ($list[$i] == "exams-exams-list-holter24h"){
                    return "Sim";
                }
                else {
                    return "Não Realizado";
                }
            }
        } else {
            return "Não Definido";
        }
    }

    private static function RnmCheck($list) 
    {
        if (!is_null($list)) {
            $size = sizeof($list);

            for($i=0; $i<$size; $i++) {
                if ($list[$i] == "exams-exams-list-angio-rnm"){
                    return "Sim";
                }
                else {      
                    return "Não Realizado";
                }
            }
        } else {
            return "Não Definido";
        }
 
    }

    private static function AngiotcCheck($list) 
    {
        if (!is_null($list)) {
            $size = sizeof($list);

            for($i=0; $i<$size; $i++) {
                if ($list[$i] == "exams-exams-list-angio-tc"){
                    return "Sim";
                }
                else {
                    return "Não Realizado";
                }
            }
        } else {
            return "Não Definido";
        }
 
    }

    private static function AngiografiaCheck($list)
    {
        if (!is_null($list)) {
            $size = sizeof($list);

            for($i=0; $i<$size; $i++) {
                if ($list[$i] == "exams-exams-list-angiografia"){
                    return "Sim";
                }
                else {
                    return "Não Realizado";
                }
            }
        } else {
            return "Não Definido";
        }
 
    }

    private static function DoplerCheck($list)
    {
        if (!is_null($list)) {
            $size = sizeof($list);

            for($i=0; $i<$size; $i++) {
                if ($list[$i] == "exams-exams-list-dopler-transcraniano"){
                    return "Sim";
                }
                else {
                    return "Não Realizado";
                }
            }
        } else {
            return "Não Definido";
        }
 
    }

    private static function faCheck($list)
    {
        if (!is_null($list)) {
            $size = sizeof($list);

            for($i=0; $i<$size; $i++) {
                if ($list[$i] == "exams-ecg-fa"){
                    return "Sim";
                }
                else {
                    return "Não Realizado";
                }
            } 
        } else {
            return "Não Definido";
        }

    }

    private static function sinusalCheck($list)
    {
        if (!is_null($list)) {
            $size = sizeof($list);

            for($i=0; $i<$size; $i++) {
                if ($list[$i] == "exams-ecg-sinusal"){
                    return "Sim";
                }
                else {
                    return "Não Realizado";
                }
            }
        } else {
            return "Não Definido";
        }
    }

    private static function areaCardiacaCheck($ac)
    {
        if (is_null($ac)) {
            return "Não realizado";
        }
        else {
            return "Sim";
        }
    }
}


    



