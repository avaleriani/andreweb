@extends('layouts.admin')
@section('content')
    @include('errors.message')
    {!! Html::ul($errors->all()) !!}
    <div class="row tabla">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-globe"></i> Imagenes</h3>
                    <a href="{!! route('admin.projectsImages.create', $project->id) !!}" class="btn btn-new">Upload</a>
                </div>
                <div class="panel-body">
                    <div id="grid">
                        <div class="sui-gridheader">
                            <table class="sui-table order-table table">
                                <thead>
                                <tr class="sui-columnheader">
                                    <th class="sui-headercell">Imagen</th>
                                    <th class="sui-headercell">@sortablelink('name', 'Nombre')</th>
                                    <th class="sui-headercell" data-field="Acciones"><a href="#"
                                                                                        class="sui-link">Acciones</a>
                                    </th>

                                </tr>
                                </thead>
                                <tbody class="list">
                                @foreach ($project->thumbnails() as $img)
                                    <tr class="sui-row">
                                        <td class="sui-cell"><img
                                                    src="{!! public_path(). env('THUMBNAIL_PATH'). $img->filename !!}">
                                        </td>
                                        <td class="sui-cell">{!! $img->name !!}</td>
                                        <td class="sui-cell">{!! $img->order !!}</td>

                                        <td class='actions'>
                                        <span class="btn-normal">
                                            <a href="{!! route("admin.projectImage.show" , $img->id) !!}">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </span>
                                            <span class="btn-normal">
                                            <a href="{!! route("admin.projectImage.edit" , $img->id) !!}">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                        </span>
                                            {!!  Form::open(array('url' => route('admin.projectImage.destroy', $img->id), 'class' => 'form-no-style'))  !!}
                                            {!! Form::hidden('_method', 'DELETE')  !!}
                                            <span class="btn-normal">
                                                {{Form::button('<i class="fa fa-trash"></i>', array('type' => 'submit','class'=>'btn-no-style', 'onclick' => "return confirm('¿Confirma que desea borrar la imagen?')"))}}
                                            </span>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop