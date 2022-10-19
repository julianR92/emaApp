import {initTable,getData,notifications,notyfError} from './general.js';
const permisos = (window.permission)? JSON.parse(window.permission): null;
const doc = document;
const $divCuali = document.querySelector('.div-cuali');
const $input = document.getElementById('cantidad_cualificacion');
doc.addEventListener("DOMContentLoaded",function(e){
  
  
      let  dataTable = $('#myTableMal');
      let columnas=[
         {
            field:"id",
            align: 'left'
         },
         {
            field:"programa",
            align: 'left'
         },
         {
            field:"area_id",
            align: 'left'
         },
         {
            formatter:cualificacion
         },
         {
            field:"resolucion",
            align: 'left'
         },
         {
            formatter: asignacion
         },
         {
            formatter: botones
         },
      ];
     
      function botones(value, row, index) {
        if(permisos.includes('control-total')){    
         return [
         '<button type="button" class="btn btn-success d-inline-flex align-items-center editarMalla mx-1" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
         '<button type="button" class="btn btn-danger d-inline-flex align-items-center eliminarMalla" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>'
         ].join('')
        }else{
            return [
                '<button type="button" class="btn btn-success d-inline-flex align-items-center editarMalla mx-1" data-id="'+row.id+'"><svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button> ',
                 ].join('')
        }
      }
      function asignacion(value, row, index) {
        if(row.cualificacion=='CICLO'){
         return [
            `<a  href="/mallas/colectivos/${row.id}"><button class="btn btn-outline-tertiary" type="button">Ver Colectivos</button></a>`
       
         ].join('')
        }else if(row.cualificacion=='SEMESTRE'){
            return [
             `<a href="/mallas/asignaturas/${row.id}/${row.area_id}"><button class="btn btn-outline-tertiary" type="button">Ver Asignaturas</button></a>`
            ].join('')
        }else{
            return 'NINGUNA'
        }
      }
      function cualificacion(value,row,index){
        if(row.numero_cualificacion){
            return `${row.cualificacion}-${row.numero_cualificacion}`
        }else{
            return row.cualificacion;
        }
      }
  
    
    let $forMalla = document.getElementById('myForMalla');
    const pristineF = new Pristine($forMalla);     
     $forMalla.addEventListener('submit',(e)=>{
        e.preventDefault();
        let valid = pristineF.validate();  
        // console.log(valid);      
        if(valid){
            let datos = getData(e.target);
            // console.log(datos);
            axios.post('/mallas',datos)
            .then(function(response){
                console.log(response);
                if(response.data.success){
                    let myModalEl = document.getElementById('modalSignIn');
                    let modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();                                                       
                    $forMalla.reset();
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                        initTable(dataTable,columnas,response.data.datos);
                    },2000)
                    $divCuali.classList.add('d-none');
                    $input.setAttribute ('required',false);     
                    $input.removeAttribute("data-pristine-required-message");
                    $input.value = ""; 

                                    
                }else{                    
                //    console.log(response.data)
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
      if(e.target.matches('.editarMalla')){
        axios.get(`/edit/malla/${e.target.dataset.id}`)
         .then(function(response){
            //  console.log(response.data.data)
            let myModalEl = new bootstrap.Modal(document.getElementById('modalSignIn'), {
                keyboard: false
              });
              myModalEl.show();
              (response.data.data.numero_cualificacion) ?$divCuali.classList.remove('d-none'):$divCuali.classList.add('d-none');
              document.querySelector('.titulo-mal').textContent = 'Editar Malla';
              document.querySelector('.btnModal-mal').textContent = 'Editar';
              document.getElementById('programa_id').value = response.data.data.programa_id;
              document.getElementById('cualificacion').value = response.data.data.cualificacion;
              document.getElementById('numero_cualificacion').value = response.data.data.numero_cualificacion;
              document.getElementById('resolucion').value = response.data.data.resolucion;
              document.getElementById('duracion').value = response.data.data.duracion;
              document.getElementById('horas').value = response.data.data.horas;
              document.getElementById('idMalla').value = response.data.data.id;
              document.getElementById('anterior_cualificacion').value = response.data.data.cualificacion;
           
        }).catch(function(error){
         
        })
      }

      if(e.target.matches('.eliminarMalla')){
        console.log(e.target.dataset.id);
        Swal.fire({
            title: '¿Esta seguro de eliminar este registro?',
            text: "Se Eliminara todo el detalle de esta oferta tanto asignaturas, colectivos ETC",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, confirmar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/delete/malla/${e.target.dataset.id}`).then(function(response){ 
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     location.reload();
                    },2000)

               }).catch(function(error){       
               })
               
            }
        })

       
      }
      
      if(e.target.matches('.btn-modal8')|| e.target.matches('.btn-cerrar8')){
        $forMalla.reset();
        pristineF.reset();
        document.querySelector('.titulo-mal').textContent = 'Crear Malla';
        $divCuali.classList.add('d-none');
        $input.setAttribute ('required',false);     
        $input.removeAttribute("data-pristine-required-message");
        $input.value = "";              
        document.querySelector('.btnModal-mal').textContent = 'Crear Malla';
      }

      if(e.target.matches('.btnEstado')){

        Swal.fire({
            title: '¿Esta seguro de cambiar el estado del programa?',
            text: "Si se desactiva ya no sera visible en la creacion de oferta",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, confirmar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.get(`/activate/programa/${e.target.dataset.id}`).then(function(response){ 
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
        if(e.target.matches('#cualificacion')){
            if(e.target.value == 'SEMESTRE'|| e.target.value=='CICLO'){
                 $divCuali.classList.remove('d-none');   
                 $input.setAttribute ('required',true);               
                 $input.setAttribute('data-pristine-required-message', 'Campo Requerido')                
                }else{
               $divCuali.classList.add('d-none');
               $input.setAttribute ('required',false);     
               $input.removeAttribute("data-pristine-required-message");
               $input.value = "";              
            

           }


        }
    
    
    })      
});