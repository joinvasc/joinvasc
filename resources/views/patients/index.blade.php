@extends('layouts.panel')

@section('panel')
    <div class="panel panel-default">
        <div class="panel-heading">Cadastro de Dados do Paciente</div>
        <div class="panel-body">
            @include('patients.identification')
        </div>
    </div>
@endsection