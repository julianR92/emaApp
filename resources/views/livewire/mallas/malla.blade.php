
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
                <li class="breadcrumb-item"><a href="/mallas">Mallas</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$area->name}}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h1 class="h4">MALLA DE {{$area->name}}</h1>
            </div>   
            <div>
                <a type="button" href="" class="btn btn-outline-gray-600 d-inline-flex align-items-center btn-modal8" data-bs-toggle="modal" data-bs-target="#modalSignIn">
                    <svg width="16" height="16" viewBox="0 0 512 512"><path d="M507.58 195.042c-1.814-5.797-7.983-9.028-13.784-7.211l-9.865 3.088c-12.256-5.924-69.997-34.516-116.526-69.161c-52.022-38.738-100.966-93.2-101.454-93.746c-.289-.323-.951-.619-.951-.9v-4.618c0-6.075-4.926-11-11-11c-6.075 0-11 4.925-11 11v4.991c0 .173-.316.341-.483.528c-.487.545-49.314 54.964-101.395 93.744c-45.754 34.069-102.454 62.336-115.908 68.867l-8.877-2.79c-5.8-1.821-11.968 1.403-13.789 7.198c-1.82 5.796 1.404 11.97 7.199 13.791l10.651 3.345c8.141 14.667 37.413 68.957 54.983 121.891c17.42 52.48 26.431 113.018 28.764 130.184c-.08.24-.15.483-.213.73l-7.275 10.118c-3.546 4.933-2.423 11.807 2.51 15.353a10.951 10.951 0 0 0 6.412 2.07c3.42 0 6.791-1.591 8.94-4.579l7.572-10.532c17.684-3.449 77.193-14.23 131.981-14.667c54.203-.434 113.342 9.214 131.689 12.47l9.109 12.655a10.987 10.987 0 0 0 8.937 4.575a10.95 10.95 0 0 0 6.417-2.073c4.931-3.549 6.051-10.424 2.502-15.354l-3.357-4.664c.109-.439.201-.885.256-1.345c.087-.727 8.953-73.385 29.386-134.942c18.29-55.104 49.325-111.787 55.894-123.523l5.461-1.709c5.8-1.815 9.029-7.987 7.214-13.784zm-153.352-55.64c34.872 25.966 74.873 48.181 99.48 60.97l-38.652 12.101a10.95 10.95 0 0 0-1.448-.171c-.113-.059-.217-.125-.333-.18c-.446-.212-45.023-21.517-79.95-47.783s-67.804-63.181-68.131-63.551c-.05-.056-.195-.104-.195-.159V59.244c19.001 19.672 52.953 53.146 89.229 80.158zM147.187 306.366c-7.795-23.076-18.489-46.063-26.98-62.849l31.982 10.046c4.125 7.459 14.721 27.406 21.3 46.884c6.944 20.556 10.664 44.372 11.686 51.538l-20.046 27.88c-3.281-18.91-9.089-47.29-17.942-73.499zm47.144-12.961c-3.644-10.789-8.325-21.54-12.641-30.576l55.135 17.318l-33.676 46.836c-2.073-10.151-4.973-22.194-8.818-33.578zM265 198.251c8 7.565 17.628 16.594 27.971 24.371c9.617 7.233 20.141 13.772 29.138 18.929L265 259.42v-61.169zm-22 60.801l-54.882-17.251c9.091-5.194 19.802-11.831 29.574-19.179c9.212-6.928 18.308-14.849 25.308-21.843v58.273zm11.646 33.998l33.635 46.728c-9.655-1.081-20.808-1.944-31.684-1.909c-12.619.057-25.586 1.336-36.153 2.749l34.202-47.568zm60.989.355c-3.932 11.641-6.878 23.977-8.96 34.269l-34.202-47.515l55.881-17.491c-4.338 9.07-9.053 19.883-12.719 30.737zm35.952-61.063c-6.37-3.155-27.89-14.169-45.355-27.303c-20.582-15.479-40.054-37.314-40.246-37.531c-.299-.338-.986-.645-.986-.937v-33.842c13 13.698 33.651 33.089 55.065 49.193c22.162 16.666 47.376 31.112 64.302 40.154l-32.78 10.266zM243 169.334c-5 5.569-21.348 22.798-38.511 35.705c-17.85 13.424-40.022 24.683-45.775 27.52l-32.726-10.282c16.927-9.027 42.299-23.565 64.624-40.354C210.683 166.829 230 148.849 243 135.373v33.961zm-40.732 196.563c2.711-.549 29.867-5.918 54.429-6.029c19.093-.073 39.841 3.01 49.377 4.626l20.084 27.901c-18.565-2.698-45.018-5.705-70.687-5.705c-.486 0-.974.001-1.459.003c-25.696.116-52.315 3.325-71.159 6.208l19.415-27.004zm142.455 14.635l-20.031-27.829c.854-6.136 4.589-30.947 11.787-52.257c6.6-19.54 17.296-39.644 21.372-47.011l31.952-10.001c-8.498 16.793-19.215 39.818-27.023 62.933c-8.957 26.516-14.799 55.261-18.057 74.165zm-190.482-241.13C190.269 112.575 224 79.374 243 59.65v43.842c-8 9.006-36.123 38.676-65.605 60.847c-34.927 26.266-79.486 47.57-79.932 47.783c-.115.055-.21.121-.322.179c-.773-.021-1.545.04-2.317.186L55.341 200.09c24.649-12.833 64.285-34.913 98.9-60.688zM50.448 221.606l39.902 12.533c7.042 12.751 24.903 46.434 35.993 79.268c13.985 41.402 20.232 90.414 20.294 90.904c.043.347.103.688.177 1.022l-24.193 33.648c-4.488-27.516-12.946-71.445-26.359-111.853c-13.432-40.468-32.958-80.793-45.814-105.522zm203.45 219.129c-42.03.336-85.756 6.349-113.319 10.956l23.95-33.309c11.219-2.164 52.065-9.521 89.579-9.689c.446-.002.891-.003 1.337-.003c37.777 0 78.703 7.105 88.915 8.994l23.194 32.222c-27.619-4.171-71.524-9.509-113.656-9.171zm164.236-113.607c-14.375 43.307-23.06 90.659-27.264 117.514l-27.875-38.726a10.98 10.98 0 0 0 .334-1.607c.062-.489 6.285-49.431 20.294-90.902c11.103-32.873 28.993-66.597 36.018-79.314l45.167-14.138c-12.832 24.559-32.939 65.792-46.674 107.173z"/></svg>Crear Malla
                </a>
            </div>         
        </div>
    </div>
     
    
    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded" id="myTableMal" data-toggle="table" data-search="true" data-pagination="true" data-page-size="5" >
                    <thead class="thead-light">
                        <tr>
                            <th data-field="id" data-sortable="true" class="border-0 rounded-start">#</th>
                            <th data-field="programa" class="border-0">Nombre Programa</th>
                            <th data-field="area_id" class="border-0 d-none">area_id</th>
                            <th data-field="cualificacion" class="border-0">Cualificación</th>
                            <th data-field="resolucion" class="border-0">Resolución</th>                                                  
                            <th data-field="asignacion" class="border-0">Asignación</th>   
                            
                           
                            <th class="border-0">Acciones</th>
                           
                        </tr>
                    </thead>
                    <tbody id="tbodyEje">
                        @foreach($mallas as $mall)
                         <tr>

                            <td>{{$mall->id}}</td>
                            <td>{{$mall->programa}}</td>
                            <td class="d-none">{{$mall->area_id}}</td>
                            <td>{{$mall->cualificacion}}{{($mall->numero_cualificacion)?'-'.$mall->numero_cualificacion: ' '}}</td>
                            <td>{{$mall->resolucion}}</td>  
                            @if($mall->cualificacion=='CICLO')                           
                            <td><a  href="/mallas/colectivos/{{$mall->id}}"><button class="btn btn-outline-tertiary" type="button">Ver Colectivos</button></a></td> 
                            @elseif($mall->cualificacion=='SEMESTRE')
                            <td><a href="/mallas/asignaturas/{{$mall->id}}/{{$area->id}}"><button class="btn btn-outline-tertiary" type="button">Ver Asignaturas</button></a></td> 
                            @else
                            <td>NINGUNA</td>
                            @endif
                           
                            <td>                        
                            <button type="button" class="btn btn-success d-inline-flex align-items-center editarMalla" data-id="{{$mall->id}}">
                                <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                            @canany(['control-total'])
                            <button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarMalla" data-id="{{$mall->id}}">
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
                    <a href="/mallas" class="text-info me-3 float-end"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3.97 12c0 4.41 3.62 8.03 8.03 8.03c4.41 0 8.03-3.62 8.03-8.03c0-4.41-3.62-8.03-8.03-8.03c-4.41 0-8.03 3.62-8.03 8.03M2 12C2 6.46 6.46 2 12 2s10 4.46 10 10s-4.46 10-10 10S2 17.54 2 12m8.46-1V8L6.5 12l3.96 4v-3h7.04v-2"/></svg>Atras</a></div>
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
                    <h2 class="h4 text-center titulo-mal">Crear Malla</h2>
                    <p class="text-center mb-4">Las Mallas son la base de Escuela Municipal de Artes</p>
                    <form action="#" method="POST" id="myForMalla">
                         <div class="row">
                        <div class="form-group mb-2">
                            <label for="programa_id">Programa*</label>
                            <div>
                            <div class="input-group">                                
                                <select name="programa_id" id="programa_id" class="form-control form-select select" required data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    @foreach($programas as $programa)
                                        <option value={{$programa->id}}>{{ $programa->programa }}</option>
                                    @endforeach
                                </select>
                                @error('programa_id') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                            </div>
                        </div>
                         
                        
                        <div class="form-group mb-2 col-md-8">
                            <label for="cualificacion">Cualificacion*</label>
                            <div class="input-group">                                
                                <select name="cualificacion" id="cualificacion" class="form-control form-select select" required data-pristine-required-message="Campo Requerido">
                                    <option value="">Seleccione..</option>
                                    @foreach($cualificacion as $cuali)
                                        <option value={{$cuali}}>{{ $cuali }}</option>
                                    @endforeach
                                </select>
                                @error('cualificacion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                        </div> 
                        <div class="form-group mb-2 col-md-4 d-none div-cuali">
                            <label for="numero_cualificacion">*Numero</label>
                            <div class="input-group">                                
                                <select name="numero_cualificacion" id="numero_cualificacion" class="form-control form-select select">
                                    <option value="">Seleccione..</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    
                                </select>
                                @error('numero_cualificacion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div>
                        </div> 
                        
                       
                        <div class="form-group mb-2">
                            <label for="resolucion">Resolucion*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M9 12h3m3 0h-3m0 0V9m0 3v3m-8 6.4V2.6a.6.6 0 0 1 .6-.6h11.652a.6.6 0 0 1 .424.176l3.148 3.148A.6.6 0 0 1 20 5.75V21.4a.6.6 0 0 1-.6.6H4.6a.6.6 0 0 1-.6-.6Z"/><path d="M16 2v3.4a.6.6 0 0 0 .6.6H20"/></g></svg>
                                </span>
                                <input name="resolucion" id="resolucion" type="text" class="form-control border-gray-300" required data-pristine-required-message="Campo Requerido">
                                @error('resolucion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                            
                        </div>
                        <div class="form-group mb-2">
                            <label for="duracion">Duracion*</label>
                            <div class="input-group">
                                <span class="input-group-text border-gray-300" id="basic-addon3">
                                    <svg width="16" height="16" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 12a6 6 0 0 0 6-6H6a6 6 0 0 0 6 6Zm0 0a6 6 0 0 1 6 6H6a6 6 0 0 1 6-6ZM6 3h12M6 21h12"/></svg>
                                </span>
                                <input name="duracion" id="duracion" type="text" class="form-control border-gray-300" placeholder="Duracion en dias-semestres" required data-pristine-required-message="Campo Requerido">
                                @error('duracion') <div class="invalid-feedback"> {{ $message }} </div> @enderror 
                            </div> 
                            
                        </div>
                        <div class="form-group mb-3">
                            <label for="horas">Horas del Programa*</label>
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
                            <input type="hidden" name="area_id" value="{{$area->id}}">
                            <input type="hidden" name="id" id="idMalla">
                            <input type="hidden" name="anterior_cualificacion" id="anterior_cualificacion">
                            <button type="submit" class="btn btn-primary btnModal-mal">Crear Programa</button>
                        </div>
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



@endsection