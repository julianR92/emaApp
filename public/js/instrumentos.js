import {initTable,getData,notifications,notyfError} from './general.js';
const permisos = (window.permissions) ? JSON.parse(window.permissions): null; 
const doc = document;
doc.addEventListener("DOMContentLoaded",function(e){

      let  dataTable = $('#myTableIns');
      let columnas=[
         {
            field:"id",
            align: 'left'
         },
         {
            field:"instrumento",
            align: 'left'
         },
         {
            field:"colectivo",
            align: 'left'
         },
         {
            formatter: botones
         },
      ];
     
      function botones(value, row, index) {
        if(permisos.includes('control-total')){   
         return [
         '<button type="button" class="btn btn-success d-inline-flex align-items-center editarInstrumento mx-1" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
         '<button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarInstrumento" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>'
         ].join('')
        }else{
            return [
                '<button type="button" class="btn btn-success d-inline-flex align-items-center editarInstrumento mx-1" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
            ].join('')
        }
      }
    
    let $instrumentosForm = doc.getElementById('instrumentosForm');
    let pristine = new Pristine($instrumentosForm);     
     $instrumentosForm.addEventListener('submit',(e)=>{
        e.preventDefault();
        let valid = pristine.validate();
        if(valid){
            let datos = getData(e.target);
            axios.post('/instrumentos',datos)
            .then(function(response){
                if(response.data.success){
                    let myModalEl = document.getElementById('modalSignIn');
                    let modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();                                                       
                    $instrumentosForm.reset();
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                    //  console.log(response.data.datos);
                     initTable(dataTable,columnas,response.data.datos);
                    },2000)

                                    
                }else{                    
                    response.data.errors.forEach((el)=>{
                        notyfError.open({
                            type: 'error',
                            message: el,
                            duration: 8000,
                        });
                    })                
                }
            }).catch(function(error){
                // console.log(error.response);
            });
        }
    }) 
    
    document.addEventListener('click', (e)=>{
    //    console.log(e.target);
      if(e.target.matches('.editarInstrumento')){
        axios.get(`/edit/instrumentos/${e.target.dataset.id}`)
         .then(function(response){
            let myModalEl = new bootstrap.Modal(document.getElementById('modalSignIn'), {
                keyboard: false
              });
              myModalEl.show();                      
              document.querySelector('.titulo-ins').textContent = 'Editar Instrumento';
              document.querySelector('.btnModal-ins').textContent = 'Editar';
              document.getElementById('instrumento').value = response.data.data.instrumento;
              document.getElementById('colectivo_id').value = response.data.data.colectivo_id;
              document.getElementById('idInstrumento').value = response.data.data.id;
           
        }).catch(function(error){
         
        })
      }

      if(e.target.matches('.eliminarInstrumento')){
        
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
                axios.delete(`/delete/instrumentos/${e.target.dataset.id}`).then(function(response){ 
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     location.reload();
                    },2000)

               }).catch(function(error){       
               })
               
            }
        })

       
      }
      
      if(e.target.matches('.btn-modal10')|| e.target.matches('.btn-cerrar10')){
        $instrumentosForm.reset();
        pristine.reset();
        document.querySelector('.titulo-ins').textContent = 'Crear Instrumento';
        document.querySelector('.btnModal-ins').textContent = 'Crear';
      }

      if(e.target.matches('.btnEstado')){

        Swal.fire({
            title: '¿Esta seguro de cambiar el estado del colectivo?',
            text: "Si se desactiva ya no sera visible en la creacion de oferta",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, confirmar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.get(`/activate/colectivos/${e.target.dataset.id}`).then(function(response){ 
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
});