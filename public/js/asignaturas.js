import {initTable,getData,notifications,notyfError} from './general.js';
const permisos = (window.permissions) ? JSON.parse(window.permissions): null; 
const doc = document;
doc.addEventListener("DOMContentLoaded",function(e){
  
  
   


      let  dataTable = $('#myTableAsi');
      let columnas=[
         {
            field:"id",
            align: 'left'
         },
         {
            field:"asignatura",
            align: 'left'
         },
         {
            field:"codigo",
            align: 'left'
         },
         {
            field:"creditos",
            align: 'left'
         },
         {
            formatter: estado
         },
         {
            formatter: botones
         },
      ];
     
      function botones(value, row, index) {
        if(permisos.includes('control-total')){   
         return [
         '<button type="button" class="btn btn-success d-inline-flex align-items-center editarAsignatura mx-1" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
         '<button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarAsignatura" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>'
         ].join('')
        }else{
            return [
                '<button type="button" class="btn btn-success d-inline-flex align-items-center editarAsignatura mx-1" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
            ].join('')
        }
      }
      function estado(value, row, index) {
        
         return [
            (row.estado) ? '<button type="button" data-id="'+row.id+'" class="btn btn-success d-inline-flex align-items-center btn-sm btnEstadoAsi" title="activo"><svg width="16" height="16" data-id="'+row.id+'" class="btnEstadoAsi" viewBox="0 0 24 24"><path fill="currentColor" d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m7 0c0 .8-.7 1.5-1.5 1.5S14 10.3 14 9.5S14.7 8 15.5 8s1.5.7 1.5 1.5m-5 7.73c-1.75 0-3.29-.73-4.19-1.81L9.23 14c.45.72 1.52 1.23 2.77 1.23s2.32-.51 2.77-1.23l1.42 1.42c-.9 1.08-2.44 1.81-4.19 1.81Z"/></svg></button>' :
            ` <button type="button" data-id="${row.id}}" class="btn btn-danger d-inline-flex align-items-center btn-sm btnEstadoAsi" title="inactivo">
            <svg width="16" height="16" data-id="${row.id}}" class="btnEstadoAsi" viewBox="0 0 24 24"><path fill="currentColor" d="M20 12a8 8 0 0 0-8-8a8 8 0 0 0-8 8a8 8 0 0 0 8 8a8 8 0 0 0 8-8m2 0a10 10 0 0 1-10 10A10 10 0 0 1 2 12A10 10 0 0 1 12 2a10 10 0 0 1 10 10m-6.5-4c.8 0 1.5.7 1.5 1.5s-.7 1.5-1.5 1.5s-1.5-.7-1.5-1.5s.7-1.5 1.5-1.5M10 9.5c0 .8-.7 1.5-1.5 1.5S7 10.3 7 9.5S7.7 8 8.5 8s1.5.7 1.5 1.5m2 4.5c1.75 0 3.29.72 4.19 1.81l-1.42 1.42C14.32 16.5 13.25 16 12 16s-2.32.5-2.77 1.23l-1.42-1.42C8.71 14.72 10.25 14 12 14Z"/></svg>
            </button>`
       
         ].join('')
      }
  
    
    let $formAsign = doc.getElementById('myAsignForm');
    let pristine = new Pristine($formAsign);
    $formAsign.addEventListener('submit',(e)=>{
        e.preventDefault();
        let valid = pristine.validate();
        if(valid){
            let datos = getData(e.target);
            console.log(datos);
            axios.post('/asignaturas',datos)
            .then(function(response){
                console.log(response);
                if(response.data.success){
                    let myModalEl = document.getElementById('modalSignIn');
                    let modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();                                                       
                    $formAsign.reset();
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     initTable(dataTable,columnas,response.data.datos);
                    },2000)

                                    
                }else{                    
                   console.log(response.data)
                    response.data.errors.forEach((el)=>{
                        notyfError.open({
                            type: 'error',
                            message: el,
                            duration: 8000,
                        });
                    })                
                }
            }).catch(function(error){
                console.log(error.response);
            });
        }
    }) 
    
    document.addEventListener('click', (e)=>{
      if(e.target.matches('.editarAsignatura')){
        axios.get(`/edit/asignatura/${e.target.dataset.id}`)
         .then(function(response){
             console.log(response.data)
            let myModalEl = new bootstrap.Modal(document.getElementById('modalSignIn'), {
                keyboard: false
              });
              myModalEl.show();
              document.querySelector('.titulo-asi').textContent = 'Editar Asignatura';
              document.querySelector('.btnModal-asi').textContent = 'Editar';
              document.getElementById('asignatura').value = response.data.data.asignatura;
              document.getElementById('codigo').value = response.data.data.codigo;
              document.getElementById('creditos').value = response.data.data.creditos;
              document.getElementById('asig_padre_id').value = response.data.data.asig_padre_id || 9999;
              document.getElementById('idAsignatura').value = response.data.data.id;
           
        }).catch(function(error){
         
        })
      }

      if(e.target.matches('.eliminarAsignatura')){
        console.log(e.target.dataset.id);
        Swal.fire({
            title: '¿Esta seguro de eliminar este registro?',
            text: "Se Eliminara este registro de la base de datos",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, confirmar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/delete/asignatura/${e.target.dataset.id}`).then(function(response){ 
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     location.reload();
                    },2000)

               }).catch(function(error){       
               })
               
            }
        })

       
      }
      
      if(e.target.matches('.btn-modal11')|| e.target.matches('.btn-cerrar11')){
        $formAsign.reset();
        pristine.reset();
        document.querySelector('.titulo-asi').textContent = 'Crear Asignatura';
        document.querySelector('.btnModal-asi').textContent = 'Crear';
      }

      if(e.target.matches('.btnEstadoAsi')){

        Swal.fire({
            title: '¿Esta seguro de cambiar el estado de la asignatura?',
            text: "Si se desactiva ya no sera visible en la creacion de las mallas",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, confirmar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.get(`/activate/asignatura/${e.target.dataset.id}`).then(function(response){ 
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     location.reload();
                    },2000)

               }).catch(function(error){       
               })
               
            }
        })
         
      }

    });
    document.addEventListener('change',(e)=>{
       
    
    
    })      
});