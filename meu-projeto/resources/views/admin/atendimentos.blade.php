@extends('admin.layout')

@section('content')

<div class="card-green">

<h4>Novo Atendimento</h4>

<form method="POST" action="{{ route('admin.atendimentos.store') }}">
@csrf

<div class="row">

<div class="col-md-3">
<label>Aluno</label>
<input type="text" name="aluno" class="form-control">
</div>

<div class="col-md-3">
<label>Data</label>
<input type="date" name="data" class="form-control">
</div>

<div class="col-md-3">
<label>Hora</label>
<input type="time" name="hora" class="form-control">
</div>

<div class="col-md-3">
<label>Descrição</label>
<input type="text" name="descricao" class="form-control">
</div>

</div>

<button class="btn btn-light mt-3">Salvar</button>

</form>

</div>

@endsection