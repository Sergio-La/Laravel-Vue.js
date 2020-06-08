@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inicio</div>

                <div class="card-body">
                <h3>Opciones</h3>

                    <a href="salones" class="btn btn-success">Salones</a>
                    <a href="estudiante" class="btn btn-primary">Estudiantes</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
