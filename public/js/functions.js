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
    
    
     
   
  
});



