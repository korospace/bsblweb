/**
 * GET TOTAL SAMPAH
 */
const getTotalSampah = async () => {

    let httpResponse = await httpRequestGet(`${APIURL}/sampah/totalitem`);

    if (httpResponse.status === 200) {
        let dataSampah = httpResponse.data.data;

        for (const name in dataSampah) {
            $(`#sampah-${name}`).html(dataSampah[name].total+' Kg');
        }   
    }
};

/**
 * GET ALL KATEGORI SAMPAH
 */
let arrayKatSampah = [];
const getAllKatSampah = async () => {

   $('#kategori-sampah-wraper').html(`<div class="position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
       <img src="${BASEURL}/assets/images/spinner.svg" style="width: 20px;" />
   </div>`); 
   let httpResponse = await httpRequestGet(`${APIURL}/kategori_sampah/getitem`);
   
   if (httpResponse.status === 404) {
       $('#kategori-sampah-wraper').html(`<div class="position-absolute bg-white d-flex align-items-center justify-content-center" style="z-index: 10;top: 0;bottom: 0;left: 0;right: 0;">
           <h6 tyle="opacity: 0.6;">kategori belum tersedia</h6>
       </div>`); 
   }
   else if (httpResponse.status === 200) {
       let elKategori  = '';
       let allKategori = httpResponse.data.data;
       arrayKatSampah  = httpResponse.data.data;

       allKategori.forEach(k => {

           elKategori += `
           <div class="w-100">
               <div class="kategori-list w-100 d-flex justify-content-between align-items-center px-3 py-2 cursor-pointer">
                   <div class=" d-flex align-items-center text-md" onclick="changeKatSampahVal('${k.name}')">
                       ${k.name} <i class="fas fa-check-circle text-muted ml-2"></i>
                   </div>
                   <span class="badge badge-danger border-radius-sm cursor-pointer"  onclick="deleteKatSampahVal(this,'${k.id}','${k.name}')">
                       <i class="fas fa-trash text-white"></i>
                   </span>
               </div>
               <hr class="horizontal dark mt-0">
            </div>`;
       });

       $('#kategori-sampah-wraper').html(elKategori);
   }
};

// change input value with name kategori
// in formAddEditSampah
const changeKatSampahVal = (kategoriName) => {
    $('#formAddEditSampah input[name=kategori]').val(kategoriName);
};

/**
* ADD KATEGORI SAMPAH
*/
$('#btnAddKategoriSampah').on('click', function(e) {
   e.preventDefault();
   
   if (validateAddKategori()) {
       let form = new FormData();
       form.append('kategori_name',$('input#NewkategoriSampah').val());

       $('#btnAddKategoriSampah #text').addClass('d-none');
       $('#btnAddKategoriSampah #spinner').removeClass('d-none');

       axios
       .post(`${APIURL}/kategori_sampah/additem`,form, {
           headers: {
               token: TOKEN
           }
       })
       .then((response) => {
           $('#btnAddKategoriSampah #text').removeClass('d-none');
           $('#btnAddKategoriSampah #spinner').addClass('d-none');
           $('input#NewkategoriSampah').val('');
           getAllKatSampah();
       })
       .catch((error) => {
           $('#btnAddKategoriSampah #text').removeClass('d-none');
           $('#btnAddKategoriSampah #spinner').addClass('d-none');

       })
   }
});

/**
  * HAPUS KATEGORI SAMPAH
  */
const deleteKatSampahVal = (el,id,katName) => {
    el.parentElement.parentElement.remove();
    
    if ($('#formAddEditSampah input[name=kategori]').val() == katName) {
        $('#formAddEditSampah input[name=kategori]').val('');
    }

    axios
    .delete(`${APIURL}/kategori_sampah/deleteitem?id=${id}`, {
        headers: {
            token: TOKEN
        }
    })
    .then(() => {
    })
    .catch(error => {
        getAllJenisSampah();

        // unauthorized
        if (error.response.status == 401) {
            if (error.response.data.messages == 'token expired') {
                Swal.fire({
                    icon : 'error',
                    title : '<strong>LOGIN EXPIRED</strong>',
                    text: 'silahkan login ulang untuk perbaharui login anda',
                    showCancelButton: false,
                    confirmButtonText: 'ok',
                }).then(() => {
                    window.location.replace(`${BASEURL}/login`);
                    document.cookie = `tokenAdmin=null;expires=;path=/;`;
                })
            }
            else{
                window.location.replace(`${BASEURL}/login`);
                document.cookie = `tokenAdmin=null;expires=;path=/;`;
            }
        }
        // error server
        else if (error.response.status == 500) {
            showAlert({
                message: `<strong>Ups...</strong> terjadi kesalahan pada server, silahkan refresh halaman.`,
                btnclose: true,
                type:'danger' 
            })
        }
    })
};

