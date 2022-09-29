// DATATABLES
const doc = document;
doc.addEventListener("DOMContentLoaded",function(e){

      Livewire.on('toast', function(e) {
        let myModalEl = document.getElementById('modalSignIn');
        let modal = bootstrap.Modal.getInstance(myModalEl)
        modal.hide();
        Swal.fire({
            title: e.title,
            text: e.text,
            icon: e.icon,
            toast:true,
            timer: 7000,                        
            showConfirmButton: false,
            timerProgressBar: true,
            position: 'top-right',
            
        });
       
        
    })  

    Livewire.on('toast-info', function(e) {
        
        Swal.fire({
            title: e.title,
            text: e.text,
            icon: e.icon,
            toast:true,
            timer: 7000,                        
            showConfirmButton: false,
            timerProgressBar: true,
            position: 'top-right',
            
        });
       
        
    }) 

    //

    doc.addEventListener('edit-modal', event =>{
      
        let myModalEl = new bootstrap.Modal(document.getElementById(event.detail.idModal), {
            keyboard: false
          });
          myModalEl.show();
        
    });

    doc.addEventListener('click', (e)=>{
        if(e.target.matches('.btn-modal')|| e.target.matches('.btn-close')){
            Livewire.emitTo('permission', 'limpiarCampos');
        }
        if(e.target.matches('.btn-modal2')|| e.target.matches('.btn-cerrar')){
            Livewire.emitTo('roles.roles', 'limpiarCampos');
        }
        if(e.target.matches('.btn-modal3')|| e.target.matches('.btn-cerrar2')){
            Livewire.emitTo('users.users', 'limpiarCampos');
        }
        if(e.target.matches('.btn-modal4')|| e.target.matches('.btn-cerrar4')){
            Livewire.emitTo('areas.areas', 'limpiarCampos');
        }
        if(e.target.matches('.btn-modal5')|| e.target.matches('.btn-cerrar5')){
            Livewire.emitTo('procesos.procesos', 'limpiarCampos');
        }

    })

    doc.addEventListener('dataPermissions', event =>{

        let myModalEl = new bootstrap.Modal(document.getElementById(event.detail.idModal), {
            keyboard: false
          });
          myModalEl.show();
        let $modal = doc.getElementById(event.detail.idModal);
        const $ul3 = document.createElement('ol'),
         $fragment = document.createDocumentFragment();
         event.detail.permission.forEach(el=>{
            const $li2 = document.createElement('li');
            // $li2.classList.add('list-group-item');
            $li2.textContent = el;
            $fragment.appendChild($li2);
          });

          $ul3.appendChild($fragment);
        //   $ul3.classList.add('list-group');
          $modal.querySelector('#data-permisos').insertAdjacentElement('afterbegin',$ul3);
          
        


    });

    doc.addEventListener('dataRoles', event =>{
        let myModalEl = new bootstrap.Modal(document.getElementById(event.detail.idModal), {
            keyboard: false
          });
          myModalEl.show();
        let $modal = doc.getElementById(event.detail.idModal);
        let texto = `<p>Actualmente el usuario ${event.detail.usuario} tiene el rol de <b>${event.detail.rol}</b></p>`;                  
         $modal.querySelector('#data-permisos').insertAdjacentHTML('afterbegin',texto);   


    }) 



    let dataTable = new simpleDatatables.DataTable("#myTable", {
        searchable: true,
        fixedHeight: true,
        paging: true
    
    })

    

    // let $fragment = document.createDocumentFragment();
    // let $tbody = document.getElementById('tbodyEje');
    // async function listDataEjes (){
    //     dataTable.destroy();
    //     try {
    //     let res = await  axios.get('/listarEjes'),
    //       json = await res.data;
          
    //       json.data.forEach((el)=>{            
    //         const $tr = document.createElement('tr');
    //         $tr.innerHTML = `<td>${el.id}</td> 
    //                          <td>${el.descripcion}</td>
    //                          <td>${el.proceso}</td> 
    //                          <td>
    //                          <button type="button" class="btn btn-success d-inline-flex align-items-center">
    //                              <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 0 0 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83z"/></svg>Editar</button>
                         
    //                          <button type="button" class="btn btn-danger d-inline-flex align-items-center">
    //                              <svg width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M9 3v1H4v2h1v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1V4h-5V3H9M7 6h10v13H7V6m2 2v9h2V8H9m4 0v9h2V8h-2Z"/></svg>Eliminar</button>
    //                          </td>`;
           
    //         $fragment.appendChild($tr);
    //     })
        
    //     $tbody.appendChild($fragment);
    //     let dataTable = new simpleDatatables.DataTable("#myTable", {
    //     searchable: true,
    //     fixedHeight: true,
    //     paging: true
    
    // })
        
            
    //    }catch(err){
    //     // console.log(err.response);
    //     // let message = err.response.statusText || "Ocurrio un Error";
    //     // $tbody.innerHTML = `Error ${err.response.status}: ${message}`;
    //    }finally{
            
    //    }

    // }

    // if(e.target.location.pathname=='/ejes'){
    //     listDataEjes()
    // }
    
   

    //function loop form

    function getData(form) {
        var formData = new FormData(form);
      
        for (var pair of formData.entries()) {
        //   console.log(pair[0] + ": " + pair[1]);
        }
      
        let data =Object.fromEntries(formData);
        return data;
      }

      function notifications (titulo,texto,icono) {

        Swal.fire({
            title: titulo,
            text: texto,
            icon: icono,
            toast:true,
            timer: 2000,                        
            showConfirmButton: false,
            timerProgressBar: true,
            position: 'top-right',
            
        });
      }

      //errors notfy
      const notyf = new Notyf({
        position: {
            x: 'right',
            y: 'top',
        },
        types: [
            {
                type: 'error',
                background: '#FA5252',
                icon: {
                    className: 'fas fa-times',
                    tagName: 'span',
                    color: '#fff'
                },
                dismissible: false,
                
            }
        ]
    });
    
    let $formEje = d.getElementById('myEjeForm');
    let pristine = new Pristine($formEje);     
     $formEje.addEventListener('submit',(e)=>{
        e.preventDefault();
        let valid = pristine.validate();
        if(valid){
            let datos = getData(e.target);
            axios.post('/ejes',datos)
            .then(function(response){
                if(response.data.success){
                    let myModalEl = document.getElementById('modalSignIn');
                    let modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();                                                       
                    $formEje.reset();
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     location.reload();
                    },2000)

                    
                                    
                }else{                    
                    $divNotificaciones = document.createElement("div");
                    $ul = document.createElement("ul");
                    response.data.errors.forEach((el)=>{
                        notyf.open({
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
      if(e.target.matches('.editarEje')){
        axios.get(`/edit/eje/${e.target.dataset.id}`)
         .then(function(response){
             console.log(response.data.data)
            let myModalEl = new bootstrap.Modal(document.getElementById('modalSignIn'), {
                keyboard: false
              });
              myModalEl.show();
              document.querySelector('.titulo').textContent = 'Editar Eje';
              document.querySelector('.btnModal').textContent = 'Editar';
              document.getElementById('descripcion').value = response.data.data.descripcion;
              document.getElementById('proceso').value = response.data.data.proceso_id;
              document.getElementById('idEje').value = response.data.data.id;
           
        }).catch(function(error){

        })
      }
      if(e.target.matches('.eliminarEje')){
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
                axios.delete(`/delete/eje/${e.target.dataset.id}`).then(function(response){ 
                    notifications('Proceso exitoso!',response.data.message,'success'); 
                    setTimeout(()=>{
                     location.reload();
                    },2000)

               }).catch(function(error){       
               })
               
            }
        })

       
      }
      
      if(e.target.matches('.btn-modal6')|| e.target.matches('.btn-cerrar6')){
        $formEje.reset();
        document.querySelector('.titulo').textContent = 'Crear Eje';
        document.querySelector('.btnModal').textContent = 'Crear';
      }

    });
       
  
});








