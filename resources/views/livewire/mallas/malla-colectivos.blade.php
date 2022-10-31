
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
                <li class="breadcrumb-item"><a href="/mallas/2">Malla</a></li>
                <li class="breadcrumb-item active" aria-current="page">Colectivos</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">{{$malla[0]->programa}}</h1>
                <p class="h5">{{$malla[0]->cualificacion}}-{{$malla[0]->numero_cualificacion}}</p>
                
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal12" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg width="15" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M8 16h12V4h-2v6.125q0 .3-.25.437q-.25.138-.5-.012L15.5 9.5l-1.75 1.05q-.25.15-.5.012q-.25-.137-.25-.437V4H8v12Zm0 2q-.825 0-1.412-.587Q6 16.825 6 16V4q0-.825.588-1.413Q7.175 2 8 2h12q.825 0 1.413.587Q22 3.175 22 4v12q0 .825-.587 1.413Q20.825 18 20 18Zm-4 4q-.825 0-1.412-.587Q2 20.825 2 20V7q0-.425.288-.713Q2.575 6 3 6t.713.287Q4 6.575 4 7v13h13q.425 0 .712.288q.288.287.288.712t-.288.712Q17.425 22 17 22Zm9-18h5ZM8 4h12Z"/></svg>Asignar Colectivo
                </a>
            </div>         
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTableMallaColec" data-toggle="table" data-search="true" data-pagination="true" data-page-size="5" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 rounded-start">#</th>
                            <th data-field="colectivo" class="border-0">Colectivo</th>
                            <th data-field="nivel" class="border-0">Nivel</th>
                            <th data-field="asignaturas">Asignaturas</th>                                 
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyEje">
                        @foreach($malla_detalle as $malla_colec)
                         <tr>

                            <td>{{$malla_colec->id}}</td>
                            <td>{{$malla_colec->colectivo}}</td>                       
                            <td>{{$malla_colec->nivel}}</td>                       
                               <td><a href="/mallas/asignaturas/{{$malla_colec->id}}/2"><button class="btn btn-outline-tertiary" type="button">Ver Asignaturas</button></a></td>                      
                            <td>                        
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarMallaColec" data-id="{{$malla_colec->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                            @canany(['control-total'])
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center quitarColectivo" data-id="{{$malla_colec->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Quitar</button>
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
                    <a href="/mallas/2" class="text-info me-3 float-end"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3.97 12c0 4.41 3.62 8.03 8.03 8.03c4.41 0 8.03-3.62 8.03-8.03c0-4.41-3.62-8.03-8.03-8.03c-4.41 0-8.03 3.62-8.03 8.03M2 12C2 6.46 6.46 2 12 2s10 4.46 10 10s-4.46 10-10 10S2 17.54 2 12m8.46-1V8L6.5 12l3.96 4v-3h7.04v-2"/></svg>Atras</a></div>
        </div>
        

    </div>
    {{-- MODAL --}}
    <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar13" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-mallaColec">Incluir Colectivo</h2>
                    <p class="text-center mb-4">Asigne los respectivos Colectivos a su Respectivo Nivel</p>
                    <form action="#" method="#" id="myFormMallaColec">
                         <div class="row">
                        <div class="form-group mb-2">
                            <label for="descripcion">*Colectivos</label>
                            <div>
                            <div class="input-group">                                
                                <select name="descripcion" id="descripcion" class="form-control form-select select" required data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    @foreach($colectivos as $colect)
                                        <option value={{$colect->id}}>COLECTIVO {{ $colect->colectivo }}</option>
                                    @endforeach
                                </select>
                                @error('descripcion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>                        
                                               
                        <div class="form-group mb-2">
                            <label for="nivel">*Nivel</label>
                            <div class="input-group">                                
                                <select name="nivel" id="nivel" class="form-control form-select select" required required data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    @foreach($niveles as $nivel)
                                    <option value={{$nivel}}>{{ $nivel }}</option>
                                @endforeach                             
                                    
                                </select>
                                @error('nivel') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                        </div> 
                                             
                           
                       
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="malla_id" value="{{$malla[0]->id}}">
                            <input type="hidden" name="id" id="malla_detalle_id">
                            <button type="submit" class="btn btn-primary btnModal-mallaColec">Incluir Asignatura</button>
                        </div>
                    </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>
   
</div>
</div>
@push('mallas-colectivos-js')
<script src="{{asset('js/malla-colectivos.js')}}" type="module"></script>
@endpush


@endsection