// validate add kategori sampah
function validateAddKategori() {
   let status = true;

   if ($('input#NewkategoriSampah').val() == '') {
       showAlert({
           message: `<strong>Masukan kategori baru !</strong>`,
           btnclose: false,
           type:'danger'
       })
       status = false;
   }
   else if ($('input#NewkategoriSampah').val().length > 40) {
       showAlert({
           message: `<strong>Kategori baru maximal 20 huruf !</strong>`,
           btnclose: false,
           type:'danger'
       })
       status = false;
   }
   // check kategori is exist
   arrayKatSampah.forEach(ks => {
       if (ks.name == $('input#NewkategoriSampah').val().toLowerCase().trim()) {
           showAlert({
               message: `<strong>Kategori sudah tersedia !</strong>`,
               btnclose: false,
               type:'danger'
           })
           status = false;
       }
   });

   setTimeout(() => {
       hideAlert();
   }, 3000);

   return status;
}

/**
 * GET ALL JENIS SAMPAH
 */
 let arrayJenisSampah = [];
 const getAllJenisSampah = async () => {
 
     $('#search-sampah').val('');
     $('#list-sampah-spinner').removeClass('d-none'); 
     let httpResponse = await httpRequestGet(`${APIURL}/sampah/getitem`);
     $('#list-sampah-spinner').addClass('d-none'); 
     
     if (httpResponse.status === 404) {
         $('#list-sampah-notfound').removeClass('d-none'); 
         $('#list-sampah-notfound #text-notfound').html(`jenis sampah belum ditambah`); 
     }
     else if (httpResponse.status === 200) {
         let trJenisSampah  = '';
         let allJenisSampah = httpResponse.data.data;
         arrayJenisSampah   = httpResponse.data.data;
 
         allJenisSampah.forEach((n,i) => {
 
             trJenisSampah += `<tr class="text-xs">
                 <td class="align-middle text-center py-3">
                     <span class="font-weight-bold"> ${++i} </span>
                 </td>
                 <td class="align-middle text-center">
                     <span class="font-weight-bold text-capitalize"> ${n.kategori} </span>
                 </td>
                 <td class="align-middle text-center">
                    ${n.jenis}
                 </td>
                 <td class="align-middle text-center py-3">
                     <span class="font-weight-bold">Rp. ${modifUang(n.harga)} </span>
                 </td>
                 <td class="align-middle text-center py-3">
                     <span class="font-weight-bold"> ${n.jumlah} </span>
                 </td>
                 <td class="align-middle text-center">
                     <span id="btn-hapus" class="badge badge-danger text-xxs pb-1 rounded-sm cursor-pointer" onclick="hapusSampah('${n.id}')">hapus</span>
                     <span id="btn-hapus" class="badge badge-warning text-xxs pb-1 rounded-sm cursor-pointer" data-toggle="modal" data-target="#modalAddEditNasabah" onclick="openModalAddEditNsb('editasabah','${n.id}')">edit</span>
                 </td>
             </tr>`;
         });
 
         $('#table-jenis-sampah tbody').html(trJenisSampah);
     }
 };

 // Edit modal when open
 const openModalAddEditSmp = (modalName,idsampah=null) => {
     let modalTitle = (modalName=='addsampah') ? 'tambah sampah' : 'edit sampah' ;
     
     $('#modalAddEditSampah .modal-title').html(modalTitle);
     // clear error message first
     $('#formAddEditSampah .form-control').removeClass('is-invalid');
     $('#formAddEditSampah .text-danger').html('');
 
     if (modalName == 'addnasabah') {
         $('#formAddEditSampah').attr('onsubmit','addSampah(this,event);');
        //  $('#modalAddEditSampah .addnasabah-item').removeClass('d-none');
        //  $('#modalAddEditSampah .editnasabah-item').addClass('d-none');        
         
         clearInputForm();
     } 
     else {
         $('#formAddEditSampah').attr('onsubmit','editSampah(this,event);');
        //  $('#modalAddEditSampah .addnasabah-item').addClass('d-none');
        //  $('#modalAddEditSampah .editnasabah-item').removeClass('d-none');        
         
         $('#modalAddEditSampah #list-sampah-spinner').removeClass('d-none');
     }
 }

 /**
  * HAPUS JENIS SAMPAH
  */
 const hapusSampah = (id) => {
     Swal.fire({
         title: 'ANDA YAKIN?',
         text: "Data akan terhapus permanen",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonText: 'iya',
         cancelButtonText: 'tidak',
         showLoaderOnConfirm: true,
         preConfirm: () => {
             return axios
             .delete(`${APIURL}/sampah/deleteitem?id=${id}`, {
                 headers: {
                     token: TOKEN
                 }
             })
             .then(() => {
                 Swal.close();
                 getAllJenisSampah();
             })
             .catch(error => {
                 // unauthorized
                 if (error.response.status == 401) {
                     Swal.showValidationMessage(
                         `waktu login anda sudah habis!`
                     )
                     
                     setTimeout(() => {
                         document.cookie = `tokenAdmin=null; path=/;`;
                         window.location.replace(`${BASEURL}/login`);
                     }, 3000);
                 }
                 // error server
                 else if (error.response.status == 500) {
                     Swal.showValidationMessage(
                         `server error: coba sekali lagi!`
                     )
                 }
             })
         },
         allowOutsideClick: () => !Swal.isLoading()
     })
 }