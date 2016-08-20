@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}
    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-globe"></i> Exportacion - Descarga</h3>
                </div>
                <div class="panel-body">
                    <div id="grid">
                        <div class="link">
                            <pre>
                                <a target="_blank" class="btn" href="{{ $downloadLink }}">DESCARGAR</a>
                            </pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop