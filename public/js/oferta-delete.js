import {initTable,getData,notifications,notyfError} from './general.js';
const permisos = (window.permissions) ? JSON.parse(window.permissions): null; 
const doc = document;


doc.addEventListener("DOMContentLoaded",function(e){
      
        
       
    document.addEventListener('click', (e)=>{
     
      if(e.target.matches('.eliminarOferta')){
        console.log(e.target.dataset.id);
        Swal.fire({
            title: '¿Esta seguro de eliminar este registro?',
            text: "Se Eliminara esta oferta de la base de datos y no habrá manera de recuperarla",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, confirmar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete(`/delete/oferta-academica/${e.target.dataset.id}`).then(function(response){ 
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