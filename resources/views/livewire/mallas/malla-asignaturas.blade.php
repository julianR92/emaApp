
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
                <li class="breadcrumb-item"><a href="/mallas/{{$malla_programa[0]->area_id}}">Malla</a></li>
                <li class="breadcrumb-item active" aria-current="page">Asignaturas</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">{{$malla_programa[0]->nombre_programa}} </h1>
                <p class="h5">{{$malla_programa[0]->descripcion}}</p>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal12" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M5 21q-.825 0-1.413-.587Q3 19.825 3 19V5q0-.825.587-1.413Q4.175 3 5 3h4.2q.325-.9 1.088-1.45Q11.05 1 12 1t1.713.55Q14.475 2.1 14.8 3H19q.825 0 1.413.587Q21 4.175 21 5v6.7q-.475-.225-.975-.388q-.5-.162-1.025-.237V5H5v14h6.05q.075.55.238 1.05q.162.5.387.95Zm0-3v1V5v6.075V11v7Zm3-1h3.075q.075-.525.237-1.025q.163-.5.363-.975H8q-.425 0-.713.287Q7 15.575 7 16t.287.712Q7.575 17 8 17Zm0-4h5.1q.8-.75 1.787-1.25q.988-.5 2.113-.675V11H8q-.425 0-.713.287Q7 11.575 7 12t.287.712Q7.575 13 8 13Zm0-4h8q.425 0 .712-.288Q17 8.425 17 8t-.288-.713Q16.425 7 16 7H8q-.425 0-.713.287Q7 7.575 7 8t.287.712Q7.575 9 8 9Zm4-4.75q.325 0 .538-.213q.212-.212.212-.537q0-.325-.212-.538q-.213-.212-.538-.212q-.325 0-.537.212q-.213.213-.213.538q0 .325.213.537q.212.213.537.213ZM18 23q-2.075 0-3.537-1.462Q13 20.075 13 18q0-2.075 1.463-3.538Q15.925 13 18 13t3.538 1.462Q23 15.925 23 18q0 2.075-1.462 3.538Q20.075 23 18 23Zm-.5-4.5v2q0 .2.15.35q.15.15.35.15q.2 0 .35-.15q.15-.15.15-.35v-2h2q.2 0 .35-.15q.15-.15.15-.35q0-.2-.15-.35q-.15-.15-.35-.15h-2v-2q0-.2-.15-.35Q18.2 15 18 15q-.2 0-.35.15q-.15.15-.15.35v2h-2q-.2 0-.35.15q-.15.15-.15.35q0 .2.15.35q.15.15.35.15Z"/></svg>Incluir Asignatura
                </a>
            </div>         
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTableAsignaMall" data-toggle="table" data-search="true" data-pagination="true" data-page-size="5" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 rounded-start">#</th>
                            <th data-field="asignatura" class="border-0">Asignatura</th>
                            <th data-field="codigo" class="border-0">Codigo</th>                                 
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyEje">
                        @foreach($malla_detalleAsigna as $asigna_mallas)
                         <tr>

                            <td>{{$asigna_mallas->id}}</td>
                            <td>{{$asigna_mallas->asignatura}}</td>                        
                           <td>{{$asigna_mallas->codigo}}</td>  
                                                    
                            <td>                        
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarAsignatura" data-id="{{$asigna_mallas->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                            @canany(['control-total'])
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center quitarAsignatura" data-id="{{$asigna_mallas->id}}">
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
                    <a href="/mallas/{{$malla_programa[0]->area_id}}" class="text-info me-3 float-end"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3.97 12c0 4.41 3.62 8.03 8.03 8.03c4.41 0 8.03-3.62 8.03-8.03c0-4.41-3.62-8.03-8.03-8.03c-4.41 0-8.03 3.62-8.03 8.03M2 12C2 6.46 6.46 2 12 2s10 4.46 10 10s-4.46 10-10 10S2 17.54 2 12m8.46-1V8L6.5 12l3.96 4v-3h7.04v-2"/></svg>Atras</a></div>
        </div>
        

    </div>
    {{-- MODAL --}}
    <div class="modal fade" id="modalSignIn" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-cerrar12" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-md-5">
                    <h2 class="h4 text-center titulo-mallaAsigna">Incluir Asignatura</h2>
                    <p class="text-center mb-4">Las asignaturas se deben incluir a los programas</p>
                    <form action="#" method="#" id="myFormMallaAsigna">
                         <div class="row">
                        <div class="form-group mb-2">
                            <label for="asignatura_id">Asignatura*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="asignatura_id" id="asignatura_id" class="form-control form-select select" required data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    @foreach($asignaturas as $asigna)
                                        <option value={{$asigna->id}}>{{ $asigna->asignatura }} - {{$asigna->codigo}}</option>
                                    @endforeach
                                </select>
                                @error('asignatura_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>                        
                                               
                        <div class="form-group mb-2 col-md-6">
                            <label for="modalidad">*Modalidad</label>
                            <div class="input-group">                                
                                <select name="modalidad" id="modalidad" class="form-control form-select select" required required data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    <option value="PRESENCIAL">PRESENCIAL</option>
                                    <option value="VIRTUAL">VIRTUAL</option>
                                    <option value="MIXTA">MIXTA</option>                                
                                    
                                </select>
                                @error('modalidad') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                        </div> 
                                             
                            <div class="form-group mb-3 col-md-6">
                            <label for="horas">Horas a la semana*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M14.55 16.55L11 13V8h2v4.175l2.95 2.95ZM11 6V4h2v2Zm7 7v-2h2v2Zm-7 7v-2h2v2Zm-7-7v-2h2v2Zm8 9q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Zm0-2q3.35 0 5.675-2.325Q20 15.35 20 12q0-3.35-2.325-5.675Q15.35 4 12 4Q8.65 4 6.325 6.325Q4 8.65 4 12q0 3.35 2.325 5.675Q8.65 20 12 20Zm0-8Z"/></svg>
                                </span>
                                <input name="horas" id="horas" type="text" class="form-control border-gray-300" placeholder="Duracion en Horas" data-pristine-type="integer" required data-pristine-required-message="Campo Requerido">
                                @error('horas') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                            
                        </div>
                       
                        <!-- End of Form -->                        
                        <div class="d-grid">
                            <input type="hidden" name="malla_detalle_id" value="{{$malla_programa[0]->detalle_id}}">
                            <input type="hidden" name="id" id="id_malla_asignatura">
                            <button type="submit" class="btn btn-primary btnModal-mallaAsigna">Incluir Asignatura</button>
                        </div>
                    </div>
                   </form>          
                                  
                </div>
            </div>
        </div>
    </div>
   
</div>
</div>
@push('mallas-asignaturas-js')
<script src="{{asset('js/malla-asignaturas.js')}}" type="module"></script>
@endpush


@endsection