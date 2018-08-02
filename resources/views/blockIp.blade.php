@extends('layouts.app')

@section('content')
<div class="container">
	<h4 class="text-center">Digite o IP a ser bloqueado</h4>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
		<form id="rel-form" action="{{ url('/sec/blockbyip') }}" method="POST">
			{{ csrf_field() }}
			<input type="name" name="ip" id="ip" placeholder="Digite apenas os numeros do ip">
			<button type="submit" class="btn btn-success btn-block" onclick="enviado()">Enviar</button>
		</form>
		</div>
	</div>
</div>
@endsection

<script type="text/javascript">
	function enviado() {
		const ip = document.getElementbyId("ip");
		if (ip) {
			console.log("IP cadastrado:" + ip);
		}
		else {
			console.log("IP nao foi cadastrado");
		}
	}
</script>


