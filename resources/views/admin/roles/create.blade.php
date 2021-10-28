```php
@extends('adminlte::page')

@section('title', 'Crear rol | Soluciones++')

@section('content_header')
    <h1>Crear nuevo rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.roles.store']) !!}
                @include('admin.roles.partials.form')
                {!! Form::submit('Crear Rol', ['class' => 'btn btn-primary mt-2']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop