@extends('layouts.main')

@section('content')

<style>
 
</style>

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
                <li class="breadcrumb-item"><a href="/asignaturas">Asignaturas</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$area->name}}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">ASIGNATURAS DE {{$area->name}}</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal11" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M12 3a9 9 0 0 0-9 9H0l4 4l4-4H5c0-3.87 3.13-7 7-7s7 3.13 7 7a6.995 6.995 0 0 1-11.06 5.7L6.5 19.14C8.08 20.34 10 21 12 21a9 9 0 0 0 0-18m4.29 10.19l-1-.74c.01-.15.01-.3 0-.45c.02-.15.02-.3 0-.45l1-.74c.08-.07.11-.19.06-.31L15.44 9a.234.234 0 0 0-.29-.12L14 9.3c-.23-.18-.5-.33-.76-.45l-.17-1.18a.214.214 0 0 0-.21-.17H11.1c-.1 0-.21.08-.23.19l-.17 1.19c-.27.12-.53.25-.77.42l-1.12-.45a.23.23 0 0 0-.28.1l-.9 1.55c-.05.11-.03.22.06.29l1 .76c-.03.3-.03.6 0 .9l-1 .74c-.08.07-.11.19-.06.31l.9 1.5c.05.11.17.16.28.12l1.12-.45c.23.18.49.33.76.45l.18 1.18c.02.11.13.2.23.17h1.8c.1 0 .21-.08.22-.19l.18-1.19c.26-.12.51-.26.75-.42l1.13.45c.1 0 .22 0 .28-.12l.9-1.55c.05-.1.02-.22-.07-.29M12 13.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5s1.5.67 1.5 1.5c0 .82-.66 1.5-1.5 1.5"/></svg>Crear Asignaturas
                </a>
            </div>         
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTableAsi" data-toggle="table" data-search="true" data-pagination="true" data-page-size="5" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 rounded-start">#</th>
                            <th data-field="asignatura" class="border-0">Asignatura</th>
                            <th data-field="codigo" class="border-0">Codigo</th>
                            <th data-field="creditos" class="border-0">Creditos</th>
                            <th data-field="estado" class="border-0">Estado</th>
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyEje">
                        @foreach($asignaturas as $asigna)
                         <tr>

                            <td>{{$asigna->id}}</td>
                            <td>{{$asigna->asignatura}}</td>
                            <td>{{$asigna->codigo}}</td>
                            <td>{{($asigna->creditos)? $asigna->creditos: '-'}}</td>
                            <td> @if($asigna->estado)
                                <button type="button" data-id="{{$asigna->id}}" class="btn btn-success d-inline-flex align-items-center btn-sm btnEstadoAsi" title="activo">
                                    <svg width="16" height="16"   data-id="{{$asigna->id}}" class="btnEstadoAsi" viewBox="0 0 24 24"><path fill="currentColor" d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m7 0c0 .8-.7 1.5-1.5 1.5S14 10.3 14 9.5S14.7 8 15.5 8s1.5.7 1.5 1.5m-5 7.73c-1.75 0-3.29-.73-4.19-1.81L9.23 14c.45.72 1.52 1.23 2.77 1.23s2.32-.51 2.77-1.23l1.42 1.42c-.9 1.08-2.44 1.81-4.19 1.81Z"/></svg></button>                            
                                @else
                                <button type="button"  data-id="{{$asigna->id}}" class="btn btn-danger d-inline-flex align-items-center btn-sm btnEstadoAsi" title="inactivo">
                                <svg width="16" height="16" data-id="{{$asigna->id}}" class="btnEstadoAsi" viewBox="0 0 24 24"><path fill="currentColor" d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10m-6.5-4c.8 0 1.5.7 1.5 1.5s-.7 1.5-1.5 1.5s-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m2 4.5c1.75 0 3.29.72 4.19 1.81l-1.42 1.42C14.32 16.5 13.25 16 12 16s-2.32.5-2.77 1.23l-1.42-1.42C8.71 14.72 10.25 14 12 14Z"/></svg>
                                </button>
                            
                            
                            @endif</td>
                            <td>
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarAsignatura" data-id="{{$asigna->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                            @canany(['control-total'])
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarAsignatura" data-id="{{$asigna->id}}">
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
    <div class="row">
        <div class="d-flex justify-content-end">
            <div class="col-md-2 pr-4">                             
                    <a href="/asignaturas" class="text-info me-3 float-end"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3.97 12c0 4.41 3.62 8.03 8.03 8.03c4.41 0 8.03-3.62 8.03-8.03c0-4.41-3.62-8.03-8.03-8.03c-4.41 0-8.03 3.62-8.03 8.03M2 12C2 6.46 6.46 2 12 2s10 4.46 10 10s-4.46 10-10 10S2 17.54 2 12m8.46-1V8L6.5 12l3.96 4v-3h7.04v-2"/></svg>Atras</a></div>
            </div>       
    </div>
    {{-- MODAL --}}
    <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar11" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-asi">Crear Asignatura</h2>
                    <p class="text-center mb-4">Las asignaturas van asociadas a un programa academico</p>
                    <form action="#" method="#" id="myAsignForm">
                         

                        <div class="row">                        
                        <div class="form-group mb-3">
                            <label for="asignatura">Nombre Asignatura*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M12 3a9 9 0 0 0-9 9H0l4 4l4-4H5c0-3.87 3.13-7 7-7s7 3.13 7 7a6.995 6.995 0 0 1-11.06 5.7L6.5 19.14C8.08 20.34 10 21 12 21a9 9 0 0 0 0-18m4.29 10.19l-1-.74c.01-.15.01-.3 0-.45c.02-.15.02-.3 0-.45l1-.74c.08-.07.11-.19.06-.31L15.44 9a.234.234 0 0 0-.29-.12L14 9.3c-.23-.18-.5-.33-.76-.45l-.17-1.18a.214.214 0 0 0-.21-.17H11.1c-.1 0-.21.08-.23.19l-.17 1.19c-.27.12-.53.25-.77.42l-1.12-.45a.23.23 0 0 0-.28.1l-.9 1.55c-.05.11-.03.22.06.29l1 .76c-.03.3-.03.6 0 .9l-1 .74c-.08.07-.11.19-.06.31l.9 1.5c.05.11.17.16.28.12l1.12-.45c.23.18.49.33.76.45l.18 1.18c.02.11.13.2.23.17h1.8c.1 0 .21-.08.22-.19l.18-1.19c.26-.12.51-.26.75-.42l1.13.45c.1 0 .22 0 .28-.12l.9-1.55c.05-.1.02-.22-.07-.29M12 13.5c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5s1.5.67 1.5 1.5c0 .82-.66 1.5-1.5 1.5"/></svg>
                                </span>
                                <input name="asignatura" type="text" class="form-control border-gray-300" placeholder="Ej: Teoría del Color" id="asignatura" autofocus required data-pristine-required-message="Campo Requerido">
                                @error('asignatura') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div>
                        
                        <div class="form-group mb-3 col-md-6">
                            <label for="codigo">Codigo*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M13 21v-2h2v2Zm-2-2v-5h2v5Zm8-3v-4h2v4Zm-2-4v-2h2v2ZM5 14v-2h2v2Zm-2-2v-2h2v2Zm9-7V3h2v2ZM4.5 7.5h3v-3h-3ZM3 9V3h6v6Zm1.5 10.5h3v-3h-3ZM3 21v-6h6v6ZM16.5 7.5h3v-3h-3ZM15 9V3h6v6Zm2 12v-3h-2v-2h4v3h2v2Zm-4-7v-2h4v2Zm-4 0v-2H7v-2h6v2h-2v2Zm1-5V5h2v2h2v2ZM5.25 6.75v-1.5h1.5v1.5Zm0 12v-1.5h1.5v1.5Zm12-12v-1.5h1.5v1.5Z"/></svg>
                                </span>
                                <input name="codigo" type="text" class="form-control border-gray-300" placeholder="Ej: ART-TL-1S-002" id="codigo" required data-pristine-required-message="Campo Requerido" onkeyup="aMayusculas(this.value,this.id)" onkeypress="return NumDoc(event)">
                                @error('codigo') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        
                        <div class="form-group mb-3 col-md-6">
                            <label for="permiso">Creditos*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="m6 20l1-4H3l.5-2h4l1-4h-4L5 8h4l1-4h2l-1 4h4l1-4h2l-1 4h4l-.5 2h-4l-1 4h4l-.5 2h-4l-1 4h-2l1-4H9l-1 4Zm3.5-6h4l1-4h-4Z"/></svg>
                                </span>
                                <input name="creditos" type="text" class="form-control border-gray-300" placeholder="Ej: 10" id="creditos" autofocus onkeypress="return Numeros(event)">
                                @error('creditos') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                        </div> 
                        
                        
                        <div class="form-group mb-4">
                            <label for="asig_padre_id">Asignatura de Requisito*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="asig_padre_id" id="asig_padre_id" class="form-control form-select  select" required data-pristine-required-message="Campo Requerido">
                                    <option value="9999" selected>No Tiene Requisito</option>
                                    @foreach($asignaturas as $asign)
                                        <option value={{$asign->id}}>{{ $asign->asignatura }}</option>
                                    @endforeach
                                </select>
                                @error('asig_padre_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                        
                        </div>
                       
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="area_id" value="{{$area->id}}">                         
                            <input type="hidden" name="id" id="idAsignatura">
                            <button type="submit" class="btn btn-primary btnModal-asi">Crear Asignaturas</button>
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
@push('asignaturas-js')
<script src="{{asset('js/asignaturas.js')}}" type="module"></script>
@endpush



@endsection