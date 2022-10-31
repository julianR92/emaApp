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
                <li class="breadcrumb-item active" aria-current="page">Instrumentos</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">Administración de Instrumentos</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal10" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M215.4 22.5a12.2 12.2 0 0 0-10.3-2.1l-128 32A11.9 11.9 0 0 0 68 64v103.4a38.9 38.9 0 0 0-16-3.4a40 40 0 1 0 40 40v-82.6l104-26v40a38.9 38.9 0 0 0-16-3.4a40 40 0 1 0 40 40V32a12.1 12.1 0 0 0-4.6-9.5ZM52 220a16 16 0 1 1 16-16a16 16 0 0 1-16 16ZM92 96.6V73.4l104-26v23.2Zm88 91.4a16 16 0 1 1 16-16a16 16 0 0 1-16 16Z"/></svg>Crear Instrumento
                </a>
            </div>         
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTableIns" data-toggle="table" data-search="true" data-pagination="true" data-page-size="5" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 rounded-start">#</th>
                            <th data-field="instrumento" class="border-0">Instrumento</th>
                            <th data-field="colectivo" class="border-0">Colectivo</th>
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyColectivo">
                        @foreach($instrumentos as $instru)
                         <tr>
                            <td>{{$instru->id}}</td>
                            <td>{{$instru->instrumento}}</td>
                            <td>{{$instru->colectivo}}</td>
                            <td>
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarInstrumento" data-id="{{$instru->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                                @canany(['control-total'])
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarInstrumento" data-id="{{$instru->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>
                                @endcanany
                            </td>
                         </tr>
                        @endforeach
                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- MODAL --}}
    <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar10" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-ins">Crear Instrumento</h2>
                    <form action="#" method="" id="instrumentosForm">                        
                        
                        <div class="form-group mb-4">
                            <label for="permiso">Nombre del instrumento *</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 256 256"><path fill="currentColor" d="M215.4 22.5a12.2 12.2 0 0 0-10.3-2.1l-128 32A11.9 11.9 0 0 0 68 64v103.4a38.9 38.9 0 0 0-16-3.4a40 40 0 1 0 40 40v-82.6l104-26v40a38.9 38.9 0 0 0-16-3.4a40 40 0 1 0 40 40V32a12.1 12.1 0 0 0-4.6-9.5ZM52 220a16 16 0 1 1 16-16a16 16 0 0 1-16 16ZM92 96.6V73.4l104-26v23.2Zm88 91.4a16 16 0 1 1 16-16a16 16 0 0 1-16 16Z"/></svg>
                                </span>
                                <input name="instrumento" type="text" class="form-control border-gray-300" placeholder="Ej: Violin, bajo" id="instrumento" autofocus required data-pristine-required-message="Campo Requerido">
                                @error('instrumento') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        <div class="form-group mb-4">
                            <label for="colectivo_id">Colectivo*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="colectivo_id" id="colectivo_id" class=" form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    @foreach($colectivos as $colec)
                                        <option value={{$colec->id}}>{{ $colec->colectivo }}</option>
                                    @endforeach
                                </select>
                                @error('colectivo_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="id" id="idInstrumento">
                            <button type="submit" class="btn btn-primary btnModal-ins">Crear Instrumento</button>
                        </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>
    {{-- <div wire:ignore.self class="modal fade" id="modalPermisos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar3" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo">Permisos del Rol</h2>
                    <p class="text-center mb-4">Permisos Asignados</p>
                    <div id="data-permisos"></div>
                              
                                  
                </div>
            </div>
        </div>
    </div> --}}
</div>
</div>
@push('instrumentos-js')
<script src="{{asset('js/instrumentos.js')}}" type="module"></script>
@endpush


@endsection