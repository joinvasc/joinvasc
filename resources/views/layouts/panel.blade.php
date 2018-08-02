@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Etapas</div>
                    <div class="panel-body">

                        <ul class="nav">
                            <li><a href="#">Identificação do entrevistador</a></li>
                            <li><a href="#">Identificação do paciente</a></li>
                            <li><a href="#">Primeiro Evento AVC</a></li>
                            <li><a href="#">Exames</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                                    Evento AVC atual <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Exames</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @yield('panel')
            </div>
        </div>
    </div>
@endsection