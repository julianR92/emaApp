@extends('layouts.main')

@section('content')


<div>
    {{-- Be like water. --}}
    <div>
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="#">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="#">Parametrización</a></li>              
                <li class="breadcrumb-item active" aria-current="page">Docentes</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de Docentes</h1>
            </div> 
            <div>
                <a type="button" href="{{route('profesor.create')}}" class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M1 22a8 8 0 1 1 16 0H1zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6s6 2.685 6 6s-2.685 6-6 6zm9.246-9.816A9.97 9.97 0 0 1 19 7a9.97 9.97 0 0 1-.754 3.816l-1.677-1.22A7.99 7.99 0 0 0 17 7a7.99 7.99 0 0 0-.43-2.596l1.676-1.22zm3.302-2.4A13.942 13.942 0 0 1 23 7c0 2.233-.523 4.344-1.452 6.216l-1.645-1.196A11.955 11.955 0 0 0 21 7a11.96 11.96 0 0 0-1.097-5.02L21.548.784z"/></svg>Crear Docente
                </a>
            </div>    
                 
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTableDoc" data-toggle="table" data-search="true" data-pagination="true" data-page-size="5" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 rounded-start">#</th>
                            <th data-field="nombres" class="border-0">Nombres</th>
                            <th data-field="documento" class="border-0">Documento</th>
                            <th data-field="correo" class="border-0">Correo</th>
                            <th data-field="telefono" class="border-0">Telefono</th>
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyEje">
                        @foreach($docentes as $doc)
                         <tr>

                            <td>{{$doc->id}}</td>
                            <td>{{$doc->nombres}} {{$doc->apellidos}}</td>
                            <td>{{$doc->documento}}</td>
                            <td>{{$doc->correo}}</td>
                            <td>{{$doc->celular}}</td>
                           
                            <td>
                            <a href="{{route('profesor.edit',$doc->id)}}">
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarDocente">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                            </a>
                            @canany(['control-total'])
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarDocente"  data-id="{{$doc->id}}"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>
                            @endcanany
                            </td>
                         </tr>
                        @endforeach
                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="d-flex justify-content-end">
        </div>       
    </div>
    {{-- MODAL --}}
    
   </div>
</div>
@push('docentes-js')
<script src="{{asset('js/profesores-delete.js')}}" type="module"></script>
@endpush



@endsection