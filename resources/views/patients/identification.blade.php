<div class="panel panel-default">
    <div class="panel-heading">Cadastro de Dados do Paciente</div>
    <div class="panel-body">
        <form action="{{ route('patients.store') }}" method="POST">
            {{ csrf_field() }}

            <div class="row">
                <div class="form-group col-xs-12">
                    <label for="name">Nome</label>
                    <input class="form-control" type="text" name="name">
                </div>

                <div class="form-group col-xs-12">
                    <label for="birth_date">Data de Nascimento</label>
                    <input class="form-control" type="text" name="birth_date">
                </div>

                <div class="form-group col-xs-12">
                    <label for="interview_date">Data de Entrevista</label>
                    <input class="form-control" type="text" name="interview_date">
                </div>

                <div class="form-group col-xs-12">
                    <label for="admission_date">Data de Admissão</label>
                    <input class="form-control" type="text" name="admission_date">
                </div>

                <div class="form-group col-xs-12">
                    <label for="">Número do Prontuário</label>
                    <input class="form-control" type="text" name="records_identifier">
                </div>

                <div class="form-group col-xs-12">
                    <label for="gender">Gênero</label>
                    <select class="form-control" name="gender">
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>

                <div class="form-group col-xs-12">
                    <label for="treatment_type">Tipo de Tratamento</label>
                    <select class="form-control" name="treatment_type">
                        <option value="internado">Internado</option>
                        <option value="ambulatorio">Ambulatório</option>
                    </select>
                </div>

                <div class="form-group col-xs-12">
                    <button class="btn btn-primary pull-right" type="submit">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>